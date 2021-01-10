<?php


namespace Base;


use Base\Eloquent\Connection;
use Base\Eloquent\Posts;
use Base\Eloquent\User as Users;
use App\Model\User;

class Model
{

    protected static $table;

    protected array $data;

    protected int $id;

    public function auth()
    {
        $db = new Db();
        $keys = implode(",", array_keys($this->data));
        $value = array_map(function ($value) {
            return ':' . $value;
        }, array_keys($this->data));
        $values = implode(",", $value);
        $comb = array_combine(array_values($value), array_values($this->data));
        $table = static::$table;
        $select = "SELECT * FROM $table WHERE name = :name AND password = :password AND email = :email
                      AND birth_date = :birth_date";
        $res = $db->selectAll($select, $comb);
        if (empty($res)) {
            $insert = "INSERT INTO $table ($keys) VALUES ($values)";
            $db->insert($insert, $comb);
        } else {
            var_dump($res);
        }
    }

    public function selectAll($query)
    {
        $db = new Db();
        $ret = $db->selectAll($query);
        return $ret;
    }

    public function register()
    {
        \Base\Eloquent\Connection::contact();
        $user = \Base\Eloquent\User::firstorcreate([
            'name' => $this->data['name'],
            'password' => sha1($this->data['password']),
            'email' => $this->data['email'],
            'birth_date' => $this->data['birth_date']
        ]);
        if ($user == true) {
            return true;
        } else {
            return false;
        }
//        var_dump($user::all()->toArray());
    }

    public function authorize()
    {
        \Base\Eloquent\Connection::contact();
        $user = \Base\Eloquent\User::query()->where('name', '=', $this->data['name'])->
        where('password', '=', $this->data['password'])->exists();
        if ($user == true) {
            return true;
//            var_dump($user->toArray());
        } else {
            return false;
        }
    }

    public function getId()
    {
        Connection::contact();
        $users = \Base\Eloquent\User::where('name', $this->data['name'])->
        where('password', '=', $this->data['password'])->get();

//        var_dump($users->toarray()[0]['id']);
        foreach ($users as $user) {
            return $user->id;
        }
    }

    public function findById($id)
    {
        Connection::contact();
        $user = \Base\Eloquent\User::query()->find($id);
        return $user->toArray();
    }

    public function postImage($filename)
    {
       Connection::contact();
       $ret = Posts::query()->where('filename', '=', $filename)->orderByDesc('id')->get();

       return "../postphoto/". $ret[0]['filename'];
    }

    public function getImage($id)
    {
        Connection::contact();
        $ret = \Base\Eloquent\FIles::query()->where('user_id', '=', $id)->latest()->get();
        return "../photos/" . $ret->toArray()[0]['filename'];
//        die();
    }


    public function get($value)
    {
        return $this->data[$value];
    }

    public function set($data, $value)
    {
        $this->data[$value] = $data;
        return $this;
    }

    public function saveAll()
    {
        Connection::contact();
        $post = Posts::query()->create([
            'message' => $this->data['message'],
            'user_id' => $this->data['user_id'],
            'filename' => $this->data['filename']
        ])->save();
    }

}