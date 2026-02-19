<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Newsletter extends Model
{
    protected $fillable = ['topic_id', 'subject', 'body', 'sent_at'];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    /**
     * @return BelongsTo<Topic, Newsletter>
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }
}
