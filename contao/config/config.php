<?php

/**
 * Doctrine ORM timestampable bridge
 * Copyright (C) 2013 Tristan Lins
 *
 * PHP version 5
 *
 * @copyright  bit3 UG 2013
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @package    doctrine-orm-timestampable
 * @license    LGPL
 * @filesource
 */

$GLOBALS['TL_HOOKS']['prepareDoctrineEventManager']['doctrine-orm-timestampable'] = array('Contao\Doctrine\ORM\Timestampable\Bridge', 'init');
$GLOBALS['TL_EVENTS'][\Contao\Doctrine\ORM\Event\DuplicateEntity::EVENT_NAME][] = array('Contao\Doctrine\ORM\Timestampable\Bridge', 'duplicateEntity');
