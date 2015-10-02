<?php

namespace JoseCelano\Destinia\Presentation\Dto;

/**
 * Class AccommodationDto
 * @package JoseCelano\Destinia\Presentation\Dto
 */
class AccommodationDto
{
    /**
     * @var string hotel|apartment
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $starts;

    /**
     * @var string
     */
    private $standardRoomType;

    /**
     * @var int
     */
    private $numFlats;

    /**
     * @var int
     */
    private $numAdultsPerFlat;

    /**
     * @param string $type hotel|apartment
     * @param string $name
     * @param int $starts
     * @param string $standardRoomType
     * @param int $numFlats
     * @param int $numAdultsPerFlat
     */
    function __construct($type, $name, $starts, $standardRoomType, $numFlats, $numAdultsPerFlat)
    {
        $this->type = $type;
        $this->name = $name;
        // Hotel
        $this->starts = $starts;
        $this->standardRoomType = $standardRoomType;
        // Apartment
        $this->numFlats = $numFlats;
        $this->numAdultsPerFlat = $numAdultsPerFlat;

    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getStarts()
    {
        return $this->starts;
    }

    /**
     * @return string
     */
    public function getStandardRoomType()
    {
        return $this->standardRoomType;
    }

    /**
     * @return int
     */
    public function getNumFlats()
    {
        return $this->numFlats;
    }

    /**
     * @return int
     */
    public function getNumAdultsPerFlat()
    {
        return $this->numAdultsPerFlat;
    }
}