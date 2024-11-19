<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Currency extends Model
{
    protected $fillable = ['code', 'symbol', 'name', 'country'];

    protected $table = 'currencies';

    public function expense(): HasOne{
        return $this->hasOne(Expense::class,);
    }
}
