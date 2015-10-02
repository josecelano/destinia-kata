<?php

namespace JoseCelano\Destinia\Presentation;

use JoseCelano\Destinia\Presentation\Dto\AccommodationDto;

/**
 * Class ResultPrinter
 * @package JoseCelano\Destinia\Presentation
 */
class ResultPrinter
{
    /**
     * @param AccommodationDto[] $accommodations
     */
    public function printAccommodations($accommodations)
    {
        if (!is_array($accommodations) || count($accommodations) == 0) {
            return;
        }

        echo "Total: " . count($accommodations) . "\n";
        /** @var AccommodationDto $accommodationDto */
        foreach ($accommodations as $accommodationDto) {
            switch ($accommodationDto->getType()) {
                case 'hotel':
                    echo sprintf("* %s, %d stars, %s \n", $accommodationDto->getName(), $accommodationDto->getStarts(), $accommodationDto->getStandardRoomType());
                    break;
                case 'apartment':
                    echo sprintf("* %s, %d flats, %d adults \n", $accommodationDto->getName(), $accommodationDto->getNumFlats(), $accommodationDto->getNumAdultsPerFlat());
                    break;
            }
        }
    }
}