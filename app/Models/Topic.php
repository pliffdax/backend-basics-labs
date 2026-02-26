<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    protected $fillable = ['title'];

    /**
     * @return BelongsToMany<Subscriber, Topic>
     */
    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(Subscriber::class, 'subscriptions');
    }

    /**
     * @return HasMany<Newsletter>
     */
    public function newsletters(): HasMany
    {
        return $this->hasMany(Newsletter::class);
    }
}
