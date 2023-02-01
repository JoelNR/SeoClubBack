<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this -> hasOne(Profile::class);
    }

    public function initiation_date()
    {
        return $this -> hasOne(InitiationDate::class);
    }

    public function competition()
    {
        return $this -> hasMany(Competition::class);
    }

    public function arrows()
    {
        return $this -> hasMany(Arrow::class);
    }

    public function sets()
    {
        return $this -> hasMany(Set::class);
    }

    public function rounds()
    {
        return $this -> hasMany(Round::class);
    }

    public function scores()
    {
        return $this -> hasMany(Score::class);
    }

    protected static function boot(){
        parent::boot();

        static::created(function($user){
            $user->profile()->create([
                'first_name'=> $user->first_name, 
                'last_name' => $user->last_name   
            ]);
        });
    }

    public function records(){
        return $this->hasMany(Record::class);
    }

    public function trainings(){
        return $this->hasMany(Training::class);
    }
}
