# (PHP) NavigableDate

NavigableDate is a wrapper around core php ```DateTime``` class.
It encapsulates core class to expose ```NavigableDateInterface``` that provides ways to 
navigate through the dates for e.g. nextDay, previousDay, nextMonth etc.
It provides basic core ```DateTime``` methods, which are ```format```, ```getTimestamp```,
```getOffset``` and ```getTimezone``` to be specific.

## Basic Usage

Can be instantiated with normal new operator but that needs to be provided with required dependencies, 
which are available through ```NavigableDate\NavigableDateLocator```. However, for ease ```NavigableDateLocator``
can be used like,
 
 ``` php
    
    $NavigableDate = NavigableDate\NavigableDateLocator::getInstance()`
                    ->getNavigableDateFactory()
                    ->create('2016-07-11');
    
    or 
    
    $NavigableDate = NavigableDate\NavigableDateLocator::getInstance()
                    ->getNavigableDateFactory()
                    ->createFromDateTime(new DateTime());
    
 ```
 
 In order to avoid to write long words for locator, ```NavigableDate\NavigableDateFacade``` is also available which facilitates instantiation as shown above, 
 just escapsulated in respective facade methods.   
 
 ```
    $NavigableDate = NavigableDate\NavigableDateFacade::create('2016-07-11');
 
 ```
 
 ## Then,
 
 ```
    $NextDay = $NavigableDate->nextDay();
    
    $NextDay->getTimestamp();
    $NextDay->getOffset();
    $NextDay->getTimeZone();
    $NextDay->format('Y-m-d');
    
    $NextNextDay = $NextDay->nextDay(); 
    $NextNextDay->nextMonth();
    
    $resetTime = true;
    $resetDays = true;
    $resetMonths = true;
    
    $NextDay->previousYear($resetTime, $resetDays, $resetMonths);
    
    // $resetTime -> resets time to 00:00:00
    // $resetDays -> resets day of the month to 01
    // $resetMonths -> resets month of the year to 01
    
 ```
 
 ## Also possible to do previousMonth, nextYear with possibility to reset time, days or months available in corresponding methods. 
 
 #### NOTE: For more details, look into ```NavigableDate\NavigableDateInterface```