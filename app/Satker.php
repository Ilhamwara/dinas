<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;

class Satker extends Model
{
    //
    protected $table = 'satker';
    protected $primaryKey = 'satker_id';

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('satker')->encode($this->attributes['satker_id']);
    }
}
