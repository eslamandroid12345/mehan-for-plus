<?php

namespace App\Http\Controllers\Dashboard\Cities;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Cities\CitiesRequest;
use App\Repository\CityRepositoryInterface;
use App\Repository\CountryRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class CitiesController extends Controller
{
    private CityRepositoryInterface $cityRepository;
    private CountryRepositoryInterface $countryRepository;

    public function __construct(
        CityRepositoryInterface $cityRepository,
        CountryRepositoryInterface $countryRepository,
    )
    {
        $this->middleware('auth:admin');
        $this->cityRepository = $cityRepository;
        $this->countryRepository = $countryRepository;
    }

    public function index()
    {
        $cities = $this->cityRepository->paginate(perPage: 15, relations: ['country']);
        return view('dashboard.site.cities.index', compact('cities'));
    }

    public function create()
    {
        $countries = $this->countryRepository->getAll();
        return view('dashboard.site.cities.create', compact('countries'));
    }

    public function store(CitiesRequest $request)
    {
        $this->cityRepository->create($request->validated());
        return redirect()->route('cities.create')->with(['success' => __('messages.City was created successfully')]);
    }

    public function edit($id)
    {
        $city = $this->cityRepository->getById($id);
        $countries = $this->countryRepository->getAll();
        return view('dashboard.site.cities.edit', compact('city', 'countries'));
    }

    public function update(CitiesRequest $request, $id)
    {
        $this->cityRepository->update($id, $request->validated());
        return redirect()->to($request->redirects_to)->with(['success' => __('messages.City was updated successfully')]);
    }

    public function destroy($id)
    {
        $city = $this->cityRepository->getById($id);
        if(Gate::allows('delete-city', $city)) {
            $this->cityRepository->delete($id);
            return redirect()->back()->with(['success' => __('messages.City was deleted successfully')]);
        } else {
            return redirect()->route('cities.index')->with(['error' => __('messages.Cannot delete a city which have seekers assigned to it')]);
        }
    }
}
