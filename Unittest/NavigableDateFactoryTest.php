<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-15
 */

namespace Unittest;

use NavigableDate\DateTimeFactory;
use NavigableDate\NavigableDate;
use NavigableDate\NavigableDateFactory;
use NavigableDate\DateIntervalFactory;
use DateTime;
use PHPUnit_Framework_MockObject_MockObject;

require_once __DIR__ . '/BaseUnittest.php';

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 * @see    NavigableDateFactory
 */
class NavigableDateFactoryTest extends BaseUnittest
{
    public function testCreate()
    {
        $DateTimeFactory = $this->_createMockedDateTimeFactory();
        $DateTimeFactory->expects(self::once())
            ->method('create')
            ->willReturn($this->_createMockedDateTime());

        $Factory = new NavigableDateFactory(
            $this->_createMockedDateIntervalFactory(), $DateTimeFactory
        );

        self::assertInstanceOf(NavigableDate::class, $Factory->create());
    }

    public function testCreateFromDateTime()
    {
        $DateTime = $this->_createMockedDateTime();
        $Factory  = new NavigableDateFactory(
            $this->_createMockedDateIntervalFactory(), $this->_createMockedDateTimeFactory()
        );

        self::assertInstanceOf(NavigableDate::class, $Factory->createFromDateTime($DateTime));
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
     * @return PHPUnit_Framework_MockObject_MockObject|DateTimeFactory
     */
    private function _createMockedDateTimeFactory()
    {
        return $this->getMockBuilder(DateTimeFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
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
}