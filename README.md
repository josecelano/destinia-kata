# Solution specifications

* To implement the solution, you may use any PHP function and generally any of those provided by its extensions (http://php.net/manual/en/funcref.php). Some extensions require supplemental systems. Make sure these are collocated and establish the necessary access credentials (MySQL, etc.).
* You should not use development frameworks (Symphony, Zend framework, CakePHP, etc.).
* If you deem it appropriate, you may use libraries you have developed and include the code in the package you send us.
* The solution must function properly in an LAMP environment, and you must provide any details you consider necessary for implementing it (SQL sentences that generate the tables – DDL, test data, any special configurations that may be necessary for the various systems, etc.).
* It must support multiple languages. In addition to Romance languages, it should support Middle Eastern and Asian languages.
* If you feel it's necessary to run tests, please use PHPUnit.
* If you perform any preliminary modelling, please use PlantUML (http://plantuml.sourceforge.net/).

# The test

We want to implement a small PHP 5 application that takes the first three letters of a standard input and returns through standard output all the existing matches for accommodations in a given database, sorted by name and including their characteristics and locations. 

We have two types of accommodations, Hotels and Apartments, each with its own specific characteristics. In the case of hotels, in addition to their name, we need to know their number of stars and standard room type (we'll leave it to your discretion to propose several room types, such as double occupancy, double occupancy with a view, etc.). In the case of apartments, in addition to their name, we need to know how many flats are available for each property and how many adults they hold, bearing in mind that there is only one type of flat per property. 

As for the location of the accommodations, it will suffice to indicate the city and province. 

The output (to be displayed as standard output) should be a listing of the following type:
* Blue Hotel, 3 stars, double occupancy room with a view, Valencia, Valencia
* Beach Apartments, 10 flats, 4 adults, Almeria, Almeria
* White Hotel, 4 stars, double occupancy room, Mojacar, Almeria
* Red Hotel, 3 stars, single occupancy room, Sanlucar, Cádiz
* Sun and Beach Apartments, 50 flats, 6 adults, Málaga, Málaga

# Tests

Run acceptance test:  
`phpunit --configuration .\phpunit.acceptance.xml`