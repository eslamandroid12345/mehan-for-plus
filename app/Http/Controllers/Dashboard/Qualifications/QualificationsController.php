<?php

namespace App\Http\Controllers\Dashboard\Qualifications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Qualifications\QualificationsRequest;
use App\Repository\QualificationRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class QualificationsController extends Controller
{
    private QualificationRepositoryInterface $qualificationRepository;

    public function __construct(QualificationRepositoryInterface $qualificationRepository)
    {
        $this->middleware('auth:admin');
        $this->qualificationRepository = $qualificationRepository;
    }

    public function index()
    {
        $qualifications = $this->qualificationRepository->getAll();
        return view('dashboard.site.qualifications.index', compact('qualifications'));
    }

    public function create()
    {
        return view('dashboard.site.qualifications.create');
    }

    public function store(QualificationsRequest $request)
    {
        $this->qualificationRepository->create($request->validated());
        return redirect()->route('qualifications.create')->with(['success' => __('messages.Qualification was created successfully')]);
    }

    public function edit($id)
    {
        $qualification = $this->qualificationRepository->getById($id);
        return view('dashboard.site.qualifications.edit', compact('qualification'));
    }

    public function update(QualificationsRequest $request, $id)
    {
        $this->qualificationRepository->update($id, $request->validated());
        return redirect()->route('qualifications.index')->with(['success' => __('messages.Qualification was updated successfully')]);
    }

    public function destroy($id)
    {
        $qualification = $this->qualificationRepository->getById($id);
        if(Gate::allows('delete-qualification', $qualification)) {
            $this->qualificationRepository->delete($id);
            return redirect()->route('qualifications.index')->with(['success' => __('messages.Qualification was deleted successfully')]);
        } else {
            return redirect()->route('qualifications.index')->with(['error' => __('messages.Cannot delete a qualification which have seekers assigned to it')]);
        }
    }
}
