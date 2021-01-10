<?php

namespace Base\Eloquent;

use Illuminate\Database\Capsule as Capsul;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $fillable = ['name', 'password', 'email', 'birth_date'];

    protected $table = 'users';

    public function posts()
    {
        return $this->hasMany("posts", 'user_id', 'id');
    }

    public function files()
    {
        return $this->hasMany('files','user_id', 'id');
    }

    public function getLog()
    {

        $log = Capsul\Manager::connection()->getQueryLog();
        foreach ($log as $item) {
            echo 0.01 * $item['time'] . ': ' . $item['query'] . 'bind' . json_encode($item['bindings']) . "<br>";
        }

    }

}