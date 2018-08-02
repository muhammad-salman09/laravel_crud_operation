<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Table Name
    protected $table='posts';
    //Primary Key
    public $primarykey='id';
    //TimeStamps ,"time to post or register"
    public $timeStamps=true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
