<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-14
 */

require __DIR__ . '/vendor/autoload.php';
$format = 'Y-m-d H:i:s';

$NavigableDate = \NavigableDate\NavigableDateFacade::create();
var_dump($NavigableDate->format($format));

$NextDay = $NavigableDate->nextDay(true);
var_dump($NextDay->format($format));

//$NextWeek = $NavigableDate->nextWeek();
//var_dump($NextWeek->format($format));

$NWReset = $NavigableDate->nextWeek(true, true);
var_dump($NWReset->format($format));
