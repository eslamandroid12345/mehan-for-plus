<?php

namespace App\Http\Controllers\Dashboard\Jobs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Jobs\JobsRequest;
use App\Repository\JobRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JobsController extends Controller
{

    private JobRepositoryInterface $jobRepository;

    public function __construct(JobRepositoryInterface $jobRepository)
    {
        $this->middleware('auth:admin');
        $this->jobRepository = $jobRepository;
    }

    public function index()
    {
        $jobs = $this->jobRepository->getAll();
        return view('dashboard.site.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('dashboard.site.jobs.create');
    }

    public function store(JobsRequest $request)
    {
        $this->jobRepository->create($request->validated());
        return redirect()->route('jobs.create')->with(['success' => __('messages.Job was created successfully')]);
    }

    public function edit($id)
    {
        $job = $this->jobRepository->getById($id);
        return view('dashboard.site.jobs.edit', compact('job'));
    }

    public function update(JobsRequest $request, $id)
    {
        $this->jobRepository->update($id, $request->validated());
        return redirect()->route('jobs.index')->with(['success' => __('messages.Job was updated successfully')]);
    }

    public function destroy($id)
    {
        $job = $this->jobRepository->getById($id);
        if(Gate::allows('delete-job', $job)) {
            $this->jobRepository->delete($id);
            return redirect()->route('jobs.index')->with(['success' => __('messages.Job was deleted successfully')]);
        } else {
            return redirect()->route('jobs.index')->with(['error' => __('messages.Cannot delete a job which have seekers assigned to it')]);
        }
    }

}
