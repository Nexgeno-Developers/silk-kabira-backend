<?php

namespace App\Http\Middleware;

use App\Jobs\TrackVisitorHit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->shouldSkipTracking($request)) {
            return $next($request);
        }

        $cacheKey = 'visitor_' . md5(
            implode('|', [
                (string) $request->ip(),
                (string) $request->userAgent(),
                (string) $request->path(),
            ])
        );

        if (!Cache::has($cacheKey)) {
            TrackVisitorHit::dispatch($this->visitorPayload($request))->afterResponse();

            // Store visit cache key
            Cache::put($cacheKey, true, now()->addMinutes(config('custom.cache_minutes')));
        }

        return $next($request);
    }

    // protected function shouldSkipTracking(Request $request): bool
    // {
    //     // Skip tracking for specific routes (e.g., admin routes, assets)
    //     $skipRoutes = [
    //         'backend.*',
    //         'admin.*',
    //         'horizon.*',
    //         'telescope.*',
    //         '*.css',
    //         '*.js',
    //         '*.ico',
    //         '*.png',
    //         '*.jpg',
    //         '*.jpeg',
    //         '*.gif',
    //         '*.svg',
    //     ];

    //     foreach ($skipRoutes as $route) {
    //         if ($request->is($route)) {
    //             return true;
    //         }
    //     }

    //     return false;
    // }

    protected function shouldSkipTracking(Request $request): bool
    {
        $skipPatterns = [
            'backend/',
            'admin/',
            'horizon/',
            'telescope/',
            '.css', '.js', '.ico', '.png', '.jpg', '.jpeg', '.gif', '.svg',
        ];

        return \Str::contains($request->path(), $skipPatterns);
    }

    protected function visitorPayload(Request $request): array
    {
        $agent = new Agent();

        return [
            'ip_address' => $this->anonymizeIp((string) $request->ip()),
            'user_agent' => $request->userAgent(),
            'url' => $request->url(),
            'method' => $request->method(),
            'referrer' => $this->sanitizeReferrer($request->header('referer')),
            'device_type' => $this->getDeviceType($agent),
            'browser' => $agent->browser(),
            'platform' => $agent->platform(),
            'company_id' => config('custom.company_id'),
        ];
    }

    protected function getDeviceType(Agent $agent): string
    {
        if ($agent->isDesktop()) {
            return 'desktop';
        } elseif ($agent->isTablet()) {
            return 'tablet';
        } elseif ($agent->isMobile()) {
            return 'mobile';
        } elseif ($agent->isRobot()) {
            return 'bot';
        }

        return 'unknown';
    }

    protected function sanitizeReferrer(?string $referrer): ?string
    {
        if (!filled($referrer)) {
            return null;
        }

        $parts = parse_url($referrer);
        if ($parts === false || empty($parts['scheme']) || empty($parts['host'])) {
            return null;
        }

        $path = $parts['path'] ?? '';

        return $parts['scheme'] . '://' . $parts['host'] . $path;
    }

    protected function anonymizeIp(string $ip): string
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $segments = explode('.', $ip);
            $segments[3] = '0';

            return implode('.', $segments);
        }

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $segments = explode(':', $ip);
            $segments = array_pad($segments, 8, '0');

            return implode(':', array_slice($segments, 0, 4)) . '::';
        }

        return $ip;
    }
}
