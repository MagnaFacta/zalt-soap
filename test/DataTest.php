<?php

declare(strict_types=1);

/**
 * @package    Zalt
 * @subpackage test
 * @author     Matijs de Jong <mjong@magnafacta.nl>
 */

namespace Zalt\Soap;

use Zalt\Loader\ProjectOverloader;
use Zalt\Loader\ProjectOverloaderFactory;
use Zalt\Base\TranslatorInterface;
use Zalt\Mock\MockTranslator;
use Zalt\Mock\SimpleServiceManager;
use Zalt\Model\MetaModelLoader;
use Zalt\Model\MetaModelLoaderFactory;
use Zalt\Soap\Data\SoapDataReader;

/**
 * @package    Zalt
 * @subpackage test
 * @since      Class available since version 1.0
 */
class DataTest extends \PHPUnit\Framework\TestCase
{
    public array $serverManagerConfig = [];

    public function getModelLoader(): MetaModelLoader
    {
        static $loader;

        if ($loader instanceof MetaModelLoader) {
            return $loader;
        }

        $sm = $this->getServiceManager();
        $overFc = new ProjectOverloaderFactory();
        $sm->set(ProjectOverloader::class, $overFc($sm));

        $mmlf   = new MetaModelLoaderFactory();
        $loader = $mmlf($sm);

        return $loader;
    }

    public function getServiceManager(): SimpleServiceManager
    {
        static $sm;

        if (! $sm instanceof SimpleServiceManager) {
            $sm = new SimpleServiceManager(['config' => $this->serverManagerConfig]);

            $sm->set(TranslatorInterface::class, new MockTranslator());
        }

        return $sm;
    }

    public function testCreateData()
    {
        $loader = $this->getModelLoader();
        $datareader = new SoapDataReader($loader->createMetaModel('test'), new SoapConnector([]), 'test');

        $this->assertInstanceOf(SoapDataReader::class, $datareader);
    }
}