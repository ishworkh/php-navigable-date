# (PHP) NavigableDate

NavigableDate is a well tested wrapper around core php ```DateTime``` class, 
which provides an interface to navigate through the date, like nextDay, previousDay, nextMonth etc.
Along with those navigating methods, it provides common methods that core ```DateTime``` provides  
1. getTimestamp
2. getTimeZone
3. getOffset
4. format
##### For more details about methods, look into ```NavigableDate\NavigableDateInterface`` 


## Basic Usage

Can be instantiated with normal new operator but that needs to be provided with required dependencies, 
which are available through ```NavigableDate\NavigableDateLocator```. However, for ease ```NavigableDateLocator``
can be used like,
 
 ``` php
    
    $NavigableDate = NavigableDate\NavigableDateLocator::getInstance()->getNavigableDateFactory()->create('2016-07-11');
    
    or 
    
    $NavigableDate = NavigableDate\NavigableDateLocator::getInstance()->getNavigableDateFactory()->createFromDateTime(new DateTime());
    
 ```
 
 In order to avoid to write long words for locator, ```NavigableDate\NavigableDateFacade``` is also available which facilitates instantiation as shown above, 
 just escapsulated in respective facade methods.   
 
 ## Then,
 
 ```
    $NextDay = $NavigableDate->nextDay();
    $NextNextDay = $NextDay->nextDay(); // likewise
 ```
 
 ## Also possible to do previousMonth, nextYear with possibility to reset time, days or months available in corresponding methods. 
 
 # For more details, look into ```NavigableDate\NavigableDateInterface```