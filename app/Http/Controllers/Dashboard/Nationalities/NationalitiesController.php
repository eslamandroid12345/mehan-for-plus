<?php

namespace App\Http\Controllers\Dashboard\Nationalities;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Nationalities\NationalitiesRequest;
use App\Repository\NationalityRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class NationalitiesController extends Controller
{

    private NationalityRepositoryInterface $nationalityRepository;

    public function __construct(
        NationalityRepositoryInterface $nationalityRepository,
    )
    {
        $this->middleware('auth:admin');
        $this->nationalityRepository = $nationalityRepository;
    }

    public function index()
    {
        $nationalities = $this->nationalityRepository->getAll();
        return view('dashboard.site.nationalities.index', compact('nationalities'));
    }

    public function create()
    {
        return view('dashboard.site.nationalities.create');
    }

    public function store(NationalitiesRequest $request)
    {
        $this->nationalityRepository->create($request->validated());
        return redirect()->route('nationalities.create')->with(['success' => __('messages.Nationality was created successfully')]);
    }

    public function edit($id)
    {
        $nationality = $this->nationalityRepository->getById($id);
        return view('dashboard.site.nationalities.edit', compact('nationality'));
    }

    public function update(NationalitiesRequest $request, $id)
    {
        $this->nationalityRepository->update($id, $request->validated());
        return redirect()->route('nationalities.index')->with(['success' => __('messages.Nationality was updated successfully')]);
    }

    public function destroy($id)
    {
        $nationality = $this->nationalityRepository->getById($id);
        if(Gate::allows('delete-nationality', $nationality)) {
            $this->nationalityRepository->delete($id);
            return redirect()->route('nationalities.index')->with(['success' => __('messages.Nationality was deleted successfully')]);
        } else {
            return redirect()->route('nationalities.index')->with(['error' => __('messages.Cannot delete a nationality which have seekers assigned to it')]);
        }
    }

}
