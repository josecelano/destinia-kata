<?php

namespace JoseCelano\Destinia\App\Command;

use JoseCelano\Destinia\Domain\Hotel;
use JoseCelano\Destinia\Domain\HotelRepository;

/**
 * Class CreateHotelCommandHandler
 * @package JoseCelano\Destinia\App\Command
 */
class CreateHotelCommandHandler
{
    /**
     * @var HotelRepository
     */
    private $hotelRepository;

    function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    /**
     * @param CreateHotelCommand $command
     * @throws \Exception
     */
    public function handle(CreateHotelCommand $command)
    {
        $hotel = new Hotel(
            $this->hotelRepository->nextIdentity(),
            $command->getName(),
            $command->getStarts(),
            $command->getStandardRoomType()
        );

        $this->hotelRepository->insert($hotel);
    }
}