<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'category',
        'amount',
        'currency',
        'date',
        'notes',
    ];

    protected $table = 'expenses';

    protected $casts = [
        'date' => 'datetime'
    ];

    public $timestpamps = true;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
