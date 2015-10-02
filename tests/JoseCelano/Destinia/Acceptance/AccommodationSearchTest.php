<?php

use JoseCelano\Destinia\Domain\Apartment;
use JoseCelano\Destinia\Domain\ApartmentRepository;
use JoseCelano\Destinia\Domain\Hotel;
use JoseCelano\Destinia\Domain\HotelRepository;
use JoseCelano\Destinia\Infrastructure\Persistence\InMemory\InMemoryAccommodationRepository;
use JoseCelano\Destinia\Infrastructure\Persistence\InMemory\InMemoryApartmentRepository;
use JoseCelano\Destinia\Infrastructure\Persistence\InMemory\InMemoryHotelRepository;
use JoseCelano\Destinia\Presentation\ResultPrinter;

/**
 * Class AccommodationSearchTest
 */
class AccommodationSearchTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var HotelRepository
     */
    protected $hotelRepository;

    /**
     * @var ApartmentRepository
     */
    protected $apartmentRepository;

    public function setUp()
    {
        $this->hotelRepository = new InMemoryHotelRepository();
        $this->apartmentRepository = new InMemoryApartmentRepository();
    }

    /**
     * @test
     * @group acceptance
     */ public function
    it_takes_the_first_three_letters_of_a_standard_input_and_returns_all_the_existing_matches_for_accommodations() {

        // Given admin insert 3 hotels
        $hotel = new Hotel($this->hotelRepository->nextIdentity(), "Blue Hotel" , 3, "double occupancy room with a view");
        $this->hotelRepository->insert($hotel);

        $hotel = new Hotel($this->hotelRepository->nextIdentity(), "White Hotel" , 4, "double occupancy room");
        $this->hotelRepository->insert($hotel);

        $hotel = new Hotel($this->hotelRepository->nextIdentity(), "Red Hotel" , 3, "single occupancy room");
        $this->hotelRepository->insert($hotel);

        // and 2 apartments
        $apartment = new Apartment($this->apartmentRepository->nextIdentity(), "Beach Apartments" , 10, 4);
        $this->apartmentRepository->insert($apartment);

        $apartment = new Apartment($this->apartmentRepository->nextIdentity(), "Sun and Beach Apartments" , 50, 6);
        $this->apartmentRepository->insert($apartment);

        // when admin search for "tel" running console command:
        // php -f .\app\console.php search-accommodation tel
        $inputText = "tel";

        $accommodationRepository = new InMemoryAccommodationRepository($this->hotelRepository, $this->apartmentRepository);
        $accommodations = $accommodationRepository->fullTextSearchShortedByName(substr($inputText, 0, 3));

        $resultPrinter = new ResultPrinter();
        ob_start();
            $resultPrinter->printAccommodations($accommodations);
        $output = ob_get_contents();
        ob_end_clean();

        // then she should see:

        // *  Blue Hotel, 3 stars, double occupancy room with a view, Valencia, Valencia
        // *  Red Hotel, 3 stars, single occupancy room, Sanlucar, Cádiz
        // *  White Hotel, 4 hotels, double occupancy room, Málaga, Málaga

        $this->assertEquals("Total: 3\n* Blue Hotel, 3 stars, double occupancy room with a view \n* Red Hotel, 3 stars, single occupancy room \n* White Hotel, 4 stars, double occupancy room \n", $output);

    }
}