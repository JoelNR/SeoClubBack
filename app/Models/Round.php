<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'points',
        'score_id'
    ];

    public function score(){
        return $this->belongsTo(Score::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sets(){
        return $this->hasMany(Set::class);
    }    
}
