<?php

namespace JoseCelano\Destinia\Infrastructure\Persistence\MySql;

use JoseCelano\Destinia\Domain\AccommodationRepository;
use JoseCelano\Destinia\Domain\ApartmentFullTextSearchSpecification;
use JoseCelano\Destinia\Domain\ApartmentRepository;
use JoseCelano\Destinia\Domain\HotelFullTextSearchSpecification;
use JoseCelano\Destinia\Domain\HotelRepository;
use JoseCelano\Destinia\Presentation\Dto\AccommodationDto;

/**
 * Class MySqlAccommodationRepository
 * @package JoseCelano\Destinia\Infrastructure\Persistence\MySql
 */
class MySqlAccommodationRepository implements AccommodationRepository
{
    /**
     * @var HotelRepository
     */
    private $hotelRepository;

    /**
     * @var ApartmentRepository
     */
    private $apartmentRepository;

    /**
     * @param $hotelRepository $hotelRepository
     * @param ApartmentRepository $apartmentRepository
     */
    function __construct(HotelRepository $hotelRepository, ApartmentRepository $apartmentRepository)
    {
        $this->hotelRepository = $hotelRepository;
        $this->apartmentRepository = $apartmentRepository;
    }

    /**
     * @param string $textToFind
     * @return AccommodationDto[]
     */
    public function fullTextSearchShortedByName($textToFind)
    {
        $hotels = $this->searchTextInHotels($textToFind);
        $apartments = $this->searchTextInApartments($textToFind);
        $accommodations = array_merge($hotels, $apartments);

        // DEBUG
        //var_dump($accommodations);

        ksort($accommodations);

        return $accommodations;
    }

    /**
     * @param $textToFind
     * @return AccommodationDto[]
     */
    private function searchTextInHotels($textToFind)
    {
        $accommodationDtos = array();

        $specification = new HotelFullTextSearchSpecification($textToFind);

        // DEBUG
        //var_dump($specification->toSqlClauses());
        //die();

        $hotels = $this->hotelRepository->query($specification);

        foreach ($hotels as $hotel) {
            // TODO: enum form accommodation types
            $accommodationDto = new AccommodationDto('hotel', $hotel->getName(), $hotel->getStarts(), $hotel->getStandardRoomType(), null, null);
            $accommodationDtos[$hotel->getName()] = $accommodationDto;
        }

        return $accommodationDtos;
    }

    /**
     * @param $textToFind
     * @return AccommodationDto[]
     */
    private function searchTextInApartments($textToFind)
    {
        $accommodationDtos = array();

        $specification = new ApartmentFullTextSearchSpecification($textToFind);
        $apartments = $this->apartmentRepository->query($specification);

        foreach ($apartments as $apartment) {
            // TODO: enum form accommodation types
            $accommodationDto = new AccommodationDto('apartment', $apartment->getName(), null, null, $apartment->getNumFlats(), $apartment->getNumAdultsPerFlat());
            $accommodationDtos[$apartment->getName()] = $accommodationDto;
        }

        return $accommodationDtos;
    }
}