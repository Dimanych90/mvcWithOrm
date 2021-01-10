<?php


namespace App\Model;


use Base\Model;
use Intervention\Image\ImageManagerStatic;

class Post extends Model
{
    protected array $data;

    protected static $table = 'posts';

    protected int $id;

    public static function imageUser($tmp_name, $filename)
    {
        $image = ImageManagerStatic::make($tmp_name)
            ->resize(90, 110)
            ->save("postphoto/" . $filename, 90);
    }

    public static function postList()
    {
        $model = new Model();
        $table = self::$table;
        $select = "SELECT * FROM $table ORDER BY id DESC LIMIT 10";

        $ret = $model->selectAll($select);

        $res = [];

        foreach ($ret as $item) {
            $ret = new self();
            $ret->data = $item;
            $ret->id = $ret->data['id'];
            $res[] = $ret;
        }

        return $res;
    }

}