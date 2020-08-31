<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;  // Allows to use table () method in DB

class Application extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'name', 'image', 'price', 'description'
    ];

    protected $table = 'applications';

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function orders() {
        return $this->hasMany('App\Order', 'application_id', 'id');
    }

    public function votes() {
        return $this->hasMany('App\Vote', 'application_id', 'id');
    }

    public function scopeOrderedApps($query) {

        // Returns ALL application_id keys of the order collection
        $app_id_array = \App\Order::all()->pluck('application_id');
        
        // search all applications of those orders
        $query->whereIn('id', $app_id_array);
        
        return $query;
    }

    public function scopeVotedApps($query) 
    {
        // Array of most voted applications + qty (min 2 votes)
        $db = \DB::select('select `application_id`, count(*) AS `qty` FROM `votes` GROUP BY `application_id` HAVING `qty` > 1');

        usort($db, function($a, $b) {return strcmp($b->qty, $a->qty);});    // Sort by qty DESC

        // usort($db, function($a, $b) {return strcmp($a->qty, $b->qty);});    // Sort by qty ASC

        // Array of application indexes (numbers)
        $app_id_array = array_map(function($object){return $object->application_id;}, $db);

        // Bring only the applications that match the indexes
        $query->whereIn('id', $app_id_array);

        return $query;
    }

    public function getRating() 
    {
        // Array of total voted applications + qty
        $db = \DB::select('select `application_id`, count(*) AS `qty` FROM `votes` GROUP BY `application_id`');

        $result = 0;

        if(count($db)>0){
            $total_votes = 0;   // Counter 100% of the votes in votes table
            $this_total_votes = 0;  // Counter for this application votes
            foreach ($db as $app) {
                $total_votes += $app->qty;
                if($app->application_id == $this->id){
                    $this_total_votes += $app->qty;
                }
            }
    
            $result = ($this_total_votes * 100) / $total_votes;
        }

        return floor($result * 100) / 100; // Float truncated to 2 decimals
    }

}
