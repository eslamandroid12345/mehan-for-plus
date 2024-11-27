<?php

namespace App\Http\Controllers\Api\Jobs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Jobs\SearchJobsRequest;
use App\Http\Resources\JobResource;
use App\Http\Services\Mutual\GetService;
use App\Http\Services\Mutual\SearchService;
use App\Http\Traits\Responser;
use App\Models\Job;
use App\Models\Skill;
use App\Repository\JobRepositoryInterface;

class JobsController extends Controller
{
    use Responser;

    protected JobRepositoryInterface $jobRepository;

    private GetService $get;
    private SearchService $search;

    public function __construct(
        JobRepositoryInterface $jobRepository,
        GetService $getService,
        SearchService $searchService,
    )
    {
        $this->middleware('auth:api')->except(['getAll', 'search']);
        $this->jobRepository = $jobRepository;
        $this->get = $getService;
        $this->search = $searchService;
    }

    public function getAll()
    {
        return $this->get->handle(resource: JobResource::class, repository: $this->jobRepository);
    }

    public function search(SearchJobsRequest $request)
    {
        return $this->search->handle(resource: JobResource::class, repository: $this->jobRepository, request: $request);
    }
}
