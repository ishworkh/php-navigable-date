<?php
/**
 * @author  Ishwor Khadka <ishworkh@gmail.com>
 * @created 2016-12-26
 */

namespace NavigableDate;

use Illuminate\Support\ServiceProvider;

/**
 * @author Ishwor Khadka <ishworkh@gmail.com>
 */
class NavigableDateServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->singleton(NavigableDateFactory::class, function () {
            return NavigableDateLocator::getInstance()->getNavigableDateFactory();
        });
    }
}