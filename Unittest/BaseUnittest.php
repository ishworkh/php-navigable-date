<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-15
 */

namespace Unittest;

require __DIR__ . '/../vendor/autoload.php';

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 */
abstract class BaseUnittest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        date_default_timezone_set('UTC');
    }
}