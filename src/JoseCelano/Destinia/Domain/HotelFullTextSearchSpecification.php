<?php

namespace JoseCelano\Destinia\Domain;

/**
 * Class HotelFullTextSearchSpecification
 * @package JoseCelano\Destinia\Domain
 */
class HotelFullTextSearchSpecification implements HotelSpecification, SqlSpecification
{
    /**
     * @var string
     */
    private $textToFind;

    /**
     * @param $textToFind
     */
    public function __construct($textToFind)
    {
        $this->textToFind = $textToFind;
    }

    /**
     * @param Hotel $hotel
     * @return bool
     */
    public function specifies(Hotel $hotel)
    {
        return $hotel->contains($this->textToFind);
    }

    /**
     * @return string
     */
    public function toSqlClauses()
    {
        $clause = sprintf("`name` LIKE '%%%s%%' or `standard_room_type` LIKE '%%%s%%'", $this->textToFind, $this->textToFind);
        return $clause;
    }
}