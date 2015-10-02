<?php

namespace JoseCelano\Destinia\Domain;

/**
 * Interface SqlSpecification
 * @package JoseCelano\Destinia\Domain
 */
interface SqlSpecification
{
    public function toSqlClauses();
}