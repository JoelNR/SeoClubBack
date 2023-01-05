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
    ];

    public function competition(){
        return $this->belongsTo(Competition::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
