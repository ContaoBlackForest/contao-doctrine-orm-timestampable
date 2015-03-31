<?php

/**
 * Doctrine ORM timestampable bridge
 *
 * PHP version 5
 *
 * @copyright  ContaoBlackForest <https://github.com/ContaoBlackForest/>
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @author     Dominik Tomasi <dominik.tomasi@gmail.com>
 * @author     Sven Baumann <baumannsv@gmail.com>
 * @package    doctrine-orm-timestampable
 * @license    LGPL
 * @filesource
 */

$GLOBALS['TL_HOOKS']['prepareDoctrineEventManager']['doctrine-orm-timestampable'] = array(
    'ContaoBlackForest\Contao\Doctrine\ORM\Timestampable\Bridge',
    'init'
);
$GLOBALS['TL_EVENTS'][\Contao\Doctrine\ORM\EntityEvents::DUPLICATE_ENTITY][] = array(
    'ContaoBlackForest\Contao\Doctrine\ORM\Timestampable\Bridge',
    'duplicateEntity'
);
