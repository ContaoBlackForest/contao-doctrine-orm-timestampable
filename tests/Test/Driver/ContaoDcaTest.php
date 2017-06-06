<?php

/**
 * This file is part of contaoblackforest/contao-doctrine-orm-timestampable.
 *
 * (c) 2013-2017 Contao Black Forest.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    contaoblackforest/contao-doctrine-orm-timestampable
 * @author     Sven Baumann <baumann.sv@gmail.com>
 * @copyright  2013-2017 Contao Community Alliance.
 * @license    https://github.com/ContaoBlackForest/contao-doctrine-orm-timestampable/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

namespace Gedmo\Timestampable\Mapping\Test\Driver;

use Contao\Doctrine\ORM\Test\BaseTestCase;
use Doctrine\ORM\Mapping\ClassMetadata;
use Gedmo\Timestampable\Mapping\Driver\ContaoDca;

/**
 * Test class for \Gedmo\Timestampable\Mapping\Driver\ContaoDca
 */
class ContaoDcaTest extends BaseTestCase
{
    /**
     * Test if find property timestamp able who has create on.
     *
     * @covers \Gedmo\Timestampable\Mapping\Driver\ContaoDca::readExtendedMetadata
     * @covers \Gedmo\Timestampable\Mapping\Driver\ContaoDca::loadDataContainer
     */
    public function testReadExtendedMetadata()
    {
        $driver1 = $this->mockForContaoDriver();
        $driver2 = $this->mockForContaoDriver();
        $driver3 = $this->mockForContaoDriver(true);
        $driver4 = $this->mockForContaoDriver(true);
        $driver5 = $this->mockForContaoDriver(true);
        $driver6 = $this->mockForContaoDriver(true);
        $driver7 = $this->mockForContaoDriver(true);
        $driver8 = $this->mockForContaoDriver(true);
        $driver9 = $this->mockForContaoDriver(true);

        $meta1 = new ClassMetadata('foo');
        $meta2 = new ClassMetadata('orm_version');
        $meta3 = new ClassMetadata('orm_version');
        $meta4 = new ClassMetadata('orm_version');
        $meta5 = new ClassMetadata('orm_version');
        $meta6 = new ClassMetadata('orm_version');
        $meta7 = new ClassMetadata('orm_version');
        $meta8 = new ClassMetadata('orm_version');
        $meta9 = new ClassMetadata('orm_version');

        $meta1->setPrimaryTable(array('name' => 'foo'));
        $meta2->setPrimaryTable(array('name' => 'orm_version'));
        $meta3->setPrimaryTable(array('name' => 'orm_version'));
        $meta4->setPrimaryTable(array('name' => 'orm_version'));
        $meta5->setPrimaryTable(array('name' => 'orm_version'));
        $meta6->setPrimaryTable(array('name' => 'orm_version'));
        $meta7->setPrimaryTable(array('name' => 'orm_version'));
        $meta8->setPrimaryTable(array('name' => 'orm_version'));
        $meta9->setPrimaryTable(array('name' => 'orm_version'));

        $config1 = array();
        $config2 = array();
        $config3 = array();
        $config4 = array();
        $config5 = array();
        $config6 = array();
        $config7 = array();
        $config8 = array();
        $config9 = array();

        try {
            $driver1->readExtendedMetadata($meta1, $config1);
        } catch (\Exception $e) {
            $this->assertEquals('Undefined index: TL_DCA', $e->getMessage());
        }
        $this->assertArrayNotHasKey('create', $config1);

        $driver2->readExtendedMetadata($meta2, $config2);
        $this->assertArrayHasKey('create', $config2);
        $this->assertArraySubset(array('createdAt'), $config2['create']);

        $this->setUpDataContainerVersion();
        $driver3->readExtendedMetadata($meta3, $config3);
        $this->assertArrayHasKey('create', $config3);
        $this->assertArraySubset(array('createdAt'), $config3['create']);

        $GLOBALS['TL_DCA']['orm_version']['fields']['createdAt']['field']['timestampable']['on'] = 'foo';
        $driver4->readExtendedMetadata($meta4, $config4);
        $this->assertArrayNotHasKey('create', $config4);

        unset($GLOBALS['TL_DCA']['orm_version']['fields']['createdAt']['field']['timestampable']['on']);
        $driver5->readExtendedMetadata($meta5, $config5);
        $this->assertArrayNotHasKey('create', $config5);

        unset($GLOBALS['TL_DCA']['orm_version']['fields']['createdAt']['field']['timestampable']);
        $driver6->readExtendedMetadata($meta6, $config6);
        $this->assertArrayNotHasKey('create', $config6);

        unset($GLOBALS['TL_DCA']['orm_version']['fields']['createdAt']['field']);
        $driver7->readExtendedMetadata($meta7, $config7);
        $this->assertArrayNotHasKey('create', $config7);

        unset($GLOBALS['TL_DCA']['orm_version']['fields']['createdAt']);
        $driver8->readExtendedMetadata($meta8, $config8);
        $this->assertArrayNotHasKey('create', $config8);

        unset($GLOBALS['TL_DCA']['orm_version']['fields']);
        try {
            $driver9->readExtendedMetadata($meta9, $config9);
        } catch (\Exception $e) {
            $this->assertEquals('Undefined index: fields', $e->getMessage());
        }
        $this->assertArrayNotHasKey('create', $config9);
    }

    /**
     * Test if can set the original driver.
     *
     * @covers \Gedmo\Timestampable\Mapping\Driver\ContaoDca::setOriginalDriver
     */
    public function testSetOriginalDriver()
    {
        $driver = $this->mockForContaoDriver(true);

        $mapping = $this->getMockBuilder('\Contao\Doctrine\ORM\Mapping\Driver\ContaoDcaDriver')
            ->disableOriginalConstructor()
            ->getMock();

        $driver->setOriginalDriver($mapping);

        $this->assertAttributeNotEmpty('originalDriver', $driver);
    }

    /**
     * Mock the contao data container driver.
     *
     * @return ContaoDca|\PHPUnit_Framework_MockObject_MockObject
     */
    private function mockForContaoDriver($never = false)
    {
        $mock = $this
            ->getMockBuilder(
                '\Gedmo\Timestampable\Mapping\Driver\ContaoDca'
            )
            ->setMethods(array('loadDataContainer'))
            ->getMock();

        if (false === $never) {
            $mock->expects($this->once())->method('loadDataContainer')->willReturnCallback(
                function ($tableName) {
                    if ('orm_version' !== $tableName) {
                        return;
                    }

                    $this->setUpDataContainerVersion();
                }
            );
        }

        if (true === $never) {
            $mock->expects($this->never())->method('loadDataContainer')->willReturnCallback(
                function ($tableName) {
                    if ('orm_version' !== $tableName) {
                        return;
                    }

                    $this->setUpDataContainerVersion();
                }
            );
        }

        return $mock;
    }
}
