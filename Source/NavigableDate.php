<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-14
 */

namespace NavigableDate;

use DateInterval;
use DateTime;
use DateTimeZone;
use Test\NavigableDateTest;

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 * @see    NavigableDateTest
 * @see    NavigableDateTest
 */
class NavigableDate implements NavigableDateInterface
{
    const
        DATE_FORMAT_YEAR = 'Y',
        DATE_FORMAT_MONTH = 'm',
        DATE_FORMAT_DAY = 'd';

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
     * @param DateTime             $DateTime
     * @param DateIntervalFactory  $DateIntervalFactory
     * @param NavigableDateFactory $NavigableDateFactory
     * @param DateTimeFactory      $DateTimeFactory
     */
    public function __construct(
        DateTime $DateTime,
        DateIntervalFactory $DateIntervalFactory,
        NavigableDateFactory $NavigableDateFactory,
        DateTimeFactory $DateTimeFactory
    )
    {
        $this->_DateTime             = $DateTime;
        $this->_DateIntervalFactory  = $DateIntervalFactory;
        $this->_NavigableDateFactory = $NavigableDateFactory;
        $this->_DateTimeFactory      = $DateTimeFactory;
    }

    /**
     * @param bool $resetTime
     * $resetTime set to true resets time for the date to 00:00:00
     *
     * @return NavigableDateInterface
     */
    public function nextDay($resetTime = false)
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
    public function previousDay($resetTime = false)
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
    public function nextMonth($resetTime = false, $resetDays = false)
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
    public function previousMonth($resetTime = false, $resetDays = false)
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
    public function nextYear($resetTime = false, $resetDays = false, $resetMonths = false)
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
    public function previousYear($resetTime = false, $resetDays = false, $resetMonths = false)
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
     * @param int  $days
     * -{$days} means before
     *
     * @param bool $resetTime
     * $resetTime set to true resets time for the date to 00:00:00
     *
     * @return NavigableDateInterface
     */
    public function dateAfter($days, $resetTime = false)
    {
        $DateTime     = $this
            ->_cloneDateTime($this->_DateTime);
        $DateInterval = $this->_createDateInterval(abs($days), 0, 0);
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
    public function format($formatSpec)
    {
        return $this->_DateTime->format($formatSpec);
    }

    /**
     * @return int
     */
    public function getTimestamp()
    {
        return $this->_DateTime->getTimestamp();
    }

    /**
     * @return DateTimeZone
     */
    public function getTimezone()
    {
        return $this->_DateTime->getTimezone();
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->_DateTime->getOffset();
    }

    /**
     * @return DateInterval
     */
    private function _createOneDayInterval()
    {
        return $this->_createDateInterval(1, 0, 0);
    }

    /**
     * @return DateInterval
     */
    private function _createOneMonthInterval()
    {
        return $this->_createDateInterval(0, 1, 0);
    }

    /**
     * @return DateInterval
     */
    private function _createOneYearInterval()
    {
        return $this->_createDateInterval(0, 0, 1);
    }

    /**
     * @param DateTime $DateTime
     * @param bool     $resetTime
     * @param bool     $resetDays
     * @param bool     $resetMonths
     *
     * @return void
     */
    private function _handleResets(DateTime $DateTime, $resetTime = false, $resetDays = false, $resetMonths = false)
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
    private function _getYear(DateTime $DateTime)
    {
        return (int)$DateTime->format(self::DATE_FORMAT_YEAR);
    }

    /**
     * @param DateTime $DateTime
     * @param bool     $resetMonths
     *
     * @return int
     */
    private function _getMonth(DateTime $DateTime, $resetMonths)
    {
        $month = (int)$DateTime->format(self::DATE_FORMAT_MONTH);

        return $resetMonths ? 1 : $month;
    }

    /**
     * @param DateTime $DateTime
     * @param  bool    $resetDays
     *
     * @return int
     */
    private function _getDay(DateTime $DateTime, $resetDays)
    {
        $day = (int)$DateTime->format(self::DATE_FORMAT_DAY);

        return $resetDays ? 1 : $day;
    }

    /**
     * @param DateTime $DateTime
     *
     * @return DateTime
     */
    private function _cloneDateTime(DateTime $DateTime)
    {
        return $this->_DateTimeFactory->createFromDateTime($DateTime);
    }

    /**
     * @param int $days
     * @param int $months
     * @param int $years
     *
     * @return DateInterval
     */
    private function _createDateInterval($days, $months, $years)
    {
        return $this->_DateIntervalFactory->create($days, $months, $years);
    }

    /**
     * @param DateTime $DateTime
     *
     * @return NavigableDate
     */
    private function _createSelf(DateTime $DateTime)
    {
        return $this->_NavigableDateFactory->createFromDateTime($DateTime);
    }
}
