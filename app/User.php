<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Hashids;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'pegawai_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('user')->encode($this->attributes['id']);
    }

    public function pegawai()
    {
        return $this->belongsTo('\App\Pegawai', 'pegawai_id');
    }
}
