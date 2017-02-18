<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-14
 */

declare(strict_types = 1);

namespace NavigableDate;

use DateInterval;
use DateTime;
use DateTimeZone;

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 * @see    \Unittest\NavigableDateTest
 * @see    \Test\NavigableDateTest
 */
class NavigableDate implements NavigableDateInterface
{
    private const
        _DATE_FORMAT_YEAR = 'Y',
        _DATE_FORMAT_MONTH = 'm',
        _DATE_FORMAT_DAY = 'd';

    /**
     * @var DateTime
     */
    private $_DateTime;

    /**
     * @var DateIntervalFactory
     */
    private $_DateIntervalFactory;

    /**
     * @var NavigableDateFactory
     */
    private $_NavigableDateFactory;

    /**
     * @var DateTimeFactory
     */
    private $_DateTimeFactory;

    /**
     * NavigableDate constructor.
     *
     * @param DateTime $DateTime
     * @param DateIntervalFactory $DateIntervalFactory
     * @param NavigableDateFactory $NavigableDateFactory
     * @param DateTimeFactory $DateTimeFactory
     */
    public function __construct(
        DateTime $DateTime,
        DateIntervalFactory $DateIntervalFactory,
        NavigableDateFactory $NavigableDateFactory,
        DateTimeFactory $DateTimeFactory
    )
    {
        $this->_DateTime = $DateTime;
        $this->_DateIntervalFactory = $DateIntervalFactory;
        $this->_NavigableDateFactory = $NavigableDateFactory;
        $this->_DateTimeFactory = $DateTimeFactory;
    }

    /**
     * @param bool $resetTime
     * $resetTime set to true resets time for the date to 00:00:00
     *
     * @return NavigableDateInterface
     */
    public function nextDay(bool $resetTime = false):NavigableDateInterface
    {
        $DateTime = $this
            ->_cloneDateTime($this->_DateTime);
        $DateTime->add(
            $this->_createOneDayInterval()
        );

        $this->_handleResets($DateTime, $resetTime);

        return $this->_createSelf($DateTime);
    }

    /**
     * @param bool $resetTime
     * $resetTime set to true resets time for the date to 00:00:00
     *
     * @return NavigableDateInterface
     */
    public function previousDay(bool $resetTime = false):NavigableDateInterface
    {
        $DateTime = $this
            ->_cloneDateTime($this->_DateTime);
        $DateTime->sub(
            $this->_createOneDayInterval()
        );

        $this->_handleResets($DateTime, $resetTime);

        return $this->_createSelf($DateTime);
    }

    /**
     * @param bool $resetTime
     * @param bool $resetDays
     *
     * @return NavigableDateInterface
     */
    public function nextMonth(bool $resetTime = false, bool $resetDays = false):NavigableDateInterface
    {
        $DateTime = $this
            ->_cloneDateTime($this->_DateTime);
        $DateTime->add(
            $this->_createOneMonthInterval()
        );
        $this->_handleResets($DateTime, $resetTime, $resetDays);

        return $this->_createSelf($DateTime);
    }

    /**
     * @param bool $resetTime
     * @param bool $resetDays
     *
     * @return NavigableDateInterface
     */
    public function previousMonth(bool $resetTime = false, bool $resetDays = false):NavigableDateInterface
    {
        $DateTime = $this
            ->_cloneDateTime($this->_DateTime);
        $DateTime->sub(
            $this->_createOneMonthInterval()
        );

        $this->_handleResets($DateTime, $resetTime, $resetDays);

        return $this->_createSelf($DateTime);
    }

    /**
     * @param bool $resetTime
     * @param bool $resetDays
     * @param bool $resetMonths
     *
     * @return NavigableDateInterface
     */
    public function nextYear(bool $resetTime = false, bool $resetDays = false, bool $resetMonths = false):NavigableDateInterface
    {
        $DateTime = $this
            ->_cloneDateTime($this->_DateTime);
        $DateTime->add(
            $this->_createOneYearInterval()
        );

        $this->_handleResets($DateTime, $resetTime, $resetDays, $resetMonths);

        return $this->_createSelf($DateTime);
    }

    /**
     * @param bool $resetTime
     * @param bool $resetDays
     * @param bool $resetMonths
     *
     * @return NavigableDateInterface
     */
    public function previousYear(bool $resetTime = false, bool $resetDays = false, bool $resetMonths = false):NavigableDateInterface
    {
        $DateTime = $this
            ->_cloneDateTime($this->_DateTime);
        $DateTime->sub(
            $this->_createOneYearInterval()
        );

        $this->_handleResets($DateTime, $resetTime, $resetDays, $resetMonths);

        return $this->_createSelf($DateTime);
    }

    /**
     * @param int $days
     * -{$days} means before
     *
     * @param bool $resetTime
     * $resetTime set to true resets time for the date to 00:00:00
     *
     * @return NavigableDateInterface
     */
    public function dateAfter(int $days, bool $resetTime = false):NavigableDateInterface
    {
        $DateTime = $this
            ->_cloneDateTime($this->_DateTime);
        $absoluteDaysCount = (int)abs($days);
        $DateInterval = $this->_createDateInterval($absoluteDaysCount, 0, 0);
        if ($days < 0) {
            $DateTime->sub($DateInterval);
        } elseif ($days > 0) {
            $DateTime->add($DateInterval);
        }

        $this->_handleResets($DateTime, $resetTime);

        return $this->_createSelf($DateTime);
    }

    /**
     * @param string $formatSpec
     *
     * @return string
     */
    public function format(string $formatSpec):string
    {
        return $this->_DateTime->format($formatSpec);
    }

    /**
     * @return int
     */
    public function getTimestamp():int
    {
        return $this->_DateTime->getTimestamp();
    }

    /**
     * @return DateTimeZone
     */
    public function getTimezone():DateTimeZone
    {
        return $this->_DateTime->getTimezone();
    }

    /**
     * @return int
     */
    public function getOffset():int
    {
        return $this->_DateTime->getOffset();
    }

    /**
     * @return DateInterval
     */
    private function _createOneDayInterval():DateInterval
    {
        return $this->_createDateInterval(1, 0, 0);
    }

    /**
     * @return DateInterval
     */
    private function _createOneMonthInterval():DateInterval
    {
        return $this->_createDateInterval(0, 1, 0);
    }

    /**
     * @return DateInterval
     */
    private function _createOneYearInterval():DateInterval
    {
        return $this->_createDateInterval(0, 0, 1);
    }

    /**
     * @param DateTime $DateTime
     * @param bool $resetTime
     * @param bool $resetDays
     * @param bool $resetMonths
     *
     * @return void
     */
    private function _handleResets(DateTime $DateTime, bool $resetTime = false, bool $resetDays = false, bool $resetMonths = false):void
    {
        if ($resetTime) {
            $DateTime->setTime(0, 0, 0);
        }

        if ($resetDays || $resetMonths) {
            $DateTime->setDate(
                $this->_getYear($DateTime),
                $this->_getMonth($DateTime, $resetMonths),
                $this->_getDay($DateTime, $resetDays)
            );
        }
    }

    /**
     * @param DateTime $DateTime
     *
     * @return int
     */
    private function _getYear(DateTime $DateTime):int
    {
        return (int)$DateTime->format(self::_DATE_FORMAT_YEAR);
    }

    /**
     * @param DateTime $DateTime
     * @param bool $resetMonths
     *
     * @return int
     */
    private function _getMonth(DateTime $DateTime, bool $resetMonths):int
    {
        $month = (int)$DateTime->format(self::_DATE_FORMAT_MONTH);

        return $resetMonths ? 1 : $month;
    }

    /**
     * @param DateTime $DateTime
     * @param  bool $resetDays
     *
     * @return int
     */
    private function _getDay(DateTime $DateTime, bool $resetDays):int
    {
        $day = (int)$DateTime->format(self::_DATE_FORMAT_DAY);

        return $resetDays ? 1 : $day;
    }

    /**
     * @param DateTime $DateTime
     *
     * @return DateTime
     */
    private function _cloneDateTime(DateTime $DateTime):DateTime
    {
        return $this->_DateTimeFactory->createFromDateTime($DateTime);
    }

    /**
     * @param int $days
     * @param int $months
     * @param int $years
     * @return DateInterval
     */
    private function _createDateInterval(int $days, int $months, int $years):DateInterval
    {
        return $this->_DateIntervalFactory->create($days, $months, $years);
    }

    /**
     * @param DateTime $DateTime
     *
     * @return NavigableDate
     */
    private function _createSelf(DateTime $DateTime):NavigableDate
    {
        return $this->_NavigableDateFactory->createFromDateTime($DateTime);
    }
}
