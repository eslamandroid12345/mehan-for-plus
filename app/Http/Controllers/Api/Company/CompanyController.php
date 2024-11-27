<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Ads\FilterAdsRequest;
use App\Http\Requests\Api\Company\CompanyRequest;
use App\Http\Requests\Api\View\ViewRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\FeedCollection;
use App\Http\Resources\SeekerDetailsResource;
use App\Http\Services\Api\Company\CompanyService;
use App\Http\Services\Mutual\GetService;
use App\Http\Traits\Responser;
use App\Repository\AdRepositoryInterface;
use App\Repository\UserRepositoryInterface;

class CompanyController extends Controller
{
    use Responser;

    protected UserRepositoryInterface $userRepository;
    protected AdRepositoryInterface $adRepository;

    private GetService $get;
    private CompanyService $company;


    public function __construct(
        UserRepositoryInterface $userRepository,
        AdRepositoryInterface $adRepository,
        GetService $getService,
        CompanyService $companyService,
    )
    {
        $this->middleware('auth:api')->only(['profile', 'update', 'view']);
        $this->userRepository = $userRepository;
        $this->adRepository = $adRepository;
        $this->get =  $getService;
        $this->company = $companyService;
    }

    public function feeds() {
        return $this->get->handle(resource: FeedCollection::class, repository: $this->adRepository, method: 'feeds', is_instance: true);
    }

    public function filter(FilterAdsRequest $request) {
        return $this->get->handle(resource: FeedCollection::class, repository: $this->adRepository, method: 'filter', parameters: [$request], is_instance: true);
    }

    public function seeker($id) {
        return $this->get->handle(resource: SeekerDetailsResource::class, repository: $this->userRepository, method: 'getById', parameters: [$id], is_instance: true);
    }

    public function profile() {
        return $this->get->handle(resource: CompanyResource::class, repository: $this->userRepository, method: 'getById', parameters: [auth('api')->id()], is_instance: true);
    }

    public function update(CompanyRequest $request) {
        return $this->company->update($request);
    }

    public function view(ViewRequest $request) {
        return $this->company->view($request);
    }
}
