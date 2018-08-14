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
     *
     * @var SoapConnector
     */
    protected $_soapConnector;


    /**
     *
     * @param SoapBridge $soapBridge
     */
    public function __construct(SoapConnector $soapConnector)
    {
        $this->_soapConnector = $soapConnector;
    }

    /**
     * Returns a nested array containing the items requested.
     *
     * @param mixed $filter Array to use as filter
     * @param mixed $sort Array to use for sort
     * @return array Nested array or false
     */
    public function load($filter = true, $sort = true)
    {

    }

    /**
     * Returns an array containing the first requested item.
     *
     * @param mixed $filter Array to use as filter
     * @param mixed $sort Array to use for sort
     * @return array An array or false
     */
    public function loadFirst($filter = true, $sort = true)
    {

    }
}
