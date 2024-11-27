<?php

namespace App\Http\Controllers\Dashboard\Countries;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Countries\CountriesRequest;
use App\Repository\CountryRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class CountriesController extends Controller
{
    private CountryRepositoryInterface $countryRepository;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->middleware('auth:admin');
        $this->countryRepository = $countryRepository;
    }

    public function index()
    {
        $countries = $this->countryRepository->getAll();
        return view('dashboard.site.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('dashboard.site.countries.create');
    }

    public function store(CountriesRequest $request)
    {
        $this->countryRepository->create($request->validated());
        return redirect()->route('countries.create')->with(['success' => __('messages.Country was created successfully')]);
    }

    public function edit($id)
    {
        $country = $this->countryRepository->getById($id);
        if(Gate::allows('edit-country', $country)) {
            return view('dashboard.site.countries.edit', compact('country'));
        } else {
            return redirect()->route('countries.index')->with(['error' => __('messages.Cannot edit Saudi Arabia country')]);
        }
    }

    public function update(CountriesRequest $request, $id)
    {
        $country = $this->countryRepository->getById($id);
        if(Gate::allows('edit-country', $country)) {
            $this->countryRepository->update($id, $request->validated());
            return redirect()->route('countries.index')->with(['success' => __('messages.Country was updated successfully')]);
        } else {
            return redirect()->route('countries.index')->with(['error' => __('messages.Cannot edit Saudi Arabia country')]);
        }

    }

    public function destroy($id)
    {
        $country = $this->countryRepository->getById($id);
        if(Gate::allows('delete-country', $country)) {
            $this->countryRepository->delete($id);
            return redirect()->route('countries.index')->with(['success' => __('messages.Country was deleted successfully')]);
        } else {
            return redirect()->route('countries.index')->with(['error' => __('messages.Cannot delete a country which have seekers assigned to it')]);
        }
    }
}
