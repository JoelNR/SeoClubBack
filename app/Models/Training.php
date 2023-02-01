<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'date',
        'distance',
        'points',
        'title',
        'modality',
        'category',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function score(){
        return $this->hasOne(User::class);
    }
}
