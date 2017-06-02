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

namespace Contao\Doctrine\ORM\Test\Timestampable;

use Contao\Doctrine\ORM\EntityAccessor;
use Contao\Doctrine\ORM\Event\DuplicateEntity;
use Contao\Doctrine\ORM\Test\BaseTestCase;
use Contao\Doctrine\ORM\Test\Timestampable\Fixtures\Version;
use Contao\Doctrine\ORM\Timestampable\Bridge;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\EventManager;
use Gedmo\Timestampable\TimestampableListener;

/**
 * Test class for \Contao\Doctrine\ORM\Timestampable\Bridge.
 */
class BridgeTest extends BaseTestCase
{
    /**
     * Test to instantiate the Bridge with Namespace ContaoBlackForest
     *
     * @covers \Contao\Doctrine\ORM\Timestampable\Bridge
     */
    public function testInstantiateWithCurrentNamespace()
    {
        $bridge = new Bridge();
        $this->assertInstanceOf('\Contao\Doctrine\ORM\Timestampable\Bridge', $bridge);
        $this->assertNotInstanceOf(__CLASS__, $bridge);
    }

    /**
     * Test if TimestampableListener can successfully registered in \Doctrine\Common\EventManager
     *
     * @covers \Contao\Doctrine\ORM\Timestampable\Bridge::init
     */
    public function testRegisterSubscriber()
    {
        $manager1 = new EventManager();
        $manager2 = new EventManager();

        Bridge::init($manager1);
        $listeners1 = $manager1->getListeners('prePersist');


        $instanceInArray1 = false;
        foreach ($listeners1 as $listener1) {
            if ($listener1 instanceof TimestampableListener) {
                $instanceInArray1 = true;
            }
        }

        $listeners2       = array();
        $instanceInArray2 = false;
        foreach ($listeners2 as $listener2) {
            if ($listener2 instanceof TimestampableListener) {
                $instanceInArray2 = true;
            }
        }


        $this->assertTrue($manager1->hasListeners('prePersist'));
        $this->assertTrue($instanceInArray1);

        $this->assertNotTrue($manager2->hasListeners('prePersist'));
        $this->assertNotTrue($instanceInArray2);
    }

    /**
     * Test if EntityAccessor available by dependencies injection
     *
     * @covers \Contao\Doctrine\ORM\Timestampable\Bridge::duplicateEntity
     */
    public function testEntityAccessor()
    {
        $GLOBALS['container']['doctrine.orm.entityAccessor'] = new EntityAccessor(new AnnotationReader());
        $GLOBALS['container']['foo'] = new \stdClass();

        $entityAccessor1 = $GLOBALS['container']['doctrine.orm.entityAccessor'];
        $entityAccessor2 = $GLOBALS['container']['foo'];

        $this->assertArrayHasKey('container', $GLOBALS);
        $this->assertArrayHasKey('doctrine.orm.entityAccessor', $GLOBALS['container']);

        $this->assertInstanceOf('\Contao\Doctrine\ORM\EntityAccessor', $entityAccessor1);
        $this->assertObjectHasAttribute('annotationReader', $entityAccessor1);

        $this->assertNotInstanceOf('\Contao\Doctrine\ORM\EntityAccessor', $entityAccessor2);
        $this->assertObjectNotHasAttribute('annotationReader', $entityAccessor2);
    }

    /**
     * Test if duplicateEntity does not throw any error with a correct configuration
     *
     * @covers \Contao\Doctrine\ORM\Timestampable\Bridge::duplicateEntity
     */
    public function testDuplicateEntity()
    {
        $this->setUpDataContainerVersion();

        $entity1  = new Version();
        $entity11 = new Version();
        $entity12 = new Version();
        $entity13 = new Version();
        $entity2  = new Version();
        $entity21 = new Version();
        $entity22 = new Version();
        $entity23 = new Version();
        $entity3  = new Version();
        $entity31 = new Version();
        $entity32 = new Version();
        $entity33 = new Version();
        $entity4  = new Version();
        $entity41 = new Version();
        $entity42 = new Version();
        $entity43 = new Version();
        $entity5  = new Version();
        $entity51 = new Version();
        $entity52 = new Version();
        $entity53 = new Version();

        $entity1->setCreatedAt(new \DateTime());
        $entity12->setCreatedAt(new \DateTime());
        $entity2->setCreatedAt(new \DateTime());
        $entity22->setCreatedAt(new \DateTime());
        $entity3->setCreatedAt(new \DateTime());
        $entity32->setCreatedAt(new \DateTime());
        $entity4->setCreatedAt(new \DateTime());
        $entity42->setCreatedAt(new \DateTime());
        $entity5->setCreatedAt(new \DateTime());
        $entity52->setCreatedAt(new \DateTime());

        $event1  = new DuplicateEntity($entity1, true);
        $event11 = new DuplicateEntity($entity11, true);
        $event12 = new DuplicateEntity($entity12, false);
        $event13 = new DuplicateEntity($entity13, false);
        $event2  = new DuplicateEntity($entity2, true);
        $event21 = new DuplicateEntity($entity21, true);
        $event22 = new DuplicateEntity($entity22, false);
        $event23 = new DuplicateEntity($entity23, false);
        $event3  = new DuplicateEntity($entity3, true);
        $event31 = new DuplicateEntity($entity31, true);
        $event32 = new DuplicateEntity($entity32, false);
        $event33 = new DuplicateEntity($entity33, false);
        $event4  = new DuplicateEntity($entity4, true);
        $event41 = new DuplicateEntity($entity41, true);
        $event42 = new DuplicateEntity($entity42, false);
        $event43 = new DuplicateEntity($entity43, false);
        $event5  = new DuplicateEntity($entity5, true);
        $event51 = new DuplicateEntity($entity51, true);
        $event52 = new DuplicateEntity($entity52, false);
        $event53 = new DuplicateEntity($entity53, false);

        Bridge::duplicateEntity($event1);
        $this->assertNull($entity1->getCreatedAT());
        Bridge::duplicateEntity($event11);
        $this->assertNull($entity11->getCreatedAT());
        Bridge::duplicateEntity($event12);
        $this->assertNotNull($entity12->getCreatedAT());
        Bridge::duplicateEntity($event13);
        $this->assertNull($entity13->getCreatedAT());

        unset($GLOBALS['TL_DCA']['orm_version']['fields']['createdAt']);
        Bridge::duplicateEntity($event2);
        $this->assertNotNull($entity2->getCreatedAT());
        Bridge::duplicateEntity($event21);
        $this->assertNull($entity21->getCreatedAT());
        Bridge::duplicateEntity($event22);
        $this->assertNotNull($entity22->getCreatedAT());
        Bridge::duplicateEntity($event23);
        $this->assertNull($entity23->getCreatedAT());

        unset($GLOBALS['TL_DCA']['orm_version']['fields']);
        Bridge::duplicateEntity($event3);
        $this->assertNotNull($entity3->getCreatedAT());
        Bridge::duplicateEntity($event31);
        $this->assertNull($entity31->getCreatedAT());
        Bridge::duplicateEntity($event32);
        $this->assertNotNull($entity32->getCreatedAT());
        Bridge::duplicateEntity($event33);
        $this->assertNull($entity33->getCreatedAT());

        unset($GLOBALS['TL_DCA']['orm_version']);
        Bridge::duplicateEntity($event4);
        $this->assertNotNull($entity4->getCreatedAT());
        Bridge::duplicateEntity($event41);
        $this->assertNull($entity41->getCreatedAT());
        Bridge::duplicateEntity($event42);
        $this->assertNotNull($entity42->getCreatedAT());
        Bridge::duplicateEntity($event43);
        $this->assertNull($entity43->getCreatedAT());

        unset($GLOBALS['TL_DCA']);
        Bridge::duplicateEntity($event5);
        $this->assertNotNull($entity5->getCreatedAT());
        Bridge::duplicateEntity($event51);
        $this->assertNull($entity51->getCreatedAT());
        Bridge::duplicateEntity($event52);
        $this->assertNotNull($entity52->getCreatedAT());
        Bridge::duplicateEntity($event53);
        $this->assertNull($entity53->getCreatedAT());
    }
}
