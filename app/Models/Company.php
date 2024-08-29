<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $title;
 * @property string $phone;
 * @property string $description;
 * @property int $user_id;
 */
class Company extends Model
{
    protected $fillable = [
        'title', 'phone', 'description', 'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
