<?php

namespace Core\Domain\DB;

use Core\Domain\DB\DBConnection;

use \PDOStatement;
use \PDO;

/**
 * Class DBManager
 */
abstract class DBManager implements DBManagerInterface
{
    /**
     * @var DBConnection
     */
    private $dbConnection;

    /**
     * @var \PDO
     */
    private $bdd;

    /**
     * @var boolean
     */
    private $connection_established;

    /**
     * @param DBConnection $dbConnection
     */
    public function __construct(DBConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    /**
     * @return boolean
     */
    public function isConnectionEstablished()
    {
        return $this->connection_established;
    }

    /**
     * @param boolean $connection_established
     */
    public function setConnectionEstablished($connection_established)
    {
        $this->connection_established = $connection_established;
    }

    /**
     * @param string $query
     */
    public function save($query)
    {
        $this->getConnection();

        $this->bdd->exec($query);
    }

    /**
     * @param string $query
     *
     * @return \PDOStatement
     */
    public function findOne($query)
    {
        $this->getConnection();

        return $this->bdd->query($query)->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * check connection to the db
     */
    private function getConnection()
    {
        if (!$this->connection_established) {
            $this->bdd = $this->dbConnection->connect();
            if($this->bdd !== null) {
                $this->connection_established = true;
            }
        }
    }
}
