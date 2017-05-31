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

namespace Gedmo\Timestampable\Mapping\Driver;

use Gedmo\Mapping\Driver;

/**
 * Class ContaoDCA
 *
 * @author  Tristan Lins <tristan.lins@bit3.de>
 * @package Gedmo\Timestampable\Mapping\Driver
 */
class ContaoDca extends \Controller implements Driver
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
