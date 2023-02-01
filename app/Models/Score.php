<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'points',
        'competition_id',
        'training_id'
    ];

    public function competition(){
        return $this->belongsTo(Competition::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function rounds(){
        return $this->hasMany(Round::class);
    }

    public function training(){
        return $this->belongsTo(Training::class);
    }
}
