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

use Zalt\Late\RepeatableInterface;
use Zalt\Model\Data\DataReaderTrait;
use Zalt\Model\MetaModelInterface;
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
    use DataReaderTrait;

    /**
     * @param MetaModelInterface $metaModel
     * @param SoapConnector $soapConnector
     * @param string $dataSoureName
     */
    public function __construct(
        protected MetaModelInterface $metaModel, 
        protected SoapConnector $soapConnector, 
        protected string $dataSoureName)
    {
        $this->dataSoureName = $dataSoureName;
    }

    public function hasNew(): bool
    {
        return false;
    }

    public function getName(): string
    {
        return $this->dataSoureName;
    }

    public function load($filter = null, $sort = null, $columns = null): array
    {
        return $this->soapConnector->queryAll($this->dataSoureName, $filter, $sort);
    }

    public function loadCount($filter = null, $sort = null): int
    {
        return count($this->load($filter, $sort, null));
    }

    public function loadFirst($filter = null, $sort = null, $columns = null): array
    {
        return $this->soapConnector->queryOne($this->dataSoureName, $filter, $sort);
    }

    public function loadPageWithCount(?int &$total, int $page, int $items, $filter = null, $sort = null, $columns = null): array
    {
        $output = $this->load($filter, $sort, null);
        $total  = count($output);

        return array_slice($output, ($page - 1) * $items, $items);
    }
}
