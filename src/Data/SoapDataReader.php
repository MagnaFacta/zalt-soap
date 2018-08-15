<?php

/**
 *
 * @package    Zalt
 * @subpackage Soap\Data
 * @author     Matijs de Jong <mjong@magnafacta.nl>
 * @copyright  Copyright (c) 2018, Erasmus MC and MagnaFacta B.V.
 * @license    New BSD License
 */

namespace Zalt\Soap\Data;

use Zalt\Soap\SoapConnector;
use Zalt\Model\Data\DataReaderInterface;

/**
 *
 * @package    Zalt
 * @subpackage Soap\Data
 * @copyright  Copyright (c) 2018, Erasmus MC and MagnaFacta B.V.
 * @license    New BSD License
 * @since      Class available since version 1.8.4 14-Aug-2018 16:59:31
 */
class SoapDataReader implements DataReaderInterface
{
    /**
     * The name of the data source used for this reader
     *
     * @var string
     */
    protected $_dataSoureName;

    /**
     *
     * @var SoapConnector
     */
    protected $_soapConnector;


    /**
     *
     * @param SoapBridge $soapBridge
     */
    public function __construct(SoapConnector $soapConnector, $dataSoureName)
    {
        $this->_soapConnector = $soapConnector;
        $this->_dataSoureName = $dataSoureName;
    }

    /**
     * Returns a nested array containing the items requested.
     *
     * @param mixed $filter Array to use as filter
     * @param mixed $sort Array to use for sort
     * @return array Nested array or false
     */
    public function load($filter = null, $sort = null)
    {
        return $this->_soapConnector->queryAll($this->_dataSoureName, $filter, $sort);
    }

    /**
     * Returns an array containing the first requested item.
     *
     * @param mixed $filter Array to use as filter
     * @param mixed $sort Array to use for sort
     * @return array An array or false
     */
    public function loadFirst($filter = null, $sort = null)
    {
        return $this->_soapConnector->queryOne($this->_dataSoureName, $filter, $sort);
    }
}
