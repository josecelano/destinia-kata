<?php

namespace JoseCelano\Destinia\Domain;

/**
 * Class Apartment
 * @package JoseCelano\Destinia\Domain
 */
class Apartment
{
    /**
     * @var HotelId
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $numFlats;

    /**
     * @var int
     */
    private $numAdultsPerFlat;

    /**
     * @param ApartmentId $id
     * @param $name
     * @param $numFlats
     * @param $numAdultsPerFlat
     */
    function __construct(ApartmentId $id, $name, $numFlats, $numAdultsPerFlat)
    {
        $this->id = $id;
        $this->name = $name;
        $this->numFlats = $numFlats;
        $this->numAdultsPerFlat = $numAdultsPerFlat;
    }

    /**
     * @return HotelId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getNumAdultsPerFlat()
    {
        return $this->numAdultsPerFlat;
    }

    /**
     * @return int
     */
    public function getNumFlats()
    {
        return $this->numFlats;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $textToFind
     * @return bool
     */
    public function contains($textToFind)
    {
        if (strpos($this->name, $textToFind) !== false) {
            return true;
        }

        // TODO: search in location after adding it

        return false;
    }
}