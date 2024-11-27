<?php

namespace App\Http\Controllers\Dashboard\Skills;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Skills\SkillsRequest;
use App\Repository\SkillRepositoryInterface;
use Illuminate\Support\Facades\Gate;

class SkillsController extends Controller
{
    private SkillRepositoryInterface $skillRepository;

    public function __construct(SkillRepositoryInterface $skillRepository)
    {
        $this->middleware('auth:admin');
        $this->skillRepository = $skillRepository;
    }

    public function index()
    {
        $skills = $this->skillRepository->getAll();
        return view('dashboard.site.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('dashboard.site.skills.create');
    }

    public function store(SkillsRequest $request)
    {
        $this->skillRepository->create($request->validated());
        return redirect()->route('skills.create')->with(['success' => __('messages.Skill was created successfully')]);
    }

    public function edit($id)
    {
        $skill = $this->skillRepository->getById($id);
        return view('dashboard.site.skills.edit', compact('skill'));
    }

    public function update(SkillsRequest $request, $id)
    {
        $this->skillRepository->update($id, $request->validated());
        return redirect()->route('skills.index')->with(['success' => __('messages.Skill was updated successfully')]);
    }

    public function destroy($id)
    {
        $skill = $this->skillRepository->getById($id);
        if(Gate::allows('delete-skill', $skill)) {
            $this->skillRepository->delete($id);
            return redirect()->route('skills.index')->with(['success' => __('messages.Skill was deleted successfully')]);
        } else {
            return redirect()->route('skills.index')->with(['error' => __('messages.Cannot delete a skill which have seekers assigned to it')]);
        }
    }
}
