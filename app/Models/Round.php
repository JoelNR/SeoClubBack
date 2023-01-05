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
    ];

    public function Score(){
        return $this->belongsTo(Score::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
