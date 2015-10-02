<?php

namespace JoseCelano\Destinia\Domain;

/**
 * Interface ApartmentRepository
 * @package JoseCelano\Destinia\Domain
 */
interface ApartmentRepository
{
    /**
     * @return ApartmentId
     */
    public function nextIdentity();

    /**
     * @param ApartmentId $apartmentId
     * @return Apartment
     */
    public function apartmentOfId(ApartmentId $apartmentId);

    /**
     * @param Apartment $apartment
     */
    public function insert(Apartment $apartment);

    /**
     * @param Apartment $apartment
     * @throws \Exception
     */
    public function update(Apartment $apartment);

    /**
     * @param Apartment $apartment
     */
    public function delete(Apartment $apartment);

    /**
     * @param ApartmentSpecification $specification
     * @return Apartment[]
     */
    public function query($specification);

    /**
     * @return Apartment[]
     */
    public function findAll();
}