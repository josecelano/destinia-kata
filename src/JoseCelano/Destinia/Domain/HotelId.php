<?php

namespace JoseCelano\Destinia\Domain;

/**
 * Class HotelId
 * @package JoseCelano\Destinia\Domain
 */
class HotelId
{
    /**
     * @var string
     */
    private $value;

    /**
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = (string)$value;
    }

    /**
     * @param $value
     * @return HotelId
     */
    public static function create($value)
    {
        return new self($value);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->value;
    }

    /**
     * @param HotelId $hotelId
     * @return bool
     */
    public function equals(HotelId $hotelId)
    {
        if ($this->value === $hotelId->getValue())
            return true;
        else
            return false;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}