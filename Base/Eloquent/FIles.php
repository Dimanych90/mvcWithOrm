<?php


namespace Base\Eloquent;


use Illuminate\Database\Eloquent\Model;

class FIles extends Model
{
    protected $table = 'files';

    protected $fillable = ['filename', 'user_id','size'];

    public function files()
    {
        return $this->belongsTo(\App\Model\User::class, 'user_id', 'id');
    }
}