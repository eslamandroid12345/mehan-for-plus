<?php

namespace App\Http\Controllers\Api\Locations;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\NationalityResource;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Models\City;
use App\Models\Country;
use App\Models\Nationality;
use App\Repository\CityRepositoryInterface;
use App\Repository\CountryRepositoryInterface;
use App\Repository\NationalityRepositoryInterface;

class LocationsController extends Controller
{
    use Responser;

    protected NationalityRepositoryInterface $nationalityRepository;
    protected CountryRepositoryInterface $countryRepository;
    protected CityRepositoryInterface $cityRepository;

    private GetService $get;

    public function __construct(
        NationalityRepositoryInterface $nationalityRepository,
        CountryRepositoryInterface $countryRepository,
        CityRepositoryInterface $cityRepository,
        GetService $getService,
    )
    {
        $this->nationalityRepository = $nationalityRepository;
        $this->countryRepository = $countryRepository;
        $this->cityRepository = $cityRepository;
        $this->get = $getService;
    }

    public function getAllNationalities() {
        return $this->get->handle(resource: NationalityResource::class, repository: $this->nationalityRepository);
    }

    public function getAllCountries() {
        return $this->get->handle(resource: CountryResource::class, repository: $this->countryRepository, method: 'getAllCountries');
    }
    public function getCountryCities($country_id) {
        return $this->get->handle(resource: CityResource::class, repository: $this->cityRepository, method: 'getCountryCities', parameters: [$country_id]);
    }

    public function getSaudiCities() {
        return $this->get->handle(resource: CityResource::class, repository: $this->cityRepository, method: 'getSaudiCities');
    }
}
