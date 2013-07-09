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

namespace Contao\Doctrine\ORM\Timestampable;

use Gedmo\Timestampable\TimestampableListener;

class Bridge
{
	static public function init(\Doctrine\Common\EventManager $eventManager)
	{
		$timestampableListener = new TimestampableListener();
		$eventManager->addEventSubscriber($timestampableListener);
	}
}
