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

namespace Contao\Doctrine\ORM\Timestampable\Mapping\Driver;

use Doctrine\ORM\Mapping\ClassMetadata;
use Gedmo\Mapping\Driver;

class ContaoDCA extends \Controller implements Driver
{
	/**
	 * original driver if it is available
	 */
	protected $originalDriver = null;

	static public function init(\Doctrine\Common\EventManager $eventManager)
	{
		$timestampableListener = new TimestampableListener();
		$timestampableListener->setAnnotationReader(new static());
		$eventManager->addEventSubscriber($timestampableListener);
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param ClassMetadata $meta
	 */
	public function readExtendedMetadata($meta, array &$config)
	{
		$tableName = $meta->getName();
		$this->loadDataContainer($tableName);
		$dca    = (array) $GLOBALS['TL_DCA'][$tableName];
		$fields = (array) $dca['fields'];
		foreach ($fields as $fieldName => $field) {
			if (isset($field['entity']['timestampable']['on'])) {
				$config[$field['entity']['timestampable']['on']][] = array(
					'field'        => $fieldName,
					'trackedField' => $fieldName,
					'value'        => isset($field['entity']['timestampable']['value'])
						? $field['entity']['timestampable']['value']
						: null
				);
			}
		}
	}

	/**
	 * {@inheritDoc}
	 */
	public function setOriginalDriver($driver)
	{
		$this->originalDriver = $driver;
	}
}
