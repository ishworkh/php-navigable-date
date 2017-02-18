# (PHP) NavigableDate

NavigableDate is a wrapper around core php ```DateTime``` class.
It encapsulates core class and exposes ```NavigableDateInterface``` that provides ways to 
navigate through a date. It exposes methods like nextDay, previousDay, nextMonth etc,
in addition to methods like  ```format```, ```getTimestamp```,```getOffset``` and ```getTimezone```.

## Basic Usage

It can be instantiated with normal new operator but that needs you to manually handle the dependencies,
```NavigableDate\NavigableDateLocator``` can be used to get dependendent classes.
Recommended way to get an instance is through ```NavigableDateFactory``` available in ```NavigableDateLocator```.
 
 ```php
    
    $NavigableDate = NavigableDate\NavigableDateLocator::getInstance()
                    ->getNavigableDateFactory()
                    ->create('2016-07-11');
    
    or 
    
    $NavigableDate = NavigableDate\NavigableDateLocator::getInstance()
                    ->getNavigableDateFactory()
                    ->createFromDateTime(new DateTime());
    
 ```
 
 Or even ```NavigableDate\NavigableDateFacade``` can be used for the instantiation.
 
 ```php
    $NavigableDate = NavigableDate\NavigableDateFacade::create('2016-07-11');
 
 ```
 
 It includes ```NavigableDate\NavigableDateServiceProvider``` to integrate this library to Laravel application. Just include this provider in the lists
 of service providers. After which  type hinting ```NavigableDate\NavigableDateFactory``` will resolve into respective factory class responsible for creating 
 new instance of ```NavigableDate\NavigableDate```.
 
 ## Then,
 
 ```php
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
 
 #### NOTE: For more details about methods it provides, look into ```NavigableDate\NavigableDateInterface```