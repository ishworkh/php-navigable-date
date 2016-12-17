<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-15
 */

namespace NavigableDate;

use DateTime;
use DateTimeZone;
use Unittest\NavigableDateFactoryTest;

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 * @see    NavigableDateFactoryTest
 */
class NavigableDateFactory
{
    /**
     * @var DateIntervalFactory
     */
    private $_DateIntervalFactory;

    /**
     * @var DateTimeFactory
     */
    private $_DateTimeFactory;

    /**
     * NavigableDateFactory constructor.
     *
     * @param DateIntervalFactory $DateIntervalFactory
     * @param DateTimeFactory     $DateTimeFactory
     */
    public function __construct(
        DateIntervalFactory $DateIntervalFactory,
        DateTimeFactory $DateTimeFactory
    )
    {
        $this->_DateIntervalFactory = $DateIntervalFactory;
        $this->_DateTimeFactory     = $DateTimeFactory;
    }

    /**
     * @param string            $time
     * @param DateTimeZone|null $DateTimeZone
     *
     * @return NavigableDate
     */
    public function create($time = 'now', DateTimeZone $DateTimeZone = null)
    {
        return $this->_createNavigableDate($this->_DateTimeFactory->create($time, $DateTimeZone));

    }

    /**
     * @param DateTime $DateTime
     *
     * @return NavigableDate
     */
    public function createFromDateTime(DateTime $DateTime)
    {
        return $this->_createNavigableDate($DateTime);
    }

    /**
     * @param DateTime $DateTime
     *
     * @return NavigableDate
     */
    private function _createNavigableDate(DateTime $DateTime)
    {
        return new NavigableDate(
            $DateTime, $this->_DateIntervalFactory, $this, $this->_DateTimeFactory
        );
    }
}