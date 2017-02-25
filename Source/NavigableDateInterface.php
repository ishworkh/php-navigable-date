<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-14
 */

declare(strict_types = 1);

namespace NavigableDate;

use DateInterval;

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 */
interface NavigableDateInterface extends DateTimeCoreInterface
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
     * @param bool $resetDays // resets day to the first day of the week i.e. Monday
     *
     * @return NavigableDateInterface
     */
    public function nextWeek(bool $resetTime = false, bool $resetDays = false):NavigableDateInterface;

    /**
     * @param bool $resetTime
     * @param bool $resetDays // resets day to the first day of the week i.e. Monday
     *
     * @return NavigableDateInterface
     */
    public function previousWeek(bool $resetTime = false, bool $resetDays = false):NavigableDateInterface;

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
    public function daysAfter(int $days, bool $resetTime = false):NavigableDateInterface;

    /**
     * @param NavigableDateInterface $NavigableDate
     *
     * @return DateInterval
     */
    public function getDifference(NavigableDateInterface $NavigableDate):DateInterval;
}