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

use Contao\Doctrine\ORM\Mapping\Driver\ContaoDcaDriver;
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
     * @covers \Gedmo\Timestampable\Mapping\Driver\ContaoDca::__construct
     * @covers \Gedmo\Timestampable\Mapping\Driver\ContaoDca::readExtendedMetadata
     */
    public function testReadExtendedMetadata()
    {
        $this->aliasContaoClass('Controller');

        $contaoDca = new ContaoDca();

        $meta = new ClassMetadata('orm_version');
        $meta->setPrimaryTable(array('name' => 'orm_version'));

        $config = array();
        $contaoDca->readExtendedMetadata($meta, $config);

        $this->assertArrayHasKey('create', $config);
        $this->assertArraySubset(array('createdAt'), $config['create']);
    }

    /**
     * Test if can set the original driver.
     *
     * @covers \Gedmo\Timestampable\Mapping\Driver\ContaoDca::setOriginalDriver
     */
    public function testSetOriginalDriver()
    {
        $contaoDca = new ContaoDca();

        $driver = new ContaoDcaDriver('');

        $contaoDca->setOriginalDriver($driver);

        $this->assertAttributeNotEmpty('originalDriver', $contaoDca);
    }
}
