<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Subscriber extends Model
{
    protected $fillable = ['name', 'email', 'login', 'password_hash'];
    /**
     * @return BelongsToMany<Topic,Subscriber,Pivot>
     */
    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(Topic::class, 'subscriptions');
    }
}
