<?php

namespace App\Http\Controllers\Dashboard\Seekers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Seekers\ResidentSeekerRequest;
use App\Http\Services\Dashboard\Seekers\ResidentSeekersService;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\CityRepositoryInterface;
use App\Repository\JobRepositoryInterface;
use App\Repository\NationalityRepositoryInterface;
use App\Repository\SeekerRepositoryInterface;
use App\Repository\SkillRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class ResidentSeekersController extends Controller
{
    private NationalityRepositoryInterface $nationalityRepository;
    private CityRepositoryInterface $cityRepository;
    private JobRepositoryInterface $jobRepository;
    private SkillRepositoryInterface $skillRepository;
    private UserRepositoryInterface $userRepository;
    private SeekerRepositoryInterface $seekerRepository;

    protected FileManagerService $fileManager;
    protected ResidentSeekersService $residentSeekers;

    public function __construct(
        NationalityRepositoryInterface $nationalityRepository,
        CityRepositoryInterface        $cityRepository,
        JobRepositoryInterface         $jobRepository,
        SkillRepositoryInterface       $skillRepository,
        UserRepositoryInterface        $userRepository,
        SeekerRepositoryInterface      $seekerRepository,
        FileManagerService             $fileManagerService,
        ResidentSeekersService         $residentSeekersService,
    )
    {
        $this->middleware('auth:admin');
        $this->nationalityRepository = $nationalityRepository;
        $this->cityRepository = $cityRepository;
        $this->jobRepository = $jobRepository;
        $this->skillRepository = $skillRepository;
        $this->userRepository = $userRepository;
        $this->seekerRepository = $seekerRepository;
        $this->fileManager = $fileManagerService;
        $this->residentSeekers = $residentSeekersService;
    }

    public function index()
    {
        $seekers = $this->seekerRepository->getPaginatedResidentSeekers();
        return view('dashboard.site.resident-seekers.index', compact('seekers'));
    }

    public function create()
    {
        $nationalities = $this->nationalityRepository->getAll();
        $cities = $this->cityRepository->getSaudiCities();
        $jobs = $this->jobRepository->getAll();
        $skills = $this->skillRepository->getAll();
        return view('dashboard.site.resident-seekers.create', compact('nationalities', 'cities', 'jobs', 'skills'));
    }

    public function store(ResidentSeekerRequest $request)
    {
        return $this->residentSeekers->store($request);
    }

    public function show($id)
    {
        $user = $this->userRepository->getById($id, relations: ['seeker']);
        return view('dashboard.site.resident-seekers.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->userRepository->getById($id, relations: ['seeker']);
        $nationalities = $this->nationalityRepository->getAll();
        $cities = $this->cityRepository->getSaudiCities();
        $jobs = $this->jobRepository->getAll();
        $skills = $this->skillRepository->getAll();
        return view('dashboard.site.resident-seekers.edit', compact('user', 'nationalities', 'cities', 'jobs', 'skills'));
    }

    public function update(ResidentSeekerRequest $request, $id)
    {
        return $this->residentSeekers->update($request, $id);
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
