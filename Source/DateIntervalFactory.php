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
 * @see    \Unittest\DateIntervalFactoryTest
 */
class DateIntervalFactory
{
    private const
        _SPEC = 'P%dY%dM%dD';

    /**
     * @param int $days
     * @param int $months
     * @param int $years
     *
     * @return DateInterval
     */
    public function create(int $days, int $months, int $years):DateInterval
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
    private function _getDateIntervalSpec(int $days, int $months, int $years):string
    {
        return sprintf(self::_SPEC, $years, $months, $days);
    }
}