<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    protected $fillable = ["title", "start_date", "end_date", "invite_token"];

    protected $table = "trips";

    protected $casts = [
        "start_date" => "datetime",
        "end_date" => "datetime",
    ];

    public $timestamps = false;

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "users_trips");
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

}
