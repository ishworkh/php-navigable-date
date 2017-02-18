<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-15
 */

declare(strict_types = 1);

namespace NavigableDate;

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 */
final class NavigableDateLocator
{
    /**
     * @var NavigableDateLocator
     */
    private static $_Instance;

    /**
     * @return NavigableDateLocator
     */
    public static function getInstance():NavigableDateLocator
    {
        if (null === self::$_Instance) {
            self::$_Instance = new self();
        }

        return self::$_Instance;
    }

    /**
     * NavigableDateLocator constructor.
     */
    private function __construct()
    {
    }

    /**
     * @var DateIntervalFactory
     */
    private $_DateIntervalFactory;

    /**
     * @return DateIntervalFactory
     */
    public function getDateIntervalFactory():DateIntervalFactory
    {
        if (null === $this->_DateIntervalFactory) {
            $this->_DateIntervalFactory = new DateIntervalFactory();
        }

        return $this->_DateIntervalFactory;
    }

    /**
     * @param DateIntervalFactory $DateIntervalFactory
     *
     * @return NavigableDateLocator
     */
    public function setDateIntervalFactory(?DateIntervalFactory $DateIntervalFactory = null):self
    {
        $this->_DateIntervalFactory = $DateIntervalFactory;

        return $this;
    }

    /**
     * @var DateTimeFactory
     */
    private $_DateTimeFactory;

    /**
     * @return DateTimeFactory
     */
    public function getDateTimeFactory():DateTimeFactory
    {
        if (null === $this->_DateTimeFactory) {
            $this->_DateTimeFactory = new DateTimeFactory();
        }

        return $this->_DateTimeFactory;
    }

    /**
     * @param DateTimeFactory $DateTimeFactory
     *
     * @return NavigableDateLocator
     */
    public function setDateTimeFactory(?DateTimeFactory $DateTimeFactory = null):self
    {
        $this->_DateTimeFactory = $DateTimeFactory;

        return $this;
    }

    /**
     * @var NavigableDateFactory
     */
    private $_NavigableDateFactory;

    /**
     * @return NavigableDateFactory
     */
    public function getNavigableDateFactory():NavigableDateFactory
    {
        if (null === $this->_NavigableDateFactory) {
            $this->_NavigableDateFactory = new NavigableDateFactory(
                $this->getDateIntervalFactory(),
                $this->getDateTimeFactory()
            );
        }

        return $this->_NavigableDateFactory;
    }

    /**
     * @param NavigableDateFactory $NavigableDateFactory
     *
     * @return NavigableDateLocator
     */
    public function setNavigableDateFactory(?NavigableDateFactory $NavigableDateFactory = null):self
    {
        $this->_NavigableDateFactory = $NavigableDateFactory;

        return $this;
    }
}