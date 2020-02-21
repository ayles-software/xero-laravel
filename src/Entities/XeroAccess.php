<?php

namespace AylesSoftware\XeroLaravel\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class XeroAccess extends Model
{
    use SoftDeletes;

    protected $table = 'xero_access';

    protected $guarded = [];

    protected $dates = [
        'expires_at',
    ];

    public static function latest()
    {
        return static::orderByDesc('created_at')->first();
    }

    public static function setAllObsolete()
    {
        static::query()->update(['deleted_at' => now()]);
    }

    public function getHasExpiredAttribute()
    {
        return $this->expires_at->lt(now());
    }
}
