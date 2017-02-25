<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-16
 */

declare(strict_types = 1);

namespace NavigableDate;

use DateTime;
use DateTimeZone;

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 * @see    \Unittest\DateTimeFactoryTest
 */
class DateTimeFactory
{
    /**
     * @param string $time
     * @param DateTimeZone $DateTimeZone
     *
     * @return DateTime
     */
    public function create(string $time = 'now', ?DateTimeZone $DateTimeZone = null):DateTime
    {
        return new DateTime($time, $DateTimeZone);
    }

    /**
     * @param DateTime $DateTime
     *
     * @return DateTime
     */
    public function createFromDateTime(DateTime $DateTime):DateTime
    {
        return clone $DateTime;
    }

    /**
     * @param NavigableDateInterface $NavigableDate
     *
     * @return DateTime
     */
    public function createFromNavigableDate(NavigableDateInterface $NavigableDate):DateTime
    {
        $DateTime = new DateTime();
        $DateTime->setTimezone($NavigableDate->getTimezone());
        $DateTime->setTimestamp($NavigableDate->getTimestamp());
        return $DateTime;
    }
}