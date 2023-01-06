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
        'round_id'
    ];

    public function round(){
        return $this->belongsTo(Round::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function arrows(){
        return $this->hasMany(Arrow::class);
    }
}
