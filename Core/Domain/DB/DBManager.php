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
    private $connectionEstablished;

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
        return $this->connectionEstablished;
    }

    /**
     * @param boolean $connectionEstablished
     */
    public function setConnectionEstablished($connectionEstablished)
    {
        $this->connectionEstablished = $connectionEstablished;
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
     * connect to the database
     *
     * @throws \PDOException
     */
    private function getConnection()
    {
        if (!$this->connectionEstablished) {
            $this->bdd = $this->dbConnection->connect();
            if ($this->bdd !== null) {
                $this->connectionEstablished = true;
            } else {
                $this->connectionEstablished = false;
                throw new \PDOException();
            }
        }
    }
}
