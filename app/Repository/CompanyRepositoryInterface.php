<?php

namespace App\Repository;

interface CompanyRepositoryInterface extends RepositoryInterface
{

    public function count();

    public function getPaginatedCompanies();

}
