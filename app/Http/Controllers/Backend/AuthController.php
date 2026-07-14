<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AuthController extends Controller
{
    private const LOGIN_MAX_ATTEMPTS = 5;
    private const LOGIN_LOCKOUT_SECONDS = 900;

    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('backend.login');
    }

    /**
     * Handle login requests.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => ['required', 'string'],
        ]);

        $this->ensureIsNotRateLimited($request);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $this->clearLoginRateLimit($request);
            $request->session()->regenerate();
            return redirect()->route('backend.dashboard')->with('success', 'You are logged in.');
        }

        $this->hitLoginRateLimit($request);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    /**
     * Handle logout requests.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('backend.login')->with('success', 'You have been logged out.');
    }

    /**
     * Show the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showForgotPasswordForm()
    {
        return view('backend.passwords.email');
    }

    /**
     * Handle sending of password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', __($status));
        }

        return back()
            ->withErrors(['email' => __($status)])
            ->withInput();
    }

    /**
     * Show the password reset form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $token
     * @return \Illuminate\View\View
     */
    public function showResetForm(Request $request, string $token)
    {
        return view('backend.passwords.reset', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    /**
     * Handle password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', $this->passwordRules()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()
                ->route('backend.login')
                ->with('success', __($status));
        }

        return back()
            ->withErrors(['email' => __($status)])
            ->withInput();
    }

    private function passwordRules(): PasswordRule
    {
        return PasswordRule::min(12)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised();
    }

    private function ensureIsNotRateLimited(Request $request): void
    {
        if (
            RateLimiter::tooManyAttempts($this->emailThrottleKey($request), self::LOGIN_MAX_ATTEMPTS) ||
            RateLimiter::tooManyAttempts($this->emailIpThrottleKey($request), self::LOGIN_MAX_ATTEMPTS)
        ) {
            event(new Lockout($request));

            $seconds = max(
                RateLimiter::availableIn($this->emailThrottleKey($request)),
                RateLimiter::availableIn($this->emailIpThrottleKey($request))
            );

            throw ValidationException::withMessages([
                'email' => ["Too many login attempts. Try again in {$seconds} seconds."],
            ]);
        }
    }

    private function hitLoginRateLimit(Request $request): void
    {
        RateLimiter::hit($this->emailThrottleKey($request), self::LOGIN_LOCKOUT_SECONDS);
        RateLimiter::hit($this->emailIpThrottleKey($request), self::LOGIN_LOCKOUT_SECONDS);
    }

    private function clearLoginRateLimit(Request $request): void
    {
        RateLimiter::clear($this->emailThrottleKey($request));
        RateLimiter::clear($this->emailIpThrottleKey($request));
    }

    private function emailThrottleKey(Request $request): string
    {
        return 'backend-login:email:' . Str::lower((string) $request->input('email'));
    }

    private function emailIpThrottleKey(Request $request): string
    {
        return 'backend-login:email-ip:' . Str::lower((string) $request->input('email')) . '|' . $request->ip();
    }
}
