<?php

namespace JoseCelano\Destinia\Domain;

/**
 * Interface HotelRepository
 * @package JoseCelano\Destinia\Domain
 */
interface HotelRepository
{
    /**
     * @return HotelId
     */
    public function nextIdentity();

    /**
     * @param HotelId $hotelId
     * @return Hotel
     */
    public function hotelOfId(HotelId $hotelId);

    /**
     * @param Hotel $hotel
     */
    public function insert(Hotel $hotel);

    /**
     * @param Hotel $hotel
     * @throws \Exception
     */
    public function update(Hotel $hotel);

    /**
     * @param Hotel $hotel
     */
    public function delete(Hotel $hotel);

    /**
     * @param HotelSpecification $specification
     * @return Hotel[]
     */
    public function query($specification);

    /**
     * @return Hotel[]
     */
    public function findAll();
}