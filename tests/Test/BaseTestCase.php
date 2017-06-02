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

namespace Contao\Doctrine\ORM\Test;

/**
 * The base test case for give some things for use in all phpunit tests.
 */
abstract class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Set alias for contao classes to use own for can use phpunit tests.
     *
     * @param string $class The class name.
     *
     * @return void
     */
    protected function aliasContaoClass($class)
    {
        class_alias('\\Contao\\Doctrine\\ORM\\Test\\Helper\\Contao\\' . $class, $class);
    }

    /**
     * Setup the data container version for tests.
     *
     * @return void
     */
    public static function setUpDataContainerVersion()
    {
        $GLOBALS['TL_DCA']['orm_version'] = array(
            'fields' => array(

                'id'        => array(
                    'field' => array(
                        'id'   => true,
                        'type' => 'integer',
                    )
                ),
                'createdAt' => array(
                    'field' => array(
                        'type'          => 'datetime',
                        'nullable'      => true,
                        'timestampable' => array('on' => 'create')
                    )
                )
            )
        );
    }
}
