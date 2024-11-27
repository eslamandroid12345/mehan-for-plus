<?php

namespace App\Http\Controllers\Dashboard\Ads;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Ads\AdRequest;
use App\Http\Services\Dashboard\Ads\AdsService;
use App\Repository\AdRepositoryInterface;
use App\Repository\QualificationRepositoryInterface;
use App\Repository\SeekerRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdsController extends Controller
{

    private UserRepositoryInterface $userRepository;
    private QualificationRepositoryInterface $qualificationRepository;
    private SeekerRepositoryInterface $seekerRepository;

    protected AdsService $ads;

    public function __construct(
        UserRepositoryInterface $userRepository,
        QualificationRepositoryInterface $qualificationRepository,
        SeekerRepositoryInterface $seekerRepository,
        AdsService $adsService,
    )
    {
        $this->middleware('auth:admin');
        $this->userRepository = $userRepository;
        $this->qualificationRepository = $qualificationRepository;
        $this->seekerRepository = $seekerRepository;
        $this->ads = $adsService;
    }

    public function index()
    {
        $seekers = $this->seekerRepository->paginate();
        return view('dashboard.site.ads.index', compact('seekers'));
    }

    public function show($id)
    {
        $user = $this->userRepository->getById($id);
        $ad = $user->seeker->ad;
        return view('dashboard.site.ads.show', compact('ad'));
    }

    public function edit($id)
    {

        $user = $this->userRepository->getById($id);
        $qualifications = $this->qualificationRepository->getAll();
        if(Gate::allows('admin-publish-ad', $user->seeker)) {
            return view('dashboard.site.ads.edit', compact('user', 'qualifications'));
        } else {
            return redirect()->route('ads.index')->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function update(AdRequest $request, $id)
    {
        return $this->ads->publish($request, $id);
    }

}
