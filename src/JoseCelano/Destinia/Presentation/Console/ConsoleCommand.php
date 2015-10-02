<?php

namespace JoseCelano\Destinia\Presentation\Console;

/**
 * Interface ConsoleCommand
 * @package JoseCelano\Destinia\App\Command
 */
interface ConsoleCommand
{
    /**
     * @param array $input
     * @param string $output
     */
    public function execute($input, & $output);
}