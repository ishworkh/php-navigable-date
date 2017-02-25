<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-15
 */

declare(strict_types = 1);

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
    private const _TEST_DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * @param string $date
     * @param string $expectedNextDayDate
     * @param bool $resetTime
     *
     * @return void
     *
     * @dataProvider nextDayDataProvider
     */
    public function testNextDay(string $date, string $expectedNextDayDate, bool $resetTime)
    {
        $NavigableDate = $this->_createNavigableDate($date);

        self::assertSame($expectedNextDayDate, $NavigableDate->nextDay($resetTime)->format(self::_TEST_DATE_FORMAT));
    }

    /**
     * @return array
     */
    public function nextDayDataProvider():array
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
     * @param bool $resetTime
     *
     * @return void
     *
     * @dataProvider previousDayDataProvider
     */
    public function testPreviousDay(string $date, string $expectedPreviousDayDate, bool $resetTime)
    {
        $NavigableDate = $this->_createNavigableDate($date);

        self::assertSame($expectedPreviousDayDate, $NavigableDate->previousDay($resetTime)->format(self::_TEST_DATE_FORMAT));
    }

    /**
     * @return array
     */
    public function previousDayDataProvider():array
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
     * @param string $expectedNextWeekDate
     * @param bool $resetTime
     * @param bool $resetDays
     *
     * @dataProvider nextWeekDataProvider
     */
    public function testNextWeek(string $date, string $expectedNextWeekDate, bool $resetTime, bool $resetDays)
    {
        $NavigableDate = $this->_createNavigableDate($date);

        self::assertSame($expectedNextWeekDate, $NavigableDate->nextWeek($resetTime, $resetDays)->format(self::_TEST_DATE_FORMAT));
    }

    /**
     * @return array
     */
    public function nextWeekDataProvider():array
    {
        return [
            [
                '2017-02-24 11:00:00', '2017-03-03 11:00:00', false, false,
            ],
            [
                '2017-03-04 11:00:00', '2017-03-11 00:00:00', true, false,
            ],
            [
                '2017-03-31 11:00:00', '2017-04-07 11:00:00', false, false,
            ],
            [
                '2016-12-31 11:00:00', '2017-01-07 00:00:00', true, false,
            ],
            [
                '2017-02-24 11:00:00', '2017-02-27 11:00:00', false, true,
            ],
            [
                '2017-03-04 11:00:00', '2017-03-06 00:00:00', true, true,
            ],
            [
                '2017-03-31 11:00:00', '2017-04-03 11:00:00', false, true,
            ],
            [
                '2016-12-31 11:00:00', '2017-01-02 00:00:00', true, true,
            ],
        ];
    }

    /**
     * @param string $date
     * @param string $expectedPreviousWeekDate
     * @param bool $resetTime
     * @param bool $resetDays
     *
     * @dataProvider previousWeekDataProvider
     */
    public function testPreviousWeek(string $date, string $expectedPreviousWeekDate, bool $resetTime, bool $resetDays)
    {
        $NavigableDate = $this->_createNavigableDate($date);

        self::assertSame($expectedPreviousWeekDate, $NavigableDate->previousWeek($resetTime, $resetDays)->format(self::_TEST_DATE_FORMAT));
    }

    /**
     * @return array
     */
    public function previousWeekDataProvider():array
    {
        return [
            [
                '2017-02-24 11:00:00', '2017-02-17 11:00:00', false, false,
            ],
            [
                '2017-03-04 11:00:00', '2017-02-25 00:00:00', true, false,
            ],
            [
                '2017-03-31 11:00:00', '2017-03-24 11:00:00', false, false,
            ],
            [
                '2017-01-01 11:00:00', '2016-12-25 00:00:00', true, false,
            ],
            [
                '2017-02-24 11:00:00', '2017-02-13 11:00:00', false, true,
            ],
            [
                '2017-03-04 11:00:00', '2017-02-20 00:00:00', true, true,
            ],
            [
                '2017-04-01 11:00:00', '2017-03-20 11:00:00', false, true,
            ],
            [
                '2017-01-01 11:00:00', '2016-12-19 00:00:00', true, true,
            ],
        ];
    }

    /**
     * @param string $date
     * @param string $expectedNextMonthDate
     * @param bool $resetTime
     * @param bool $resetDays
     *
     * @return void
     *
     * @dataProvider nextMonthDataProvider
     */
    public function testNextMonth(string $date, string $expectedNextMonthDate, bool $resetTime, bool $resetDays)
    {
        $NavigableDate = $this->_createNavigableDate($date);

        self::assertSame(
            $expectedNextMonthDate, $NavigableDate->nextMonth($resetTime, $resetDays)->format(self::_TEST_DATE_FORMAT)
        );
    }

    /**
     * @return array
     */
    public function nextMonthDataProvider():array
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
     * @param bool $resetTime
     * @param bool $resetDays
     *
     * @return void
     *
     * @dataProvider nextPreviousDataProvider
     */
    public function testPreviousMonth(string $date, string $expectedPreviousMonthDate, bool $resetTime, bool $resetDays)
    {
        $NavigableDate = $this->_createNavigableDate($date);

        self::assertSame(
            $expectedPreviousMonthDate, $NavigableDate->previousMonth($resetTime, $resetDays)->format(self::_TEST_DATE_FORMAT)
        );
    }

    /**
     * @return array
     */
    public function nextPreviousDataProvider():array
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
     * @param bool $resetTime
     * @param bool $resetDays
     * @param bool $resetMonths
     *
     * @return void
     *
     * @dataProvider nextYearDataProvider
     */
    public function testNextYear(string $date, string $expectedNextMonthDate, bool $resetTime, bool $resetDays, bool $resetMonths)
    {
        $NavigableDate = $this->_createNavigableDate($date);

        self::assertSame(
            $expectedNextMonthDate,
            $NavigableDate->nextYear($resetTime, $resetDays, $resetMonths)->format(self::_TEST_DATE_FORMAT)
        );
    }

    /**
     * @return array
     */
    public function nextYearDataProvider():array
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
     * @param bool $resetTime
     * @param bool $resetDays
     * @param bool $resetMonths
     *
     * @return void
     *
     * @dataProvider previousYearDataProvider
     */
    public function testPreviousYear(string $date, string $expectedNextMonthDate, bool $resetTime, bool $resetDays, bool $resetMonths)
    {
        $NavigableDate = $this->_createNavigableDate($date);

        self::assertSame(
            $expectedNextMonthDate,
            $NavigableDate->previousYear($resetTime, $resetDays, $resetMonths)->format(self::_TEST_DATE_FORMAT)
        );
    }

    /**
     * @return array
     */
    public function previousYearDataProvider():array
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
    public function testFormat(string $format)
    {

        $DateTime = new DateTime();
        $NavigableDate = NavigableDateLocator::getInstance()->getNavigableDateFactory()->createFromDateTime($DateTime);

        self::assertSame($DateTime->format($format), $NavigableDate->format($format));
    }

    /**
     * @return array
     */
    public function formatDataProvider():array
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
                self::_TEST_DATE_FORMAT,
            ],
        ];
    }

    public function testGetTimestamp()
    {
        $DateTime = new DateTime();
        $NavigableDate = NavigableDateLocator::getInstance()->getNavigableDateFactory()->createFromDateTime($DateTime);

        self::assertSame($DateTime->getTimestamp(), $NavigableDate->getTimestamp());
    }

    public function testGetTimeZone()
    {
        $DateTime = new DateTime();
        $NavigableDate = NavigableDateLocator::getInstance()->getNavigableDateFactory()->createFromDateTime($DateTime);

        self::assertEquals($DateTime->getTimezone(), $NavigableDate->getTimezone());
    }

    public function testGetOffset()
    {
        $DateTime = new DateTime();
        $NavigableDate = NavigableDateLocator::getInstance()->getNavigableDateFactory()->createFromDateTime($DateTime);

        self::assertSame($DateTime->getOffset(), $NavigableDate->getOffset());
    }

    public function testGetDifference()
    {
        $date1 = '2017-02-24 00:00:00';
        $Date1 = new DateTime($date1);
        $NavigableDate1 = $this->_createNavigableDate($date1);

        $date2 = '2017-02-15 12:00:00';
        $Date2 = new DateTime($date2);
        $NavigableDate2 = $this->_createNavigableDate($date2);

        self::assertSame($Date2->diff($Date1)->format('%Y%m%d %h%i%s'), $NavigableDate2->getDifference($NavigableDate1)->format('%Y%m%d %h%i%s'));
    }

    /**
     * @param string $date
     * @return NavigableDate
     */
    private function _createNavigableDate(string $date):NavigableDate
    {
        return NavigableDateLocator::getInstance()->getNavigableDateFactory()->create($date);
    }
}