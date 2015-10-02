<?php

namespace JoseCelano\Destinia\App\Command;

use JoseCelano\Destinia\Domain\Apartment;
use JoseCelano\Destinia\Domain\ApartmentRepository;

/**
 * Class CreateApartmentCommandHandler
 * @package JoseCelano\Destinia\App\Command
 */
class CreateApartmentCommandHandler
{
    /**
     * @var ApartmentRepository
     */
    private $apartmentRepository;

    function __construct(ApartmentRepository $apartmentRepository)
    {
        $this->apartmentRepository = $apartmentRepository;
    }

    /**
     * @param CreateApartmentCommand $command
     * @throws \Exception
     */
    public function handle(CreateApartmentCommand $command)
    {
        $apartment = new Apartment(
            $this->apartmentRepository->nextIdentity(),
            $command->getName(),
            $command->getNumFlats(),
            $command->getNumAdultsPerFlat()
        );

        $this->apartmentRepository->insert($apartment);
    }
}