<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon;


class Expense extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'trip_id',
        'currency_id',
        'title',
        'amount',
        'date',
        'notes',
    ];

    protected $table = 'expenses';

    protected $casts = [
        'date' => 'datetime'
    ];

    public $timestpamps = true;

    public function scopeLastWeek($query)
    {
        return $query->whereBetween('date', [Carbon::now()->subWeek(),Carbon::now()]);
    }

    public function scopeToday($query)
    {
        return $query->where('date', Carbon::today());
    }

    public function scopeMinPrice($query)
    {
        return $query->where('converted_amount', '>=', 0)->min('converted_amount');
    }

    public function scopeMaxPrice($query)
    {
        return $query->where('converted_amount', '>=',0)->max('converted_amount');
    }

    public function getFormattedDateAttribute(){
        return $this->date ? $this->date->format("d-m-Y") : null;
    }

    //relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'expense_tag');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function trip(){
        return $this->belongsTo(Trip::class);
    }
    


}
