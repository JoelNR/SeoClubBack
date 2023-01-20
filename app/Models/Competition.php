<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'date',
        'description',
        'price',
        'title',
        'place',
        'modality'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function scores(){
        return $this->hasMany(User::class);
    }

    public function records(){
        return $this->hasMany(Record::class);
    }
}
