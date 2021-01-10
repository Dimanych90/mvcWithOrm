<?php


namespace Base;


class Db
{
    /** @var \PDO */
    private static $_pdo;

    public static function getConnection()
    {
        $dsn = $_ENV['DSN'];
        $dbName = $_ENV['DB_NAME'];
        $host = $_ENV['HOST'];
        $user = $_ENV['USER'];
        $pass = $_ENV['PASS'];

        try {
            self::$_pdo = new \PDO("$dsn:host=$host;dbname=$dbName", $user, $pass);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    public function selectAll($select, $data = null)
    {
        Db::getConnection();
        $pdo = self::$_pdo->prepare($select);
        $res = $pdo->execute();

        if ($res == false) {
            var_dump($pdo->queryString, $pdo->errorInfo());
            die();
        }
        return $pdo->fetchAll(\PDO::FETCH_ASSOC);

    }

}