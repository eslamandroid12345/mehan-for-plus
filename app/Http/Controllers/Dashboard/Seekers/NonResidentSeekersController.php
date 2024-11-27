<?php

namespace App\Http\Controllers\Dashboard\Seekers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Seekers\NonResidentSeekerRequest;
use App\Http\Services\Dashboard\Seekers\NonResidentSeekersService;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\CountryRepositoryInterface;
use App\Repository\JobRepositoryInterface;
use App\Repository\NationalityRepositoryInterface;
use App\Repository\SeekerRepositoryInterface;
use App\Repository\SkillRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class NonResidentSeekersController extends Controller
{
    private NationalityRepositoryInterface $nationalityRepository;
    private CountryRepositoryInterface $countryRepository;
    private JobRepositoryInterface $jobRepository;
    private SkillRepositoryInterface $skillRepository;
    private UserRepositoryInterface $userRepository;
    private SeekerRepositoryInterface $seekerRepository;

    protected FileManagerService $fileManager;
    protected NonResidentSeekersService $nonResidentSeekers;

    public function __construct(
        NationalityRepositoryInterface $nationalityRepository,
        CountryRepositoryInterface $countryRepository,
        JobRepositoryInterface $jobRepository,
        SkillRepositoryInterface $skillRepository,
        UserRepositoryInterface $userRepository,
        SeekerRepositoryInterface $seekerRepository,
        FileManagerService $fileManagerService,
        NonResidentSeekersService $nonResidentSeekers,
    )
    {
        $this->middleware('auth:admin');
        $this->nationalityRepository = $nationalityRepository;
        $this->countryRepository = $countryRepository;
        $this->jobRepository = $jobRepository;
        $this->skillRepository = $skillRepository;
        $this->userRepository = $userRepository;
        $this->seekerRepository = $seekerRepository;
        $this->fileManager = $fileManagerService;
        $this->nonResidentSeekers = $nonResidentSeekers;
    }

    public function index()
    {
        $seekers = $this->seekerRepository->getPaginatedNonResidentSeekers();
        return view('dashboard.site.non-resident-seekers.index', compact('seekers'));
    }

    public function create()
    {
        $nationalities = $this->nationalityRepository->getAll();
        $countries = $this->countryRepository->getAllCountries();
        $jobs = $this->jobRepository->getAll();
        $skills = $this->skillRepository->getAll();
        return view('dashboard.site.non-resident-seekers.create', compact('nationalities', 'countries', 'jobs', 'skills'));
    }

    public function store(NonResidentSeekerRequest $request)
    {
        return $this->nonResidentSeekers->store($request);
    }

    public function show($id)
    {
        $user = $this->userRepository->getById($id, relations: ['seeker']);
        return view('dashboard.site.non-resident-seekers.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->userRepository->getById($id, relations: ['seeker']);
        $nationalities = $this->nationalityRepository->getAll();
        $countries = $this->countryRepository->getAllCountries();
        $jobs = $this->jobRepository->getAll();
        $skills = $this->skillRepository->getAll();
        return view('dashboard.site.non-resident-seekers.edit', compact('user', 'nationalities', 'countries', 'jobs', 'skills'));
    }

    public function update(NonResidentSeekerRequest $request, $id)
    {
        return $this->nonResidentSeekers->update($request, $id);
    }

    public function destroy($id)
    {
        $user = $this->userRepository->getById($id, relations: ['seeker']);
        if(Gate::allows('delete-seeker', $user->seeker)) {
            $user->delete();
            return redirect()->back()->with(['success' => __('messages.Seeker deleted successfully')]);
        } else {
            return redirect()->back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
}
