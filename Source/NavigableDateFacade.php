<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-17
 */

declare(strict_types = 1);

namespace NavigableDate;

use DateTime;
use DateTimeZone;

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 */
class NavigableDateFacade
{
    /**
     * @param string $time
     * @param DateTimeZone|null $TimeZone
     *
     * @return NavigableDate
     */
    public static function create(string $time = 'now', ?DateTimeZone $TimeZone = null):NavigableDate
    {
        return self::_getNavigableDateFactory()->create($time, $TimeZone);
    }

    /**
     * @param DateTime $DateTime
     *
     * @return NavigableDate
     */
    public static function createFromDateTime(DateTime $DateTime):NavigableDate
    {
        return self::_getNavigableDateFactory()->createFromDateTime($DateTime);
    }

    /**
     * @return NavigableDateFactory
     */
    private static function _getNavigableDateFactory():NavigableDateFactory
    {
        return NavigableDateLocator::getInstance()->getNavigableDateFactory();
    }
}