<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-14
 */

namespace Unittest;

use NavigableDate\DateIntervalFactory;

require_once __DIR__ . '/BaseUnittest.php';

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 * @see    DateIntervalFactory
 */
class DateIntervalFactoryTest extends BaseUnittest
{
    /**
     * @param int $days
     * @param int $months
     * @param int $years
     *
     * @return void
     *
     * @dataProvider dateIntervalDateProvider
     */
    public function testCreate($days, $months, $years)
    {
        $Factory      = new DateIntervalFactory();
        $DateInterval = $Factory->create($days, $months, $years);

        self::assertEquals($days, $DateInterval->d);
        self::assertEquals($months, $DateInterval->m);
        self::assertEquals($years, $DateInterval->y);
    }

    /**
     * @return array
     */
    public function dateIntervalDateProvider()
    {
        return [
            [
                1, 0, 0,
            ],
            [
                0, 1, 0,
            ],
            [
                0, 0, 1,
            ],
            [
                1, 1, 1,
            ],
            [
                2, 0, 1,
            ],
            [
                3, 4, 1,
            ],
        ];
    }
}