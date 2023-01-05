<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'points',
    ];

    public function round(){
        return $this->belongsTo(Round::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
