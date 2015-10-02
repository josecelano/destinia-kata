<?php

namespace JoseCelano\Destinia\Infrastructure\Persistence\InMemory;

use JoseCelano\Destinia\Domain\Apartment;
use JoseCelano\Destinia\Domain\ApartmentId;
use JoseCelano\Destinia\Domain\ApartmentRepository;
use JoseCelano\Destinia\Domain\ApartmentSpecification;

/**
 * Class InMemoryApartmentRepository
 * @package JoseCelano\Destinia\Infrastructure\Persistence\InMemory
 */
class InMemoryApartmentRepository implements ApartmentRepository
{
    /**
     * @var Apartment[]
     */
    private $apartments;

    function __construct()
    {
        $this->apartments = array();
    }

    /**
     * @return ApartmentId
     */
    public function nextIdentity()
    {
        $id = strtoupper(str_replace('.', '', uniqid('', true)));
        return ApartmentId::create($id);
    }

    /**
     * @param ApartmentId $apartmentId
     * @return Apartment
     */
    public function apartmentOfId(ApartmentId $apartmentId)
    {
        foreach ($this->apartments as $apartment) {
            if ($apartment->getId()->equals($apartmentId)) {
                return $apartment;
            }
        }
        return null;
    }

    /**
     * @param Apartment $apartment
     */
    public function insert(Apartment $apartment)
    {
        $this->apartments[$apartment->getId()->getValue()] = $apartment;
    }

    /**
     * @param Apartment $apartment
     * @throws \Exception
     */
    public function update(Apartment $apartment)
    {
        $this->apartments[$apartment->getId()->getValue()] = $apartment;
    }

    /**
     * @param Apartment $apartment
     */
    public function delete(Apartment $apartment)
    {
        if (isset($this->apartments[$apartment->getId()->getValue()])) {
            unset($this->apartments[$apartment->getId()->getValue()]);
        }
    }

    /**
     * @param ApartmentSpecification $specification
     * @return Apartment[]
     */
    public function query($specification)
    {
        $results = [];
        foreach ($this->apartments as $apartment) {
            if ($specification->specifies($apartment)) {
                $results[] = $apartment;
            }
        }
        return $results;
    }

    /**
     * @return Apartment[]
     */
    public function findAll()
    {
        return $this->apartments;
    }
}