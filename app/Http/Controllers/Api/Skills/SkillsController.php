<?php

namespace App\Http\Controllers\Api\Skills;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Skills\SearchSkillsRequest;
use App\Http\Resources\SkillResource;
use App\Http\Services\Mutual\GetService;
use App\Http\Services\Mutual\SearchService;
use App\Http\Traits\Responser;
use App\Repository\SkillRepositoryInterface;

class SkillsController extends Controller
{
    use Responser;

    protected SkillRepositoryInterface $skillRepository;

    private GetService $get;
    private SearchService $search;

    public function __construct(
        SkillRepositoryInterface $skillRepository,
        GetService $getService,
        SearchService $searchService,
    )
    {
        $this->middleware('auth:api')->except(['getAll', 'search']);
        $this->skillRepository = $skillRepository;
        $this->get = $getService;
        $this->search = $searchService;
    }

    public function getAll()
    {
        return $this->get->handle(resource: SkillResource::class, repository: $this->skillRepository);
    }

    public function search(SearchSkillsRequest $request)
    {
        return $this->search->handle(resource: SkillResource::class, repository: $this->skillRepository, request: $request);
    }
}
