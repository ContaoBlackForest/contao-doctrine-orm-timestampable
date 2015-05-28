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

namespace Contao\Doctrine\ORM\Timestampable\Mapping\Driver;

use Gedmo\Mapping\Driver;

/**
 * Class ContaoDCA
 *
 * @author  Tristan Lins <tristan.lins@bit3.de>
 * @package Gedmo\Timestampable\Mapping\Driver
 */
class ContaoDCA extends \Controller implements Driver
{
    /**
     * original driver if it is available
     */
    protected $originalDriver = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see \Gedmo\Mapping\Driver::readExtendedMetadata()
     * {@inheritdoc}
     */
    public function readExtendedMetadata($meta, array &$config)
    {
        $tableName = $meta->getTableName();
        if (!isset($GLOBALS['TL_DCA'][$tableName])) {
            $this->loadDataContainer($tableName);
        }

        $dca = (array)$GLOBALS['TL_DCA'][$tableName];
        $fields = (array)$dca['fields'];
        foreach ($fields as $fieldName => $field) {
            if (isset($field['field']['timestampable']['on'])) {
                $config[$field['field']['timestampable']['on']][] = $fieldName;
            }
        }
    }

    /**
     * @see \Gedmo\Mapping\Driver::setOriginalDriver()
     * {@inheritdoc}
     */
    public function setOriginalDriver($driver)
    {
        $this->originalDriver = $driver;
    }
}
