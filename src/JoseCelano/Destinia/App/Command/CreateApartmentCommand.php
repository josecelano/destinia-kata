<?php

namespace JoseCelano\Destinia\App\Command;

/**
 * Class CreateApartmentCommand
 * @package JoseCelano\Destinia\App\Command
 */
class CreateApartmentCommand implements Command
{
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
     * @param string $name
     * @param $numFlats
     * @param $numAdultsPerFlat
     */
    function __construct($name, $numFlats, $numAdultsPerFlat)
    {
        $this->name = $name;
        $this->numFlats = $numFlats;
        $this->numAdultsPerFlat = $numAdultsPerFlat;
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