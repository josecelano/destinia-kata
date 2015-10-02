<?php

namespace JoseCelano\Destinia\Domain;

use JoseCelano\Destinia\Presentation\Dto\AccommodationDto;

/**
 * Interface AccommodationRepository
 * @package JoseCelano\Destinia\Domain
 */
interface AccommodationRepository
{
    /**
     * @param string $textToFind
     * @return AccommodationDto[]
     */
    public function fullTextSearchShortedByName($textToFind);
}