<?php

namespace JoseCelano\Destinia\Domain;

/**
 * Class Hotel
 * @package JoseCelano\Destinia\Domain
 */
class Hotel
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
    private $starts;

    /**
     * @var string
     */
    private $standardRoomType;

    /**
     * @param HotelId $id
     * @param string $name
     * @param int $starts
     * @param string $standardRoomType
     */
    function __construct(HotelId $id, $name, $starts, $standardRoomType)
    {
        $this->id = $id;
        $this->name = $name;
        $this->starts = $starts;
        $this->standardRoomType = $standardRoomType;
    }

    /**
     * @return HotelId
     */
    public function getId()
    {
        return $this->id;
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
     * @param string $textToFind
     * @return bool
     */
    public function contains($textToFind)
    {
        if (strpos($this->name, $textToFind) !== false) {
            return true;
        }

        if (strpos($this->standardRoomType, $textToFind) !== false) {
            return true;
        }

        // TODO: search in location after adding it

        return false;
    }
}