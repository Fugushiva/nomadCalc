<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    protected $fillable = [
        "name",
    ];

    protected $table = "categories";

    public $timestamps = false;

    public function expense(): HasOne
    {
        return $this->hasOne(Expense::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }
}
