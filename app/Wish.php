<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    protected $fillable = ['user_id', 'application_id'];

    protected $table = 'wishes';

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function application() {
        return $this->hasOne('App\Application');
    }
}
