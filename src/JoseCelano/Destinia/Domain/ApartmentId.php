<?php

namespace JoseCelano\Destinia\Domain;

/**
 * Class ApartmentId
 * @package JoseCelano\Destinia\Domain
 */
class ApartmentId
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
     * @return ApartmentId
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
     * @param ApartmentId $apartmentId
     * @return bool
     */
    public function equals(ApartmentId $apartmentId)
    {
        if ($this->value === $apartmentId->getValue())
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