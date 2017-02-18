<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-14
 */

declare(strict_types = 1);

namespace NavigableDate;

use DateTimeZone;

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 */
interface NavigableDateInterface
{
    /**
     * @param bool $resetTime
     * $resetTime set to true resets time for the date to 00:00:00
     *
     * @return NavigableDateInterface
     */
    public function nextDay(bool $resetTime = false):NavigableDateInterface;

    /**
     * @param bool $resetTime
     * $resetTime set to true resets time for the date to 00:00:00
     *
     * @return NavigableDateInterface
     */
    public function previousDay(bool $resetTime = false):NavigableDateInterface;

    /**
     * @param bool $resetTime
     * @param bool $resetDays
     *
     * @return NavigableDateInterface
     */
    public function nextMonth(bool $resetTime = false, bool $resetDays = false):NavigableDateInterface;

    /**
     * @param bool $resetTime
     * @param bool $resetDays
     *
     * @return NavigableDateInterface
     */
    public function previousMonth(bool $resetTime = false, bool $resetDays = false):NavigableDateInterface;

    /**
     * @param bool $resetTime
     * @param bool $resetDays
     * @param bool $resetMonths
     *
     * @return NavigableDateInterface
     */
    public function nextYear(bool $resetTime = false, bool $resetDays = false, bool $resetMonths = false):NavigableDateInterface;

    /**
     * @param bool $resetTime
     * @param bool $resetDays
     * @param bool $resetMonths
     *
     * @return NavigableDateInterface
     */
    public function previousYear(bool $resetTime = false, bool $resetDays = false, bool $resetMonths = false):NavigableDateInterface;

    /**
     * @param int $days
     * -{$days} means before
     *
     * @param bool $resetTime
     * $resetTime set to true resets time for the date to 00:00:00
     *
     * @return NavigableDateInterface
     */
    public function dateAfter(int $days, bool $resetTime = false):NavigableDateInterface;

    /**
     * @param string $formatSpec
     *
     * @return string
     */
    public function format(string $formatSpec):string;

    /**
     * @return int
     */
    public function getTimestamp():int;

    /**
     * @return DateTimeZone
     */
    public function getTimezone():DateTimeZone;

    /**
     * @return int
     */
    public function getOffset():int;
}