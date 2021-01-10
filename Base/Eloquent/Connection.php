<?php


namespace Base\Eloquent;

use Illuminate\Database\Capsule as Capsul;

class Connection
{

    /**
     * Connection constructor.
     */

    public static function contact()
    {
        $capsul = new Capsul\Manager();

        $capsul->addConnection([
            "driver" => $_ENV["DSN"],
            "host" => $_ENV['HOST'],
            "database" => $_ENV["DB_NAME"],
            "username" => $_ENV["USER"],
            "password" => $_ENV["PASS"],
            "charset" => "utf8",
            'collation' => "utf8_unicode_ci",
            'prefix' => ''
        ]);

        $capsul->setAsGlobal();
        $capsul->bootEloquent();
        $capsul->getConnection()->enableQueryLog();
    }


}