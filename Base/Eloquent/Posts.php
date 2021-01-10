<?php


namespace Base\Eloquent;


use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'posts';

    protected $fillable = ["message",'user_id','filename'];

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}