<?php

namespace JoseCelano\Destinia\Domain;

/**
 * Interface HotelSpecification
 * @package JoseCelano\Destinia\Domain
 */
interface HotelSpecification
{
    /**
     * @param Hotel $hotel
     * @return bool
     */
    public function specifies(Hotel $hotel);
}