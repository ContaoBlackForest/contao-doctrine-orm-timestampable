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

namespace Contao\Doctrine\ORM\Test\Helper\Contao;

use Contao\Doctrine\ORM\Test\BaseTestCase;

/**
 * The contao controller helper for can eval phpunit tests.
 */
class Controller
{
    /**
     * Controller constructor.
     */
    public function __construct()
    {
    }

    /**
     * Emulate for load the data container.
     *
     * @param string     $tableName
     *
     * @param bool $blnNoCache
     *
     * @return void
     */
    public static function loadDataContainer($tableName, $blnNoCache=false)
    {
        if ('orm_version' !== $tableName) {
            return;
        }

        BaseTestCase::setUpDataContainerVersion();
    }
}
