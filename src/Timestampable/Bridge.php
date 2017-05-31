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

namespace Contao\Doctrine\ORM\Timestampable;

use Contao\Doctrine\ORM\EntityAccessor;
use Contao\Doctrine\ORM\Event\DuplicateEntity;
use Doctrine\Common\EventManager;
use Gedmo\Timestampable\TimestampableListener;

/**
 * Class Bridge
 *
 * @author Tristan Lins <tristan.lins@bit3.de>
 * @package ContaoBlackForest\Contao\Doctrine\ORM\Timestampable
 */
class Bridge
{
    /**
     * Initialize the Bridge
     *
     * @param EventManager $eventManager
     */
    public static function init(EventManager $eventManager)
    {
        $timestampableListener = new TimestampableListener();
        $eventManager->addEventSubscriber($timestampableListener);
    }

    /**
     * Clean timestampable entries from duplicated entities.
     *
     * @param DuplicateEntity $event
     */
    public static function duplicateEntity(DuplicateEntity $event)
    {
        if ($event->getWithoutKeys()) {
            $entity = $event->getEntity();

            if (isset($GLOBALS['TL_DCA'][$entity->entityTableName()]['fields'])) {
                /** @var EntityAccessor $entityAccessor */
                $entityAccessor = $GLOBALS['container']['doctrine.orm.entityAccessor'];

                $fields = (array)$GLOBALS['TL_DCA'][$entity->entityTableName()]['fields'];
                foreach ($fields as $field => $fieldConfig) {
                    if (isset($fieldConfig['field']['timestampable'])) {
                        $entityAccessor->setRawProperty($entity, $field, null);
                    }
                }
            }
        }
    }
}
