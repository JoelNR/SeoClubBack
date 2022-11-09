<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Profile extends Model
{
    use HasFactory,HasApiTokens;
    protected $guarded = [];

    protected $fillable = [
        'first_name',
        'last_name',
        'category',
        'image'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
