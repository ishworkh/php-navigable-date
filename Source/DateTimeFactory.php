<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-16
 */

namespace NavigableDate;

use DateTime;
use DateTimeZone;
use Unittest\DateTimeFactoryTest;

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 * @see    DateTimeFactoryTest
 */
class DateTimeFactory
{
    /**
     * @param string       $time
     * @param DateTimeZone $DateTimeZone
     *
     * @return DateTime
     */
    public function create($time = 'now', DateTimeZone $DateTimeZone = null)
    {
        return new DateTime($time, $DateTimeZone);
    }

    /**
     * @param DateTime $DateTime
     *
     * @return DateTime
     */
    public function createFromDateTime(DateTime $DateTime)
    {
        return clone $DateTime;
    }
}