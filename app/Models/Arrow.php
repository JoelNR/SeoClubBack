<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arrow extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'points',
        'set_id',
        'user_id'
    ];

    public function set(){
        return $this->belongsTo(Set::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
