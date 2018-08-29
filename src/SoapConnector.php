<?php

/**
 *
 * @package    Zalt
 * @subpackage Soap
 * @author     Matijs de Jong <mjong@magnafacta.nl>
 * @copyright  Copyright (c) 2018, Erasmus MC and MagnaFacta B.V.
 * @license    New BSD License
 */

namespace Zalt\Soap;

use Zalt\Soap\Exception\SoapConfigurationException;
use Zalt\Soap\Exception\SoapRuntimeException;

/**
 *
 * @package    Zalt
 * @subpackage Soap
 * @copyright  Copyright (c) 2018, Erasmus MC and MagnaFacta B.V.
 * @license    New BSD License
 * @since      Class available since version 1.8.4 14-Aug-2018 16:59:57
 */
class SoapConnector
{
    /**
     *
     * @var array sourceName => callable
     */
    protected $_sources = [];

    /**
     *
     * @param array $sources sourceName => callable
     */
    public function __construct(array $sources = [])
    {
        // \MUtil_Echo::track(array_keys($sources + $this->_sources));
        // Add $this->_sources to check all source for correctness
        foreach ($sources + $this->_sources as $sourceName => $callable) {
            $this->addSource($sourceName, $callable);
        }
    }

    /**
     *
     * @param string $sourceName
     * @param callable $callable
     * @return $this
     * @throws SoapConfigurationException
     */
    public function addSource($sourceName, $callable)
    {
        if (is_callable($callable)) {
            $this->_sources[$sourceName] = $callable;
        } else {
            if (is_callable([$this, $callable])) {
                $this->_sources[$sourceName] = [$this, $callable];
            } else {
                throw new SoapConfigurationException(sprintf('Source %s not set to callable.', $sourceName));
            }
        }

        return $this;
    }

    /**
     *
     * @param string $sourceName
     * @param mixed $filter
     * @param mixed $sort
     * @return mixed array|boolean Array of rows or false
     */
    public function queryAll($sourceName, $filter = [], $sort = [])
    {
        if (isset($this->_sources[$sourceName])) {
            $callable = $this->_sources[$sourceName];

            return $callable($filter, $sort);
        } else {
            throw new SoapRuntimeException(sprintf('Requested data for unknown source %s.', $sourceName));
        }
    }

    /**
     *
     * @param string $sourceName
     * @param mixed $filter
     * @param mixed $sort
     * @return mixed array|boolean One row or false
     */
    public function queryOne($sourceName, $filter = [], $sort = [])
    {
        $output = $this->queryAll($sourceName, $filter, $sort);

        if (is_array($output)) {
            return reset($output);
        } else {
            return false;
        }
    }
}
