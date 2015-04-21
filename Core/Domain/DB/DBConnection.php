<?php

namespace Core\Domain\DB;

use Core\Domain\DB\DBConnectionInterface;

use \PDO;

/**
 * Class DBConnection
 */
class DBConnection implements DBConnectionInterface
{
    /**
     * @var string
     */
    private $dbAddress;

    /**
     * @var string
     */
    private $dbName;

    /**
     * @var string
     */
    private $dbUser;

    /**
     * @var string
     */
    private $dbPwd;

    /**
     * @param string $dbAddress
     * @param string $dbUser
     * @param string $dbPwd
     * @param string $dbName
     */
    public function __construct($dbAddress, $dbUser, $dbPwd, $dbName)
    {
        $this->dbAddress = $dbAddress;
        $this->dbName    = $dbName;
        $this->dbUser    = $dbUser;
        $this->dbPwd     = $dbPwd;
    }

    /**
     * get Data object
     */
    public function connect()
    {
            $bdd = new \PDO('mysql:host='.$this->dbAddress.';dbname='.$this->dbName.';charset=utf8', $this->dbUser, $this->dbPwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $bdd->query("SET NAMES UTF8");

            return $bdd;
    }
}
