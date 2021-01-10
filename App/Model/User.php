<?php


namespace App\Model;


use Base\Model;
use Carbon\Carbon;

class User extends Model
{

    protected array $data;
    protected static $table = 'users';
    protected int $id;

    public function gump()
    {
        $is_valid = \GUMP::is_valid(array_merge($_POST), [
            'name' => 'required|alpha_numeric',
            'password' => 'required|between_len,6;100',
            'email' => 'required|valid_email',
            'birth_date' => 'required'
        ]);

        if ($is_valid === true) {
            echo "that's good<br>";
        } else {
            foreach ($is_valid as $item) {
                echo $item . "<br>";
            }
            return false;
        }
        return true;
    }

    public function carbon($age)
    {
        $carbon = Carbon::create($age)->age;
        return $carbon;
    }

    public static function userlist()
    {
        $table = self::$table;
        $select = "SELECT * FROM $table";
        $mosel = new Model();
        $ret = $mosel->selectAll($select);
        $res = [];

        foreach ($ret as $elem) {
            $ret = new self();
            $ret->data = $elem;
            $res[] = $ret;
        }
        return $res;
    }


}