<?php

namespace JoseCelano\Destinia\App\Service;

use JoseCelano\Destinia\Presentation\Dto\AccommodationDto;

/**
 * Interface AccommodationService
 * @package JoseCelano\Destinia\App\Service
 */
interface AccommodationService
{
    /**
     * @param string $textToFind
     * @return AccommodationDto[]
     */
    public function search($textToFind);
}