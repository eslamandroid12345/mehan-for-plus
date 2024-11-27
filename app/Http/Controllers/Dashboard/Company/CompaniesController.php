<?php

namespace App\Http\Controllers\Dashboard\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Companies\CompanyRequest;
use App\Http\Services\Dashboard\Company\CompanyService;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\CompanyRepositoryInterface;
use App\Repository\FieldRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CompaniesController extends Controller
{

    private UserRepositoryInterface $userRepository;
    private CompanyRepositoryInterface $companyRepository;
    private FieldRepositoryInterface $fieldRepository;

    protected FileManagerService $fileManager;
    protected CompanyService $company;

    public function __construct(
        UserRepositoryInterface    $userRepository,
        CompanyRepositoryInterface    $companyRepository,
        FieldRepositoryInterface   $fieldRepository,
        FileManagerService         $fileManagerService,
        CompanyService             $companyService,
    )
    {
        $this->middleware('auth:admin');
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
        $this->fieldRepository = $fieldRepository;
        $this->fileManager = $fileManagerService;
        $this->company = $companyService;
    }

    public function index()
    {
        $companies = $this->companyRepository->getPaginatedCompanies();
        return view('dashboard.site.companies.index', compact('companies'));
    }

    public function create()
    {
        $fields = $this->fieldRepository->getAll();
        return view('dashboard.site.companies.create', compact('fields'));
    }

    public function store(CompanyRequest $request)
    {
        return $this->company->store($request);
    }

    public function show($id)
    {
        $user = $this->userRepository->getById($id, relations: ['company']);
        return view('dashboard.site.companies.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->userRepository->getById($id, relations: ['company']);
        $fields = $this->fieldRepository->getAll();
        return view('dashboard.site.companies.edit', compact('user', 'fields'));
    }

    public function update(CompanyRequest $request, $id)
    {
        return $this->company->update($request, $id);
    }

    public function destroy($id)
    {
        $user = $this->userRepository->getById($id);
        $user->delete();
        return redirect()->back()->with(['success' => __('messages.Company deleted successfully')]);
    }

}
