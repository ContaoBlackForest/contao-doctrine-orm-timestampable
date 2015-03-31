<?php
/**
 * Doctrine ORM timestampable bridge
 *
 * PHP version 5
 *
 * @copyright  ContaoBlackForest <https://github.com/ContaoBlackforest/>
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @author     Dominik Tomasi <dominik.tomasi@gmail.com>
 * @author     Sven Baumann <baumannsv@gmail.com>
 * @package    doctrine-orm-timestampable
 * @license    LGPL
 * @filesource
 */

namespace ContaoBlackForest\Tests\Contao\Doctrine\ORM\Timestampable;


use Contao\Doctrine\ORM\EntityAccessor;
use Contao\Doctrine\ORM\Event\DuplicateEntity;
use ContaoBlackForest\Contao\Doctrine\ORM\Timestampable\Bridge;
use ContaoBlackForest\Tests\Fixtures\Version;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\EventManager;
use Gedmo\Timestampable\TimestampableListener;

/**
 * Class BridgeTest
 *
 * @author Dominik Tomasi <https://github.com/dtomasi>
 * @package ContaoBlackForest\Tests\Contao\Doctrine\ORM\Timestampable
 */
class BridgeTest extends \PHPUnit_Framework_TestCase {

    /**
     * Test to instantiate the Bridge with Namespace ContaoBlackForest
     */
    public function testInstantiateWithCurrentNamespace() {

        $bridge = new \ContaoBlackForest\Contao\Doctrine\ORM\Timestampable\Bridge();
        $this->assertInstanceOf('\ContaoBlackForest\Contao\Doctrine\ORM\Timestampable\Bridge',$bridge);
    }

    /**
     * Test to instantiate the Bridge with Namespace Contao for backwards compatibility
     */
    public function testInstantiateWithOldNamespace() {

        $bridge = new \Contao\Doctrine\ORM\Timestampable\Bridge();
        $this->assertInstanceOf('\ContaoBlackForest\Contao\Doctrine\ORM\Timestampable\Bridge',$bridge);
    }

    /**
     * Test if TimestampableListener can successfully registered in \Doctrine\Common\EventManager
     */
    public function testRegisterSubscriber() {

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
    public function testDuplicateEntity() {

        $entity = new Version();

        // Setup EntityAccessor
        $accessor = new EntityAccessor(new AnnotationReader());
        $GLOBALS['container']['doctrine.orm.entityAccessor'] = $accessor;
        $event = new DuplicateEntity($entity,true);

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
