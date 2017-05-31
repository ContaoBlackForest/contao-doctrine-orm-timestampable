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
 * @author     Dominik Tomasi <dominik.tomasi@gmail.com>
 * @author     Sven Baumann <baumann.sv@gmail.com>
 * @copyright  2013-2017 Contao Community Alliance.
 * @license    https://github.com/ContaoBlackForest/contao-doctrine-orm-timestampable/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

namespace Contao\Doctrine\ORM\Timestampable\Tests;


use Contao\Doctrine\ORM\EntityAccessor;
use Contao\Doctrine\ORM\Event\DuplicateEntity;
use Contao\Doctrine\ORM\Timestampable\Bridge;
use Contao\Doctrine\ORM\Timestampable\Tests\Fixtures\Version;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\EventManager;
use Gedmo\Timestampable\TimestampableListener;

/**
 * Class BridgeTest
 *
 * @author  Dominik Tomasi <https://github.com/dtomasi>
 * @package ContaoBlackForest\Tests\Contao\Doctrine\ORM\Timestampable
 */
class BridgeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test to instantiate the Bridge with Namespace ContaoBlackForest
     */
    public function testInstantiateWithCurrentNamespace()
    {

        $bridge = new Bridge();
        $this->assertInstanceOf('\Contao\Doctrine\ORM\Timestampable\Bridge', $bridge);
    }

    /**
     * Test if TimestampableListener can successfully registered in \Doctrine\Common\EventManager
     */
    public function testRegisterSubscriber()
    {

        $manager = new EventManager();
        Bridge::init($manager);
        $this->assertTrue($manager->hasListeners('prePersist'));
        $listeners = $manager->getListeners('prePersist');

        $instanceInArray = false;
        foreach ($listeners as $listener) {
            if ($listener instanceof TimestampableListener) {
                $instanceInArray = true;
            }
        }
        $this->assertTrue($instanceInArray);
    }

    /**
     * Test if duplicateEntity does not throw any error with a correct configuration
     */
    public function testDuplicateEntity()
    {

        $entity = new Version();

        // Setup EntityAccessor
        $accessor = new EntityAccessor(new AnnotationReader());
        $GLOBALS['container']['doctrine.orm.entityAccessor'] = $accessor;
        $event = new DuplicateEntity($entity, true);

        $GLOBALS['TL_DCA'] = array(
            'orm_version' => array(
                'id' => array(
                    'field' => array(
                        'id' => true,
                        'type' => 'integer',
                    )
                ),
                'createdAt' => array(
                    'field' => array(
                        'type' => 'datetime',
                        'nullable' => true,
                        'timestampable' => array('on' => 'create')
                    )
                ),
            )
        );

        Bridge::duplicateEntity($event);
    }
}
