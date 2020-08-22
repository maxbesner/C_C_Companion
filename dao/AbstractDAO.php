<?php

mysqli_report(MYSQLI_REPORT_STRICT);

class abstractDAO
{
    protected $mysqli;

    protected static $DB_HOST ="127.0.0.1";

    protected static $DB_USERNAME = "root";

    protected static $DB_PASSWORD = "pwdpwd1";

    protected static $DB_DATABASE = "character_builder";

    function __construct()
    {
        try
        {
            $this->mysqli = new mysqli(self::$DB_HOST, self::$DB_USERNAME,
                self::$DB_PASSWORD, self::$DB_DATABASE);
        }catch(mysqli_sql_exception $e)
        {
            throw $e;
        }
    }

    public function getMysqli()
    {
        return $this->mysqli;
    }
}