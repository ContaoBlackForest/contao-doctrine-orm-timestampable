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
 * @author     Dominik Tomasi <dominik.tomasi@gmail.com>
 * @author     Sven Baumann <baumann.sv@gmail.com>
 * @copyright  2013-2017 Contao Community Alliance.
 * @license    https://github.com/ContaoBlackForest/contao-doctrine-orm-timestampable/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

namespace Contao\Doctrine\ORM\Test\Timestampable\Fixtures;

/**
 * Version entity for tests.
 */
class Version extends \Contao\Doctrine\ORM\Entity\AbstractVersion implements \Contao\Doctrine\ORM\EntityInterface
{
    /**
     * The name the table this entity is stored in.
     */
    const TABLE_NAME = 'orm_version';

    /**
     * The names of the primary key fields.
     */
    const PRIMARY_KEY = 'id';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $entityClass;

    /**
     * @var string
     */
    protected $entityId;

    /**
     * @var string
     */
    protected $entityHash;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var string
     */
    protected $previous;

    /**
     * @var string
     */
    protected $data;

    /**
     * @var string
     */
    protected $changes;

    /**
     * @var integer
     */
    protected $userId;

    /**
     * @var string
     */
    protected $username;


    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return \Contao\Doctrine\ORM\EntityHelper::callGetterCallbacks($this, self::TABLE_NAME, 'id', $this->id);
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Version
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt =
            \Contao\Doctrine\ORM\EntityHelper::callSetterCallbacks($this, self::TABLE_NAME, 'createdAt', $createdAt);

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return \Contao\Doctrine\ORM\EntityHelper::callGetterCallbacks(
            $this,
            self::TABLE_NAME,
            'createdAt',
            $this->createdAt
        );
    }

    /**
     * Set entityClass
     *
     * @param string $entityClass
     *
     * @return Version
     */
    public function setEntityClass($entityClass)
    {
        $this->entityClass = \Contao\Doctrine\ORM\EntityHelper::callSetterCallbacks(
            $this,
            self::TABLE_NAME,
            'entityClass',
            (string) $entityClass
        );

        return $this;
    }

    /**
     * Get entityClass
     *
     * @return string
     */
    public function getEntityClass()
    {
        return \Contao\Doctrine\ORM\EntityHelper::callGetterCallbacks(
            $this,
            self::TABLE_NAME,
            'entityClass',
            $this->entityClass
        );
    }

    /**
     * Set entityId
     *
     * @param string $entityId
     *
     * @return Version
     */
    public function setEntityId($entityId)
    {
        $this->entityId = \Contao\Doctrine\ORM\EntityHelper::callSetterCallbacks(
            $this,
            self::TABLE_NAME,
            'entityId',
            (string) $entityId
        );

        return $this;
    }

    /**
     * Get entityId
     *
     * @return string
     */
    public function getEntityId()
    {
        return \Contao\Doctrine\ORM\EntityHelper::callGetterCallbacks(
            $this,
            self::TABLE_NAME,
            'entityId',
            $this->entityId
        );
    }

    /**
     * Set entityHash
     *
     * @param string $entityHash
     *
     * @return Version
     */
    public function setEntityHash($entityHash)
    {
        $this->entityHash = \Contao\Doctrine\ORM\EntityHelper::callSetterCallbacks(
            $this,
            self::TABLE_NAME,
            'entityHash',
            (string) $entityHash
        );

        return $this;
    }

    /**
     * Get entityHash
     *
     * @return string
     */
    public function getEntityHash()
    {
        return \Contao\Doctrine\ORM\EntityHelper::callGetterCallbacks(
            $this,
            self::TABLE_NAME,
            'entityHash',
            $this->entityHash
        );
    }

    /**
     * Set action
     *
     * @param string $action
     *
     * @return Version
     */
    public function setAction($action)
    {
        $this->action =
            \Contao\Doctrine\ORM\EntityHelper::callSetterCallbacks($this, self::TABLE_NAME, 'action', (string) $action);

        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return \Contao\Doctrine\ORM\EntityHelper::callGetterCallbacks($this, self::TABLE_NAME, 'action', $this->action);
    }

    /**
     * Set previous
     *
     * @param string $previous
     *
     * @return Version
     */
    public function setPrevious($previous = null)
    {
        $this->previous = \Contao\Doctrine\ORM\EntityHelper::callSetterCallbacks(
            $this,
            self::TABLE_NAME,
            'previous',
            $previous === null ? null : (string) $previous
        );

        return $this;
    }

    /**
     * Get previous
     *
     * @return string
     */
    public function getPrevious()
    {
        return \Contao\Doctrine\ORM\EntityHelper::callGetterCallbacks(
            $this,
            self::TABLE_NAME,
            'previous',
            $this->previous
        );
    }

    /**
     * Set data
     *
     * @param string $data
     *
     * @return Version
     */
    public function setData($data)
    {
        $this->data =
            \Contao\Doctrine\ORM\EntityHelper::callSetterCallbacks($this, self::TABLE_NAME, 'data', (string) $data);

        return $this;
    }

    /**
     * Get data
     *
     * @return string
     */
    public function getData()
    {
        return \Contao\Doctrine\ORM\EntityHelper::callGetterCallbacks($this, self::TABLE_NAME, 'data', $this->data);
    }

    /**
     * Set changes
     *
     * @param string $changes
     *
     * @return Version
     */
    public function setChanges($changes = null)
    {
        $this->changes = \Contao\Doctrine\ORM\EntityHelper::callSetterCallbacks(
            $this,
            self::TABLE_NAME,
            'changes',
            $changes === null ? null : (string) $changes
        );

        return $this;
    }

    /**
     * Get changes
     *
     * @return string
     */
    public function getChanges()
    {
        return \Contao\Doctrine\ORM\EntityHelper::callGetterCallbacks(
            $this,
            self::TABLE_NAME,
            'changes',
            $this->changes
        );
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Version
     */
    public function setUserId($userId = null)
    {
        $this->userId = \Contao\Doctrine\ORM\EntityHelper::callSetterCallbacks(
            $this,
            self::TABLE_NAME,
            'userId',
            $userId === null ? null : (int) $userId
        );

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return \Contao\Doctrine\ORM\EntityHelper::callGetterCallbacks($this, self::TABLE_NAME, 'userId', $this->userId);
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Version
     */
    public function setUsername($username = null)
    {
        $this->username = \Contao\Doctrine\ORM\EntityHelper::callSetterCallbacks(
            $this,
            self::TABLE_NAME,
            'username',
            $username === null ? null : (string) $username
        );

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return \Contao\Doctrine\ORM\EntityHelper::callGetterCallbacks(
            $this,
            self::TABLE_NAME,
            'username',
            $this->username
        );
    }

    /**
     * {@inheritdoc}
     */
    static public function entityTableName()
    {
        return static::TABLE_NAME;
    }

    /**
     * {@inheritdoc}
     */
    static public function entityPrimaryKeyNames()
    {
        return explode(',', static::PRIMARY_KEY);
    }
}
