<?php

// Console commands
//
// Usage:
//
// Create Hotel Command:
// php -f .\app\console.php create-hotel name starts standard-room-type
// standard-room-type: 'single occupancy room', 'double occupancy room', 'double occupancy room with a view'
// Sample:
// php -f .\app\console.php create-hotel "Hotel Baobab" 5 "double occupancy room"
//
// Create Apartment Command:
// php -f .\app\console.php create-apartment name num-flats num-adults-per-flats
// Sample:
// php -f .\app\console.php create-apartment "Sun and Beach Apartments" 50 6
//
// Search Accommodation Command
// php -f .\app\console.php search-accommodation textToFind
// Sample:
// php -f .\app\console.php search-accommodation tel
//

require __DIR__ . '/bootstrap.php';
require __DIR__ . '/config.php';

use JoseCelano\Destinia\App\Command\CreateApartmentCommand;
use JoseCelano\Destinia\App\Command\CreateApartmentCommandHandler;
use JoseCelano\Destinia\App\Command\CreateHotelCommand;
use JoseCelano\Destinia\App\Command\CreateHotelCommandHandler;
use JoseCelano\Destinia\Infrastructure\Persistence\MySql\MySqlAccommodationRepository;
use JoseCelano\Destinia\Infrastructure\Persistence\MySql\MySqlApartmentRepository;
use JoseCelano\Destinia\Infrastructure\Persistence\MySql\MySqlHotelRepository;
use JoseCelano\Destinia\Presentation\ResultPrinter;

if (PHP_SAPI != 'cli') {
    echo "Commands must be executed on console\n";
    exit(1);
} else {

    if (isset($argv[1])) {
        $commandName = $argv[1];
    };

    if (empty($commandName)) {
        echo "Missing first argument: command name (search-accommodation)\n";
        exit(2);
    }

    $output = '';

    // TODO: Code Review. Console command dispatcher?
    switch($commandName) {

        case 'create-hotel':

            $name = $argv[2];
            $starts = $argv[3];
            $standardRoomType = $argv[4];

            $command = new CreateHotelCommand($name, $starts, $standardRoomType);
            // TODO: validate command

            $hotelRepository = new MySqlHotelRepository(new Config());
            $createHotelCommandHandler = new CreateHotelCommandHandler($hotelRepository);

            try {
                $createHotelCommandHandler->handle($command);
                $output = "Hotel created\n";
            } catch (\Exception $e) {
                $output = "Error trying to create the hotel: " . $e->getMessage();
            }

            break;

        case 'create-apartment':

            $name = $argv[2];
            $numFlats = $argv[3];
            $numAdultsFlatsPerFlat = $argv[4];

            $command = new CreateApartmentCommand($name, $numFlats, $numAdultsFlatsPerFlat);
            // TODO: validate command

            $apartmentRepository = new MySqlApartmentRepository(new Config());
            $createApartmentCommandHandler = new CreateApartmentCommandHandler($apartmentRepository);

            try {
                $createApartmentCommandHandler->handle($command);
                $output = "Apartment created\n";
            } catch (\Exception $e) {
                $output = "Error trying to create the apartment: " . $e->getMessage();
            }

            break;

        case 'search-accommodation':

            $inputText = $argv[2];

            $hotelRepository = new MySqlHotelRepository(new Config());
            $apartmentRepository = new MySqlApartmentRepository(new Config());
            $accommodationRepository = new MySqlAccommodationRepository($hotelRepository, $apartmentRepository);
            $accommodations = $accommodationRepository->fullTextSearchShortedByName(substr($inputText, 0, 3));

            if (!is_array($accommodations) || count($accommodations) == 0) {
                echo "No accommodations found\n";
            } else {
                $resultPrinter = new ResultPrinter();
                $resultPrinter->printAccommodations($accommodations);
            }

            break;

        default:
            echo "Invalid command name: $commandName.\n";
            exit(2);
    }

    echo $output;
}