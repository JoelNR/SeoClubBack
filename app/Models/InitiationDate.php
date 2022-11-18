<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class InitiationDate extends Model
{
    use HasFactory,HasApiTokens;
    protected $guarded = [];

    protected $fillable = [
        'date',
        'capacity'
    ];

    public function user(){
        return $this->hasMany(User::class);
    }
}
