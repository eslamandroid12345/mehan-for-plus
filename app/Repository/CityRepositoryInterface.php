<?php

namespace App\Repository;

interface CityRepositoryInterface extends RepositoryInterface
{
    public function getCountryCities($country_id);

    public function getSaudiCities();

}
