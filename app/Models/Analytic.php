<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Analytic extends Model
{
    protected $fillable = [
        'link_id',
        'ip_address',
        'user_agent',
        'country',
        'clicks',
    ];

    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}
