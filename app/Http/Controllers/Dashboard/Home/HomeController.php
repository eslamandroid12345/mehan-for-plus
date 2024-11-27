<?php

namespace App\Http\Controllers\Dashboard\Home;

use App\Http\Controllers\Controller;
use App\Repository\AdRepositoryInterface;
use App\Repository\CompanyRepositoryInterface;
use App\Repository\SeekerRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    protected CompanyRepositoryInterface $companyRepository;
    protected SeekerRepositoryInterface $seekerRepository;
    protected AdRepositoryInterface $adRepository;

    public function __construct(
        CompanyRepositoryInterface $companyRepository,
        SeekerRepositoryInterface $seekerRepository,
        AdRepositoryInterface $adRepository,
    )
    {
        $this->middleware('auth:admin');
        $this->companyRepository = $companyRepository;
        $this->seekerRepository = $seekerRepository;
        $this->adRepository = $adRepository;
    }

    public function index()
    {
        $count = [
            'companies' => $this->companyRepository->count(),
            'resident-seekers' => $this->seekerRepository->count(isResident: 1),
            'non-resident-seekers' => $this->seekerRepository->count(isResident: 0),
            'ads' => $this->adRepository->count(),
        ];
        return view('dashboard.site.home.index', compact('count'));
    }
}
