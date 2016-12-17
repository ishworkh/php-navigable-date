<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-17
 */

namespace NavigableDate;

use DateTime;

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 */
class NavigableDateFacade
{
    /**
     * @param string             $time
     * @param \DateTimeZone|null $TimeZone
     *
     * @return NavigableDate
     */
    public static function create($time = 'now', \DateTimeZone $TimeZone = null)
    {
        return self::_getNavigableDateFactory()->create($time, $TimeZone);
    }

    /**
     * @param DateTime $DateTime
     *
     * @return NavigableDate
     */
    public static function createFromDateTime(DateTime $DateTime)
    {
        return self::_getNavigableDateFactory()->createFromDateTime($DateTime);
    }

    /**
     * @return NavigableDateFactory
     */
    private static function _getNavigableDateFactory()
    {
        return NavigableDateLocator::getInstance()->getNavigableDateFactory();
    }
}