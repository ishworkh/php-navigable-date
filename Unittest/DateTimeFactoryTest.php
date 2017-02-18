<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-16
 */

declare(strict_types = 1);

namespace Unittest;

require_once __DIR__ . '/BaseUnittest.php';

use NavigableDate\DateTimeFactory;
use DateTime;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 * @see    DateTimeFactory
 */
class DateTimeFactoryTest extends BaseUnittest
{
    public function testCreate()
    {
        $Factory = new DateTimeFactory();
        self::assertInstanceOf(DateTime::class, $Factory->create());
    }

    public function testCreateFromDateTime()
    {
        $DateTime = $this->_createMockedDateTime();

        $Factory = new DateTimeFactory();
        self::assertInstanceOf(DateTime::class, $Factory->createFromDateTime($DateTime));
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