<?php

declare(strict_types=1);

/**
 * @package    Zalt
 * @subpackage test
 * @author     Matijs de Jong <mjong@magnafacta.nl>
 */

namespace Zalt\Soap;

/**
 * @package    Zalt
 * @subpackage test
 * @since      Class available since version 1.0
 */
class ConnectTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateConnection()
    {
        $conn = new SoapConnector([]);

        $this->assertInstanceOf(SoapConnector::class, $conn);
    }
}