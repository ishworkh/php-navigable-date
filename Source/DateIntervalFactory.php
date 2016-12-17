<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-14
 */

namespace NavigableDate;

use DateInterval;

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 * @see    Unittest\DateIntervalFactoryTest
 */
class DateIntervalFactory
{
    const
        SPEC = 'P%dY%dM%dD';

    /**
     * @param int $days
     * @param int $months
     * @param int $years
     *
     * @return DateInterval
     */
    public function create($days, $months, $years)
    {
        return new DateInterval($this->_getDateIntervalSpec($days, $months, $years));
    }

    /**
     * @param int $days
     * @param int $months
     * @param int $years
     *
     * @return string
     */
    private function _getDateIntervalSpec($days, $months, $years)
    {
        return sprintf(self::SPEC, $years, $months, $days);
    }
}