<?php

namespace JoseCelano\Destinia\App\Command;

/**
 * Class CreateHotelCommand
 * @package JoseCelano\Destinia\App\Command
 */
class CreateHotelCommand implements Command
{
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
     * @param string $name
     * @param int $starts
     * @param string $standardRoomType
     */
    function __construct($name, $starts, $standardRoomType)
    {
        $this->name = $name;
        $this->starts = $starts;
        $this->standardRoomType = $standardRoomType;
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
}