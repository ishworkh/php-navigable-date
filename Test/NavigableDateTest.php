<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-15
 */

namespace Test;

use DateTime;
use NavigableDate\NavigableDate;
use NavigableDate\NavigableDateLocator;

require_once __DIR__ . '/BaseTest.php';

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 * @see    NavigableDate
 */
class NavigableDateTest extends BaseTest
{
    /**
     * @param string $date
     * @param string $expectedNextDayDate
     * @param bool   $resetTime
     *
     * @return void
     *
     * @dataProvider nextDayDataProvider
     */
    public function testNextDay($date, $expectedNextDayDate, $resetTime)
    {
        $NavigableDate = NavigableDateLocator::getInstance()->getNavigableDateFactory()->create($date);

        self::assertSame($expectedNextDayDate, $NavigableDate->nextDay($resetTime)->format('Y-m-d H:i:s'));
    }

    /**
     * @return array
     */
    public function nextDayDataProvider()
    {
        return [
            [
                '2016-12-15 11:00:00', '2016-12-16 11:00:00', false,
            ],
            [
                '2016-12-15 11:00:00', '2016-12-16 00:00:00', true,
            ],
            [
                '2016-12-31 11:00:00', '2017-01-01 11:00:00', false,
            ],
            [
                '2016-12-31 11:00:00', '2017-01-01 00:00:00', true,
            ],
        ];
    }

    /**
     * @param string $date
     * @param string $expectedPreviousDayDate
     * @param bool   $resetTime
     *
     * @return void
     *
     * @dataProvider previousDayDataProvider
     */
    public function testPreviousDay($date, $expectedPreviousDayDate, $resetTime)
    {
        $NavigableDate = NavigableDateLocator::getInstance()->getNavigableDateFactory()->create($date);

        self::assertSame($expectedPreviousDayDate, $NavigableDate->previousDay($resetTime)->format('Y-m-d H:i:s'));
    }

    /**
     * @return array
     */
    public function previousDayDataProvider()
    {
        return [
            [
                '2016-12-15 11:00:00', '2016-12-14 11:00:00', false,
            ],
            [
                '2016-12-15 11:00:00', '2016-12-14 00:00:00', true,
            ],
            [
                '2017-01-01 11:00:00', '2016-12-31 11:00:00', false,
            ],
            [
                '2017-01-01 11:00:00', '2016-12-31 00:00:00', true,
            ],
        ];
    }

    /**
     * @param string $date
     * @param string $expectedNextMonthDate
     * @param bool   $resetTime
     * @param bool   $resetDays
     *
     * @return void
     *
     * @dataProvider nextMonthDataProvider
     */
    public function testNextMonth($date, $expectedNextMonthDate, $resetTime, $resetDays)
    {
        $NavigableDate = NavigableDateLocator::getInstance()->getNavigableDateFactory()->create($date);

        self::assertSame(
            $expectedNextMonthDate, $NavigableDate->nextMonth($resetTime, $resetDays)->format('Y-m-d H:i:s')
        );
    }

    /**
     * @return array
     */
    public function nextMonthDataProvider()
    {
        return [
            [
                '2016-11-15 11:00:00', '2016-12-15 11:00:00', false, false,
            ],
            [
                '2016-11-15 11:00:00', '2016-12-15 00:00:00', true, false,
            ],
            [
                '2016-12-31 11:00:00', '2017-01-31 11:00:00', false, false,
            ],
            [
                '2016-12-31 11:00:00', '2017-01-31 00:00:00', true, false,
            ],
            [
                '2016-11-15 11:00:00', '2016-12-01 11:00:00', false, true,
            ],
            [
                '2016-11-15 11:00:00', '2016-12-01 00:00:00', true, true,
            ],
            [
                '2016-12-31 11:00:00', '2017-01-01 11:00:00', false, true,
            ],
            [
                '2016-12-31 11:00:00', '2017-01-01 00:00:00', true, true,
            ],
        ];
    }

    /**
     * @param string $date
     * @param string $expectedPreviousMonthDate
     * @param bool   $resetTime
     * @param bool   $resetDays
     *
     * @return void
     *
     * @dataProvider nextPreviousDataProvider
     */
    public function testPreviousMonth($date, $expectedPreviousMonthDate, $resetTime, $resetDays)
    {
        $NavigableDate = NavigableDateLocator::getInstance()->getNavigableDateFactory()->create($date);

        self::assertSame(
            $expectedPreviousMonthDate, $NavigableDate->previousMonth($resetTime, $resetDays)->format('Y-m-d H:i:s')
        );
    }

    /**
     * @return array
     */
    public function nextPreviousDataProvider()
    {
        return [
            [
                '2016-11-15 11:00:00', '2016-10-15 11:00:00', false, false,
            ],
            [
                '2016-11-15 11:00:00', '2016-10-15 00:00:00', true, false,
            ],
            [
                '2016-12-29 11:00:00', '2016-11-29 11:00:00', false, false,
            ],
            [
                '2016-12-29 11:00:00', '2016-11-29 00:00:00', true, false,
            ],
            [
                '2016-11-15 11:00:00', '2016-10-01 11:00:00', false, true,
            ],
            [
                '2016-11-15 11:00:00', '2016-10-01 00:00:00', true, true,
            ],
            [
                '2016-12-29 11:00:00', '2016-11-01 11:00:00', false, true,
            ],
            [
                '2016-12-29 11:00:00', '2016-11-01 00:00:00', true, true,
            ],
        ];
    }

    /**
     * @param string $date
     * @param string $expectedNextMonthDate
     * @param bool   $resetTime
     * @param bool   $resetDays
     * @param bool   $resetMonths
     *
     * @return void
     *
     * @dataProvider nextYearDataProvider
     */
    public function testNextYear($date, $expectedNextMonthDate, $resetTime, $resetDays, $resetMonths)
    {
        $NavigableDate = NavigableDateLocator::getInstance()->getNavigableDateFactory()->create($date);

        self::assertSame(
            $expectedNextMonthDate,
            $NavigableDate->nextYear($resetTime, $resetDays, $resetMonths)->format('Y-m-d H:i:s')
        );
    }

    /**
     * @return array
     */
    public function nextYearDataProvider()
    {
        return [
            [
                '2016-11-15 11:00:00', '2017-11-15 11:00:00', false, false, false,
            ],
            [
                '2016-11-15 11:00:00', '2017-11-15 00:00:00', true, false, false,
            ],
            [
                '2016-12-29 11:00:00', '2017-12-29 11:00:00', false, false, false,
            ],
            [
                '2016-12-29 11:00:00', '2017-12-29 00:00:00', true, false, false,
            ],
            [
                '2016-11-15 11:00:00', '2017-11-01 11:00:00', false, true, false,
            ],
            [
                '2016-11-15 11:00:00', '2017-11-01 00:00:00', true, true, false,
            ],
            [
                '2016-12-29 11:00:00', '2017-12-01 11:00:00', false, true, false,
            ],
            [
                '2016-12-29 11:00:00', '2017-12-01 00:00:00', true, true, false,
            ],
            [
                '2016-11-15 11:00:00', '2017-01-15 11:00:00', false, false, true,
            ],
            [
                '2016-11-15 11:00:00', '2017-01-15 00:00:00', true, false, true,
            ],
            [
                '2016-12-29 11:00:00', '2017-01-29 11:00:00', false, false, true,
            ],
            [
                '2016-12-29 11:00:00', '2017-01-29 00:00:00', true, false, true,
            ],
            [
                '2016-11-15 11:00:00', '2017-01-01 11:00:00', false, true, true,
            ],
            [
                '2016-11-15 11:00:00', '2017-01-01 00:00:00', true, true, true,
            ],
            [
                '2016-12-29 11:00:00', '2017-01-01 11:00:00', false, true, true,
            ],
            [
                '2016-12-29 11:00:00', '2017-01-01 00:00:00', true, true, true,
            ],
        ];
    }

    /**
     * @param string $date
     * @param string $expectedNextMonthDate
     * @param bool   $resetTime
     * @param bool   $resetDays
     * @param bool   $resetMonths
     *
     * @return void
     *
     * @dataProvider previousYearDataProvider
     */
    public function testPreviousYear($date, $expectedNextMonthDate, $resetTime, $resetDays, $resetMonths)
    {
        $NavigableDate = NavigableDateLocator::getInstance()->getNavigableDateFactory()->create($date);

        self::assertSame(
            $expectedNextMonthDate,
            $NavigableDate->previousYear($resetTime, $resetDays, $resetMonths)->format('Y-m-d H:i:s')
        );
    }

    /**
     * @return array
     */
    public function previousYearDataProvider()
    {
        return [
            [
                '2016-11-15 11:00:00', '2015-11-15 11:00:00', false, false, false,
            ],
            [
                '2016-11-15 11:00:00', '2015-11-15 00:00:00', true, false, false,
            ],
            [
                '2016-12-29 11:00:00', '2015-12-29 11:00:00', false, false, false,
            ],
            [
                '2016-12-29 11:00:00', '2015-12-29 00:00:00', true, false, false,
            ],
            [
                '2016-11-15 11:00:00', '2015-11-01 11:00:00', false, true, false,
            ],
            [
                '2016-11-15 11:00:00', '2015-11-01 00:00:00', true, true, false,
            ],
            [
                '2016-12-29 11:00:00', '2015-12-01 11:00:00', false, true, false,
            ],
            [
                '2016-12-29 11:00:00', '2015-12-01 00:00:00', true, true, false,
            ],
            [
                '2016-11-15 11:00:00', '2015-01-15 11:00:00', false, false, true,
            ],
            [
                '2016-11-15 11:00:00', '2015-01-15 00:00:00', true, false, true,
            ],
            [
                '2016-12-29 11:00:00', '2015-01-29 11:00:00', false, false, true,
            ],
            [
                '2016-12-29 11:00:00', '2015-01-29 00:00:00', true, false, true,
            ],
            [
                '2016-11-15 11:00:00', '2015-01-01 11:00:00', false, true, true,
            ],
            [
                '2016-11-15 11:00:00', '2015-01-01 00:00:00', true, true, true,
            ],
            [
                '2016-12-29 11:00:00', '2015-01-01 11:00:00', false, true, true,
            ],
            [
                '2016-12-29 11:00:00', '2015-01-01 00:00:00', true, true, true,
            ],
        ];
    }

    /**
     * @param string $format
     *
     * @return void
     *
     * @dataProvider formatDataProvider
     */
    public function testFormat($format)
    {

        $DateTime      = new DateTime();
        $NavigableDate = NavigableDateLocator::getInstance()->getNavigableDateFactory()->createFromDateTime($DateTime);

        self::assertSame($DateTime->format($format), $NavigableDate->format($format));
    }

    /**
     * @return array
     */
    public function formatDataProvider()
    {
        return [
            [
                'Y-m-d h:i:s',
            ],
            [
                'Y-m-d',
            ],
            [
                'h:i:s',
            ],
            [
                'Y-m-d H:i:s',
            ],
        ];
    }

    public function testGetTimestamp()
    {
        $DateTime      = new DateTime();
        $NavigableDate = NavigableDateLocator::getInstance()->getNavigableDateFactory()->createFromDateTime($DateTime);

        self::assertSame($DateTime->getTimestamp(), $NavigableDate->getTimestamp());
    }

    public function testGetTimeZone()
    {
        $DateTime      = new DateTime();
        $NavigableDate = NavigableDateLocator::getInstance()->getNavigableDateFactory()->createFromDateTime($DateTime);

        self::assertEquals($DateTime->getTimezone(), $NavigableDate->getTimezone());
    }

    public function testGetOffset()
    {
        $DateTime      = new DateTime();
        $NavigableDate = NavigableDateLocator::getInstance()->getNavigableDateFactory()->createFromDateTime($DateTime);

        self::assertSame($DateTime->getOffset(), $NavigableDate->getOffset());
    }
}