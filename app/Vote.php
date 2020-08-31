<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['user_id', 'application_id'];

    protected $table = 'votes';

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function application() {
        return $this->hasOne('App\Application');
    }
}
