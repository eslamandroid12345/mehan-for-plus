<?php

namespace App\Repository;

interface SeekerRepositoryInterface extends RepositoryInterface
{

    public function count(bool $isResident);

    public function getPaginatedResidentSeekers();

    public function getPaginatedNonResidentSeekers();

}
