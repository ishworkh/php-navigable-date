<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-14
 */

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
    public function nextDay($resetTime = false);

    /**
     * @param bool $resetTime
     * $resetTime set to true resets time for the date to 00:00:00
     *
     * @return NavigableDateInterface
     */
    public function previousDay($resetTime = false);

    /**
     * @param bool $resetTime
     * @param bool $resetDays
     *
     * @return NavigableDateInterface
     */
    public function nextMonth($resetTime = false, $resetDays = false);

    /**
     * @param bool $resetTime
     * @param bool $resetDays
     *
     * @return NavigableDateInterface
     */
    public function previousMonth($resetTime = false, $resetDays = false);

    /**
     * @param bool $resetTime
     * @param bool $resetDays
     * @param bool $resetMonths
     *
     * @return NavigableDateInterface
     */
    public function nextYear($resetTime = false, $resetDays = false, $resetMonths = false);

    /**
     * @param bool $resetTime
     * @param bool $resetDays
     * @param bool $resetMonths
     *
     * @return NavigableDateInterface
     */
    public function previousYear($resetTime = false, $resetDays = false, $resetMonths = false);

    /**
     * @param int  $days
     * -{$days} means before
     *
     * @param bool $resetTime
     * $resetTime set to true resets time for the date to 00:00:00
     *
     * @return NavigableDateInterface
     */
    public function dateAfter($days, $resetTime = false);

    /**
     * @param string $formatSpec
     *
     * @return string
     */
    public function format($formatSpec);

    /**
     * @return int
     */
    public function getTimestamp();

    /**
     * @return DateTimeZone
     */
    public function getTimezone();

    /**
     * @return int
     */
    public function getOffset();
}