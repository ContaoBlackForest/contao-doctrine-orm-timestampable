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

namespace Gedmo\Timestampable\Mapping\Driver;

use Doctrine\ORM\Mapping\ClassMetadata;
use Gedmo\Mapping\Driver;

class ContaoDCA extends \Controller implements Driver
{
	/**
	 * original driver if it is available
	 */
	protected $originalDriver = null;

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * {@inheritDoc}
	 *
	 * @param ClassMetadata $meta
	 */
	public function readExtendedMetadata($meta, array &$config)
	{
		$tableName = $meta->getTableName();
		if (!isset($GLOBALS['TL_DCA'][$tableName])) {
			$this->loadDataContainer($tableName);
		}

		$dca    = (array) $GLOBALS['TL_DCA'][$tableName];
		$fields = (array) $dca['fields'];
		foreach ($fields as $fieldName => $field) {
			if (isset($field['field']['timestampable']['on'])) {
				$config[$field['field']['timestampable']['on']][] = $fieldName;
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
