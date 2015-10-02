<?php

namespace JoseCelano\Destinia\Domain;

/**
 * Class ApartmentFullTextSearchSpecification
 * @package JoseCelano\Destinia\Domain
 */
class ApartmentFullTextSearchSpecification implements ApartmentSpecification, SqlSpecification
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
     * @param Apartment $apartment
     * @return bool
     */
    public function specifies(Apartment $apartment)
    {
        return $apartment->contains($this->textToFind);
    }

    /**
     * @return string
     */
    public function toSqlClauses()
    {
        $clause = sprintf("`name` LIKE '%%%s%%'", $this->textToFind);
        return $clause;
    }
}