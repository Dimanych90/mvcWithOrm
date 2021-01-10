<?php


namespace App\Model;


use Base\Model;
use Base\Eloquent\Connection;
use Base\Eloquent\FIles;
use Intervention\Image\ImageManagerStatic;


class FIle extends Model
{
    protected static $table = "files";

    protected array $data;

    public static function uploadedFiles($fileName, $tmp_name)
    {
        move_uploaded_file($tmp_name, 'photos/' . $fileName);
    }

    public static function imageUpload($tmp_name, $filename)
    {
        $image = ImageManagerStatic::make($tmp_name)
            ->resize(105, 140)
            ->save("photos/" . $filename);
    }

    public function save()
    {
        \Base\Eloquent\Connection::contact();
        $file = \Base\Eloquent\FIles::query()->create([
            'filename' => $this->data['filename'],
            'user_id' => $this->data['user_id'],
            'size' => $this->data['size']
        ]);

    }
}