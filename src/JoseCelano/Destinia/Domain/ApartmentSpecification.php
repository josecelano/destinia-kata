<?php

namespace JoseCelano\Destinia\Domain;

/**
 * Interface ApartmentSpecification
 * @package JoseCelano\Destinia\Domain
 */
interface ApartmentSpecification
{
    /**
     * @param Apartment $apartment
     * @return bool
     */
    public function specifies(Apartment $apartment);
}