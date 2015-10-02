<?php

namespace JoseCelano\Destinia\App\Service;

use JoseCelano\Destinia\Domain\AccommodationRepository;
use JoseCelano\Destinia\Presentation\Dto\AccommodationDto;

/**
 * Class AccommodationServiceImpl
 * @package JoseCelano\Destinia\App\Service
 */
class AccommodationServiceImpl implements AccommodationService
{
    /**
     * @var AccommodationRepository
     */
    private $accommodationRepository;


    function __construct(AccommodationRepository $accommodationRepository)
    {
        $this->accommodationRepository = $accommodationRepository;
    }

    /**
     * @param string $textToFind
     * @return AccommodationDto[]
     */
    public function search($textToFind)
    {
        return $this->accommodationRepository->fullTextSearchShortedByName($textToFind);
    }
}