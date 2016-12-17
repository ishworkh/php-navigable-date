<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-14
 */

require __DIR__ . '/vendor/autoload.php';

$NavigableDate = \NavigableDate\NavigableDateFacade::create();

var_dump($NavigableDate->format('Y-m-d H:i:s'));

var_dump($NavigableDate->nextDay()->format('Y-m-d H:i:s'));
var_dump($NavigableDate->format('Y-m-d H:i:s'));
var_dump($NavigableDate->nextMonth()->format('Y-m-d H:i:s'));
var_dump($NavigableDate->nextYear()->format('Y-m-d H:i:s'));