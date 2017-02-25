<?php
/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 * @created 25/02/2017
 */

declare(strict_types = 1);

namespace NavigableDate;

use DateTimeZone;

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 */
interface DateTimeCoreInterface
{
    /**
     * @param string $formatSpec
     *
     * @return string
     */
    public function format(string $formatSpec):string;

    /**
     * @return int
     */
    public function getTimestamp():int;

    /**
     * @return DateTimeZone
     */
    public function getTimezone():DateTimeZone;

    /**
     * @return int
     */
    public function getOffset():int;
}