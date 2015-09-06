<?php

namespace Crawler\Model;

use Zend\Db\TableGateway\TableGateway;

class CrawlTable
{
    private $_tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->_tableGateway = $tableGateway;
    }
    public function fetchAll()
    {
        $resultSet = $this->_tableGateway->select();
        return $resultSet;
    }

    public function fetchAllUser($userID)
    {
        $resultSet = $this->_tableGateway->select(array ('user' => $userId));
        return $resultSet;
    }
}