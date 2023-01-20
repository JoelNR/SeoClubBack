<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'points',
        'category',
        'distance',
        'modality',
        'competition_id',
        'user_id'
    ];

    public function competition(){
        return $this->belongsTo(Competition::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
