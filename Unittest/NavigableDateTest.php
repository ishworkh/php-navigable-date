<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-15
 */

declare(strict_types = 1);

namespace Unittest;

require_once __DIR__ . '/BaseUnittest.php';

use DateInterval;
use DateTime;
use DateTimeZone;
use NavigableDate\DateIntervalFactory;
use NavigableDate\DateTimeFactory;
use NavigableDate\NavigableDate;
use NavigableDate\NavigableDateFactory;
use NavigableDate\NavigableDateInterface;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 * @see    NavigableDate
 */
class NavigableDateTest extends BaseUnittest
{
    public function testInterface()
    {
        $NavigableDate = new NavigableDate(
            $this->_createMockedDateTime(),
            $this->_createMockedDateIntervalFactory(),
            $this->_createMockedNavigableDateFactory(),
            $this->_createMockedDateTimeFactory()
        );

        self::assertInstanceOf(NavigableDateInterface::class, $NavigableDate);
    }

    /**
     * @param bool $resetTime
     *
     * @return void
     *
     * @dataProvider resetTimeBoolDataProvider
     */
    public function testNextDay(bool $resetTime)
    {
        $DateTime = $this->_createMockedDateTime();

        $OneDayInterval = $this->_createMockedDateInterval();
        $DateIntervalFactory = $this->_createMockedDateIntervalFactory();
        $DateIntervalFactory->expects(self::once())
            ->method('create')
            ->with(1, 0, 0)
            ->willReturn($OneDayInterval);

        $CloneDateTime = $this->_createMockedDateTime();


        $CloneDateTime->expects(self::once())
            ->method('add')
            ->with($OneDayInterval);

        $expectedTimes = self::never();
        if ($resetTime) {
            $expectedTimes = self::once();
        }
        $CloneDateTime->expects($expectedTimes)
            ->method('setTime')
            ->with(0, 0, 0);

        $DateTimeFactory = $this->_createMockedDateTimeFactory();
        $DateTimeFactory->expects(self::once())
            ->method('createFromDateTime')
            ->with($DateTime)
            ->willReturn($CloneDateTime);

        $NextDayNavigableDate = $this->_createMockedNavigableDate();
        $NavigableDateFactory = $this->_createMockedNavigableDateFactory();
        $NavigableDateFactory->expects(self::once())
            ->method('createFromDateTime')
            ->with($CloneDateTime)
            ->willReturn($NextDayNavigableDate);

        $NavigableDate = new NavigableDate($DateTime, $DateIntervalFactory, $NavigableDateFactory, $DateTimeFactory);
        self::assertSame($NextDayNavigableDate, $NavigableDate->nextDay($resetTime));
    }

    /**
     * @param bool $resetTime
     *
     * @return void
     *
     * @dataProvider resetTimeBoolDataProvider
     */
    public function testPreviousDay(bool $resetTime)
    {
        $DateTime = $this->_createMockedDateTime();

        $OneDayInterval = $this->_createMockedDateInterval();
        $DateIntervalFactory = $this->_createMockedDateIntervalFactory();
        $DateIntervalFactory->expects(self::once())
            ->method('create')
            ->with(1, 0, 0)
            ->willReturn($OneDayInterval);

        $CloneDateTime = $this->_createMockedDateTime();


        $CloneDateTime->expects(self::once())
            ->method('sub')
            ->with($OneDayInterval);

        $expectedTimes = self::never();
        if ($resetTime) {
            $expectedTimes = self::once();
        }
        $CloneDateTime->expects($expectedTimes)
            ->method('setTime')
            ->with(0, 0, 0);

        $DateTimeFactory = $this->_createMockedDateTimeFactory();
        $DateTimeFactory->expects(self::once())
            ->method('createFromDateTime')
            ->with($DateTime)
            ->willReturn($CloneDateTime);

        $NextDayNavigableDate = $this->_createMockedNavigableDate();
        $NavigableDateFactory = $this->_createMockedNavigableDateFactory();
        $NavigableDateFactory->expects(self::once())
            ->method('createFromDateTime')
            ->with($CloneDateTime)
            ->willReturn($NextDayNavigableDate);

        $NavigableDate = new NavigableDate($DateTime, $DateIntervalFactory, $NavigableDateFactory, $DateTimeFactory);
        self::assertSame($NextDayNavigableDate, $NavigableDate->previousDay($resetTime));
    }

    /**
     * @param bool $resetTime
     * @param bool $resetDays
     *
     * @return void
     *
     * @dataProvider resetTimeDaysBoolDataProvider
     */
    public function testNextWeek(bool $resetTime, bool $resetDays)
    {
        $DateTime = $this->_createMockedDateTime();

        $OneWeekInterval = $this->_createMockedDateInterval();
        $DateIntervalFactory = $this->_createMockedDateIntervalFactory();

        $CloneDateTime = $this->_createMockedDateTime();
        $CloneDateTime->expects(self::once())
            ->method('add')
            ->with($OneWeekInterval);

        $setTimeExpectedTimes = self::never();
        if ($resetTime) {
            $setTimeExpectedTimes = self::once();
        }
        $CloneDateTime->expects($setTimeExpectedTimes)
            ->method('setTime')
            ->with(0, 0, 0);

        if ($resetDays) {
            $expectedDayOfWeek = 3;

            $ToBeSubstractedIntervalToResetDays = $this->_createMockedDateInterval();
            $DateIntervalFactory->expects(self::exactly(2))
                ->method('create')
                ->withConsecutive([7, 0, 0], [$expectedDayOfWeek - 1 , 0, 0])
                ->willReturnOnConsecutiveCalls($OneWeekInterval, $ToBeSubstractedIntervalToResetDays);

            $CloneDateTime->expects(self::once())
                ->method('format')
                ->with('N')
                ->willReturn(strval($expectedDayOfWeek));

            $CloneDateTime->expects(self::once())
                ->method('sub')
                ->with($ToBeSubstractedIntervalToResetDays);

        } else {
            $DateIntervalFactory->expects(self::once())
                ->method('create')
                ->with(7, 0, 0)
                ->willReturn($OneWeekInterval);
        }

        $DateTimeFactory = $this->_createMockedDateTimeFactory();
        $DateTimeFactory->expects(self::once())
            ->method('createFromDateTime')
            ->with($DateTime)
            ->willReturn($CloneDateTime);

        $NextWeekNavigableDate = $this->_createMockedNavigableDate();
        $NavigableDateFactory = $this->_createMockedNavigableDateFactory();
        $NavigableDateFactory->expects(self::once())
            ->method('createFromDateTime')
            ->with($CloneDateTime)
            ->willReturn($NextWeekNavigableDate);

        $NavigableDate = new NavigableDate($DateTime, $DateIntervalFactory, $NavigableDateFactory, $DateTimeFactory);
        self::assertSame($NextWeekNavigableDate, $NavigableDate->nextWeek($resetTime, $resetDays));
    }

    /**
     * @param bool $resetTime
     * @param bool $resetDays
     *
     * @return void
     *
     * @dataProvider resetTimeDaysBoolDataProvider
     */
    public function testPreviousWeek(bool $resetTime, bool $resetDays)
    {
        $DateTime = $this->_createMockedDateTime();

        $OneWeekInterval = $this->_createMockedDateInterval();
        $DateIntervalFactory = $this->_createMockedDateIntervalFactory();

        $CloneDateTime = $this->_createMockedDateTime();
        $CloneDateTime->expects(self::never())
            ->method('add');

        $setTimeExpectedTimes = self::never();
        if ($resetTime) {
            $setTimeExpectedTimes = self::once();
        }
        $CloneDateTime->expects($setTimeExpectedTimes)
            ->method('setTime')
            ->with(0, 0, 0);

        if ($resetDays) {
            $expectedDayOfWeek = 3;

            $ToBeSubstractedIntervalToResetDays = $this->_createMockedDateInterval();
            $DateIntervalFactory->expects(self::exactly(2))
                ->method('create')
                ->withConsecutive([7, 0, 0], [$expectedDayOfWeek - 1 , 0, 0])
                ->willReturnOnConsecutiveCalls($OneWeekInterval, $ToBeSubstractedIntervalToResetDays);

            $CloneDateTime->expects(self::once())
                ->method('format')
                ->with('N')
                ->willReturn(strval($expectedDayOfWeek));

            $CloneDateTime->expects(self::exactly(2))
                ->method('sub')
                ->withConsecutive([$OneWeekInterval], [$ToBeSubstractedIntervalToResetDays]);

        } else {
            $CloneDateTime->expects(self::once())
                ->method('sub')
                ->with($OneWeekInterval);

            $DateIntervalFactory->expects(self::once())
                ->method('create')
                ->with(7, 0, 0)
                ->willReturn($OneWeekInterval);
        }

        $DateTimeFactory = $this->_createMockedDateTimeFactory();
        $DateTimeFactory->expects(self::once())
            ->method('createFromDateTime')
            ->with($DateTime)
            ->willReturn($CloneDateTime);

        $PreviousWeekNavigableDate = $this->_createMockedNavigableDate();
        $NavigableDateFactory = $this->_createMockedNavigableDateFactory();
        $NavigableDateFactory->expects(self::once())
            ->method('createFromDateTime')
            ->with($CloneDateTime)
            ->willReturn($PreviousWeekNavigableDate);

        $NavigableDate = new NavigableDate($DateTime, $DateIntervalFactory, $NavigableDateFactory, $DateTimeFactory);
        self::assertSame($PreviousWeekNavigableDate, $NavigableDate->previousWeek($resetTime, $resetDays));
    }

    /**
     * @param bool $resetTime
     * @param bool $resetDays
     *
     * @return void
     *
     * @dataProvider resetTimeDaysBoolDataProvider
     */
    public function testNextMonth(bool $resetTime, bool $resetDays)
    {
        $DateTime = $this->_createMockedDateTime();

        $OneMonthInterval = $this->_createMockedDateInterval();
        $DateIntervalFactory = $this->_createMockedDateIntervalFactory();
        $DateIntervalFactory->expects(self::once())
            ->method('create')
            ->with(0, 1, 0)
            ->willReturn($OneMonthInterval);

        $CloneDateTime = $this->_createMockedDateTime();


        $CloneDateTime->expects(self::once())
            ->method('add')
            ->with($OneMonthInterval);

        $setTimeExpectedTimes = self::never();
        if ($resetTime) {
            $setTimeExpectedTimes = self::once();
        }
        $CloneDateTime->expects($setTimeExpectedTimes)
            ->method('setTime')
            ->with(0, 0, 0);

        if ($resetDays) {
            $expectedYear = 2016;
            $expectedMonth = 7;
            $expectedDay = 23;

            $CloneDateTime->expects(self::exactly(3))
                ->method('format')
                ->withConsecutive(['Y'], ['m'], ['d'])
                ->willReturnOnConsecutiveCalls(strval($expectedYear), strval($expectedMonth), strval($expectedDay));

            $CloneDateTime->expects(self::once())
                ->method('setDate')
                ->with($expectedYear, $expectedMonth, 1);
        } else {
            $CloneDateTime->expects(self::never())
                ->method('setDate');
        }

        $DateTimeFactory = $this->_createMockedDateTimeFactory();
        $DateTimeFactory->expects(self::once())
            ->method('createFromDateTime')
            ->with($DateTime)
            ->willReturn($CloneDateTime);

        $NextDayNavigableDate = $this->_createMockedNavigableDate();
        $NavigableDateFactory = $this->_createMockedNavigableDateFactory();
        $NavigableDateFactory->expects(self::once())
            ->method('createFromDateTime')
            ->with($CloneDateTime)
            ->willReturn($NextDayNavigableDate);

        $NavigableDate = new NavigableDate($DateTime, $DateIntervalFactory, $NavigableDateFactory, $DateTimeFactory);
        self::assertSame($NextDayNavigableDate, $NavigableDate->nextMonth($resetTime, $resetDays));
    }

    /**
     * @param bool $resetTime
     * @param bool $resetDays
     *
     * @return void
     *
     * @dataProvider resetTimeDaysBoolDataProvider
     */
    public function testPreviousMonth(bool $resetTime, bool $resetDays)
    {
        $DateTime = $this->_createMockedDateTime();

        $OneMonthInterval = $this->_createMockedDateInterval();
        $DateIntervalFactory = $this->_createMockedDateIntervalFactory();
        $DateIntervalFactory->expects(self::once())
            ->method('create')
            ->with(0, 1, 0)
            ->willReturn($OneMonthInterval);

        $CloneDateTime = $this->_createMockedDateTime();
        $CloneDateTime->expects(self::once())
            ->method('sub')
            ->with($OneMonthInterval);

        $setTimeExpectedTimes = self::never();
        if ($resetTime) {
            $setTimeExpectedTimes = self::once();
        }
        $CloneDateTime->expects($setTimeExpectedTimes)
            ->method('setTime')
            ->with(0, 0, 0);

        if ($resetDays) {
            $expectedYear = 2016;
            $expectedMonth = 7;
            $expectedDay = 23;

            $CloneDateTime->expects(self::exactly(3))
                ->method('format')
                ->withConsecutive(['Y'], ['m'], ['d'])
                ->willReturnOnConsecutiveCalls(strval($expectedYear), strval($expectedMonth), strval($expectedDay));

            $CloneDateTime->expects(self::once())
                ->method('setDate')
                ->with($expectedYear, $expectedMonth, 1);
        } else {
            $CloneDateTime->expects(self::never())
                ->method('setDate');
        }

        $DateTimeFactory = $this->_createMockedDateTimeFactory();
        $DateTimeFactory->expects(self::once())
            ->method('createFromDateTime')
            ->with($DateTime)
            ->willReturn($CloneDateTime);

        $NextDayNavigableDate = $this->_createMockedNavigableDate();
        $NavigableDateFactory = $this->_createMockedNavigableDateFactory();
        $NavigableDateFactory->expects(self::once())
            ->method('createFromDateTime')
            ->with($CloneDateTime)
            ->willReturn($NextDayNavigableDate);

        $NavigableDate = new NavigableDate($DateTime, $DateIntervalFactory, $NavigableDateFactory, $DateTimeFactory);
        self::assertSame($NextDayNavigableDate, $NavigableDate->previousMonth($resetTime, $resetDays));
    }

    /**
     * @param bool $resetTime
     * @param bool $resetDays
     * @param bool $resetMonths
     *
     * @return void
     *
     * @dataProvider resetTimeDaysMonthsBoolDataProvider
     */
    public function testNextYear(bool $resetTime, bool $resetDays, bool $resetMonths)
    {
        $DateTime = $this->_createMockedDateTime();

        $OneYearInterval = $this->_createMockedDateInterval();
        $DateIntervalFactory = $this->_createMockedDateIntervalFactory();
        $DateIntervalFactory->expects(self::once())
            ->method('create')
            ->with(0, 0, 1)
            ->willReturn($OneYearInterval);

        $CloneDateTime = $this->_createMockedDateTime();
        $CloneDateTime->expects(self::once())
            ->method('add')
            ->with($OneYearInterval);

        $setTimeExpectedTimes = self::never();
        if ($resetTime) {
            $setTimeExpectedTimes = self::once();
        }
        $CloneDateTime->expects($setTimeExpectedTimes)
            ->method('setTime')
            ->with(0, 0, 0);

        if ($resetDays || $resetMonths) {
            $expectedYear = 2016;
            $expectedMonth = 7;
            $expectedDay = 23;

            $CloneDateTime->expects(self::exactly(3))
                ->method('format')
                ->withConsecutive(['Y'], ['m'], ['d'])
                ->willReturnOnConsecutiveCalls(strval($expectedYear), strval($expectedMonth), strval($expectedDay));

            $CloneDateTime->expects(self::once())
                ->method('setDate')
                ->with(
                    $expectedYear,
                    $resetMonths ? 1 : $expectedMonth,
                    $resetDays ? 1 : $expectedDay
                );
        } else {
            $CloneDateTime->expects(self::never())
                ->method('setDate');
        }

        $DateTimeFactory = $this->_createMockedDateTimeFactory();
        $DateTimeFactory->expects(self::once())
            ->method('createFromDateTime')
            ->with($DateTime)
            ->willReturn($CloneDateTime);

        $NextDayNavigableDate = $this->_createMockedNavigableDate();
        $NavigableDateFactory = $this->_createMockedNavigableDateFactory();
        $NavigableDateFactory->expects(self::once())
            ->method('createFromDateTime')
            ->with($CloneDateTime)
            ->willReturn($NextDayNavigableDate);

        $NavigableDate = new NavigableDate($DateTime, $DateIntervalFactory, $NavigableDateFactory, $DateTimeFactory);
        self::assertSame($NextDayNavigableDate, $NavigableDate->nextYear($resetTime, $resetDays, $resetMonths));
    }

    /**
     * @param bool $resetTime
     * @param bool $resetDays
     * @param bool $resetMonths
     *
     * @return void
     *
     * @dataProvider resetTimeDaysMonthsBoolDataProvider
     */
    public function testPreviousYear(bool $resetTime, bool $resetDays, bool $resetMonths)
    {
        $DateTime = $this->_createMockedDateTime();

        $OneYearInterval = $this->_createMockedDateInterval();
        $DateIntervalFactory = $this->_createMockedDateIntervalFactory();
        $DateIntervalFactory->expects(self::once())
            ->method('create')
            ->with(0, 0, 1)
            ->willReturn($OneYearInterval);

        $CloneDateTime = $this->_createMockedDateTime();
        $CloneDateTime->expects(self::once())
            ->method('sub')
            ->with($OneYearInterval);

        $setTimeExpectedTimes = self::never();
        if ($resetTime) {
            $setTimeExpectedTimes = self::once();
        }
        $CloneDateTime->expects($setTimeExpectedTimes)
            ->method('setTime')
            ->with(0, 0, 0);

        if ($resetDays || $resetMonths) {
            $expectedYear = 2016;
            $expectedMonth = 7;
            $expectedDay = 23;

            $CloneDateTime->expects(self::exactly(3))
                ->method('format')
                ->withConsecutive(['Y'], ['m'], ['d'])
                ->willReturnOnConsecutiveCalls(strval($expectedYear), strval($expectedMonth), strval($expectedDay));

            $CloneDateTime->expects(self::once())
                ->method('setDate')
                ->with(
                    $expectedYear,
                    $resetMonths ? 1 : $expectedMonth,
                    $resetDays ? 1 : $expectedDay
                );
        } else {
            $CloneDateTime->expects(self::never())
                ->method('setDate');
        }

        $DateTimeFactory = $this->_createMockedDateTimeFactory();
        $DateTimeFactory->expects(self::once())
            ->method('createFromDateTime')
            ->with($DateTime)
            ->willReturn($CloneDateTime);

        $NextDayNavigableDate = $this->_createMockedNavigableDate();
        $NavigableDateFactory = $this->_createMockedNavigableDateFactory();
        $NavigableDateFactory->expects(self::once())
            ->method('createFromDateTime')
            ->with($CloneDateTime)
            ->willReturn($NextDayNavigableDate);

        $NavigableDate = new NavigableDate($DateTime, $DateIntervalFactory, $NavigableDateFactory, $DateTimeFactory);
        self::assertSame($NextDayNavigableDate, $NavigableDate->previousYear($resetTime, $resetDays, $resetMonths));
    }

    /**
     * @param int $daysAfter
     * @param bool $resetTime
     *
     * @return void
     *
     * @dataProvider dateAfterDataProvider
     */
    public function testDateAfter(int $daysAfter, bool $resetTime)
    {
        $DateTime = $this->_createMockedDateTime();

        $OneDayInterval = $this->_createMockedDateInterval();
        $DateIntervalFactory = $this->_createMockedDateIntervalFactory();
        $DateIntervalFactory->expects(self::once())
            ->method('create')
            ->with(abs($daysAfter), 0, 0)
            ->willReturn($OneDayInterval);

        $CloneDateTime = $this->_createMockedDateTime();

        if ($daysAfter < 0) {
            $CloneDateTime->expects(self::once())
                ->method('sub')
                ->with($OneDayInterval);
        } else if ($daysAfter > 0) {
            $CloneDateTime->expects(self::once())
                ->method('add')
                ->with($OneDayInterval);
        } else {
            $CloneDateTime->expects(self::never())
                ->method('add');
            $CloneDateTime->expects(self::never())
                ->method('sub');
        }

        $expectedTimes = self::never();
        if ($resetTime) {
            $expectedTimes = self::once();
        }
        $CloneDateTime->expects($expectedTimes)
            ->method('setTime')
            ->with(0, 0, 0);

        $DateTimeFactory = $this->_createMockedDateTimeFactory();
        $DateTimeFactory->expects(self::once())
            ->method('createFromDateTime')
            ->with($DateTime)
            ->willReturn($CloneDateTime);

        $NextDayNavigableDate = $this->_createMockedNavigableDate();
        $NavigableDateFactory = $this->_createMockedNavigableDateFactory();
        $NavigableDateFactory->expects(self::once())
            ->method('createFromDateTime')
            ->with($CloneDateTime)
            ->willReturn($NextDayNavigableDate);

        $NavigableDate = new NavigableDate($DateTime, $DateIntervalFactory, $NavigableDateFactory, $DateTimeFactory);
        self::assertSame($NextDayNavigableDate, $NavigableDate->daysAfter($daysAfter, $resetTime));
    }

    public function testFormat()
    {
        $format = 'format';
        $expectedFormatted = 'lbalblab:)';

        $DateTime = $this->_createMockedDateTime();
        $DateTime->expects(self::once())
            ->method('format')
            ->with($format)
            ->willReturn($expectedFormatted);

        $DateIntervalFactory = $this->_createMockedDateIntervalFactory();
        $DateTimeFactory = $this->_createMockedDateTimeFactory();
        $NavigableDateFactory = $this->_createMockedNavigableDateFactory();

        $NavigableDate = new NavigableDate($DateTime, $DateIntervalFactory, $NavigableDateFactory, $DateTimeFactory);

        self::assertSame($expectedFormatted, $NavigableDate->format($format));
    }

    public function testGetTimeZone()
    {
        $expectedTimeZone = $this->_createMockedDateTimeZone();

        $DateTime = $this->_createMockedDateTime();
        $DateTime->expects(self::once())
            ->method('getTimezone')
            ->willReturn($expectedTimeZone);

        $DateIntervalFactory = $this->_createMockedDateIntervalFactory();
        $DateTimeFactory = $this->_createMockedDateTimeFactory();
        $NavigableDateFactory = $this->_createMockedNavigableDateFactory();

        $NavigableDate = new NavigableDate($DateTime, $DateIntervalFactory, $NavigableDateFactory, $DateTimeFactory);

        self::assertSame($expectedTimeZone, $NavigableDate->getTimezone());
    }

    public function testGetTimestamp()
    {
        $expectedTimestamp = 1234567;

        $DateTime = $this->_createMockedDateTime();
        $DateTime->expects(self::once())
            ->method('getTimestamp')
            ->willReturn($expectedTimestamp);

        $DateIntervalFactory = $this->_createMockedDateIntervalFactory();
        $DateTimeFactory = $this->_createMockedDateTimeFactory();
        $NavigableDateFactory = $this->_createMockedNavigableDateFactory();

        $NavigableDate = new NavigableDate($DateTime, $DateIntervalFactory, $NavigableDateFactory, $DateTimeFactory);

        self::assertSame($expectedTimestamp, $NavigableDate->getTimestamp());
    }


    public function testGetOffset()
    {
        $expectedOffset = 123344;

        $DateTime = $this->_createMockedDateTime();
        $DateTime->expects(self::once())
            ->method('getOffset')
            ->willReturn($expectedOffset);

        $DateIntervalFactory = $this->_createMockedDateIntervalFactory();
        $DateTimeFactory = $this->_createMockedDateTimeFactory();
        $NavigableDateFactory = $this->_createMockedNavigableDateFactory();

        $NavigableDate = new NavigableDate($DateTime, $DateIntervalFactory, $NavigableDateFactory, $DateTimeFactory);

        self::assertSame($expectedOffset, $NavigableDate->getOffset());
    }

    public function testGetDifference()
    {
        $ToBeDiffedNavigableDate = $this->_createMockedNavigableDate();
        $DiffDateTime = $this->_createMockedDateTime();

        $DateTimeFactory = $this->_createMockedDateTimeFactory();
        $DateTimeFactory->expects(self::once())
            ->method('createFromNavigableDate')
            ->with($ToBeDiffedNavigableDate)
            ->willReturn($DiffDateTime);

        $ExpectedDateInterval = $this->_createMockedDateInterval();

        $DateTime = $this->_createMockedDateTime();
        $DateTime->expects(self::once())
            ->method('diff')
            ->with($DiffDateTime)
            ->willReturn($ExpectedDateInterval);

        $DateIntervalFactory = $this->_createMockedDateIntervalFactory();
        $NavigableDateFactory = $this->_createMockedNavigableDateFactory();

        $NavigableDate = new NavigableDate($DateTime, $DateIntervalFactory, $NavigableDateFactory, $DateTimeFactory);

        self::assertSame($ExpectedDateInterval, $NavigableDate->getDifference($ToBeDiffedNavigableDate));
    }

    /**
     * @return array
     */
    public function resetTimeBoolDataProvider():array
    {
        return [
            [
                true,
            ],
            [
                false,
            ],
        ];
    }

    /**
     * @return array
     */
    public function dateAfterDataProvider():array
    {
        return [
            [
                1, true,
            ],
            [
                2, false,
            ],
            [
                -1, true,
            ],
            [
                -2, false,
            ],
            [
                -4, true,
            ],
            [
                0, false,
            ],
        ];
    }

    /**
     * @return array
     */
    public function resetTimeDaysBoolDataProvider():array
    {
        return [
            [
                true, true,
            ],
            [
                false, true,
            ],
            [
                true, false,
            ],
            [
                false, false,
            ],
        ];
    }

    /**
     * @return array
     */
    public function resetTimeDaysMonthsBoolDataProvider():array
    {
        return [
            [
                true, true, true,
            ],
            [
                false, true, true,
            ],
            [
                true, false, true,
            ],
            [
                false, false, true,
            ],
            [
                true, true, false,
            ],
            [
                false, true, false,
            ],
            [
                true, false, false,
            ],
            [
                false, false, false,
            ],
        ];
    }


    /**
     * @return PHPUnit_Framework_MockObject_MockObject|DateTime
     */
    private function _createMockedDateTime()
    {
        return $this->getMockBuilder(DateTime::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|DateIntervalFactory
     */
    private function _createMockedDateIntervalFactory()
    {
        return $this->getMockBuilder(DateIntervalFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|DateInterval
     */
    private function _createMockedDateInterval()
    {
        return $this->getMockBuilder(DateInterval::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|NavigableDateFactory
     */
    private function _createMockedNavigableDateFactory()
    {
        return $this->getMockBuilder(NavigableDateFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|NavigableDate
     */
    private function _createMockedNavigableDate()
    {
        return $this->getMockBuilder(NavigableDate::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|DateTimeFactory
     */
    private function _createMockedDateTimeFactory()
    {
        return $this->getMockBuilder(DateTimeFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|DateTimeZone
     */
    private function _createMockedDateTimeZone()
    {
        return $this->getMockBuilder(DateTimeZone::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}