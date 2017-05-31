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
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @author     Dominik Tomasi <dominik.tomasi@gmail.com>
 * @author     Sven Baumann <baumann.sv@gmail.com>
 * @copyright  2013-2017 Contao Community Alliance.
 * @license    https://github.com/ContaoBlackForest/contao-doctrine-orm-timestampable/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

$GLOBALS['TL_HOOKS']['prepareDoctrineEventManager']['doctrine-orm-timestampable'] = array(
    'Contao\Doctrine\ORM\Timestampable\Bridge',
    'init'
);
$GLOBALS['TL_EVENTS'][\Contao\Doctrine\ORM\EntityEvents::DUPLICATE_ENTITY][] = array(
    'Contao\Doctrine\ORM\Timestampable\Bridge',
    'duplicateEntity'
);
