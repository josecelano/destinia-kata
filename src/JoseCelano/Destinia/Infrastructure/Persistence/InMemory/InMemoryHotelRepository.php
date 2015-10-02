<?php

namespace JoseCelano\Destinia\Infrastructure\Persistence\InMemory;

use JoseCelano\Destinia\Domain\Hotel;
use JoseCelano\Destinia\Domain\HotelId;
use JoseCelano\Destinia\Domain\HotelRepository;
use JoseCelano\Destinia\Domain\HotelSpecification;

/**
 * Class InMemoryHotelRepository
 * @package JoseCelano\Destinia\Infrastructure\Persistence\InMemory
 */
class InMemoryHotelRepository implements HotelRepository
{
    /**
     * @var Hotel[]
     */
    private $hotels;

    function __construct()
    {
        $this->hotels = array();
    }

    /**
     * @return HotelId
     */
    public function nextIdentity()
    {
        $id = strtoupper(str_replace('.', '', uniqid('', true)));
        return HotelId::create($id);
    }

    /**
     * @param HotelId $hotelId
     * @return Hotel
     */
    public function hotelOfId(HotelId $hotelId)
    {
        foreach ($this->hotels as $hotel) {
            if ($hotel->getId()->equals($hotelId)) {
                return $hotel;
            }
        }
        return null;
    }

    /**
     * @param Hotel $hotel
     */
    public function insert(Hotel $hotel)
    {
        $this->hotels[$hotel->getId()->getValue()] = $hotel;
    }

    /**
     * @param Hotel $hotel
     * @throws \Exception
     */
    public function update(Hotel $hotel)
    {
        $this->hotels[$hotel->getId()->getValue()] = $hotel;
    }

    /**
     * @param Hotel $hotel
     */
    public function delete(Hotel $hotel)
    {
        if (isset($this->hotels[$hotel->getId()->getValue()])) {
            unset($this->hotels[$hotel->getId()->getValue()]);
        }
    }

    /**
     * @param HotelSpecification $specification
     * @return Hotel[]
     */
    public function query($specification)
    {
        $results = array();

        foreach ($this->hotels as $hotel) {
            if ($specification->specifies($hotel)) {
                $results[] = $hotel;
            }
        }
        return $results;
    }

    /**
     * @return Hotel[]
     */
    public function findAll()
    {
        return $this->hotels;
    }
}