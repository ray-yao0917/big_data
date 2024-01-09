<?php 
class DBConnectionHandler
{
    private static $serverName = 'localhost';

    private static $userName = 'pma';

    private static $password = '1234';

    private static $db = 'BIGDATA';

    private static $connection = null;

    public static function setConnection(
        $serverName,
        $userName,
        $password,
        $db
    )
    {
        static::$serverName = $serverName;
        static::$userName   = $userName;
        static::$password   = $password;
        static::$db         = $db;

        $connectionStr = sprintf(
          "mysql:host=%s;dbname=%s",
          static::$serverName,
          static::$db
        );

        try {
            static::$connection = new PDO($connectionStr , static::$userName, static::$password);
            // set the PDO error mode to exception
            static::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch(PDOException $e) {
            // echo "Connection failed: " . $e->getMessage();
            throw $e;
          }
    }

    public static function getConnection()
    {
      if (is_null(static::$connection)) {
          throw new InvalidArgumentException();
      }
      return static::$connection;
    }
}

?>