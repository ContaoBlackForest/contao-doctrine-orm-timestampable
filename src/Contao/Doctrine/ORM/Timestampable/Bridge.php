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

use Contao\Doctrine\ORM\EntityAccessor;
use Contao\Doctrine\ORM\Event\DuplicateEntity;
use Gedmo\Timestampable\TimestampableListener;

class Bridge
{
	static public function init(\Doctrine\Common\EventManager $eventManager)
	{
		$timestampableListener = new TimestampableListener();
		$eventManager->addEventSubscriber($timestampableListener);
	}

	/**
	 * Clean timestampable entries from duplicated entities.
	 */
	static public function duplicateEntity(DuplicateEntity $event)
	{
		if ($event->getWithoutKeys()) {
			$entity = $event->getEntity();

			if (isset($GLOBALS['TL_DCA'][$entity->entityTableName()]['fields'])) {
				/** @var EntityAccessor $entityAccessor */
				$entityAccessor = $GLOBALS['container']['doctrine.orm.entityAccessor'];

				$fields = (array) $GLOBALS['TL_DCA'][$entity->entityTableName()]['fields'];
				foreach ($fields as $field => $fieldConfig) {
					if (isset($fieldConfig['field']['timestampable'])) {
						$entityAccessor->setRawProperty($entity, $field, null);
					}
				}
			}
		}
	}
}
