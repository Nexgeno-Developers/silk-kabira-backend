<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use MassPrunable;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'url',
        'method',
        'referrer',
        'device_type',
        'browser',
        'platform',
        'company_id',
    ];

    public function prunable(): Builder
    {
        $retentionDays = max(1, (int) config('custom.visitor_retention_days', 90));

        return static::query()->where('created_at', '<', now()->subDays($retentionDays));
    }
}
