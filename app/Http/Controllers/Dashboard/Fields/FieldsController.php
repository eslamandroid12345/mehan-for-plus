<?php

namespace App\Http\Controllers\Dashboard\Fields;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Fields\FieldsRequest;
use App\Repository\FieldRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FieldsController extends Controller
{

    private FieldRepositoryInterface $fieldRepository;

    public function __construct(
        FieldRepositoryInterface $fieldRepository,
    )
    {
        $this->middleware('auth:admin');
        $this->fieldRepository = $fieldRepository;
    }

    public function index()
    {
        $fields = $this->fieldRepository->getAll();
        return view('dashboard.site.fields.index', compact('fields'));
    }

    public function create()
    {
        return view('dashboard.site.fields.create');
    }

    public function store(FieldsRequest $request)
    {
        $this->fieldRepository->create($request->validated());
        return redirect()->route('fields.create')->with(['success' => __('messages.Field was created successfully')]);
    }

    public function edit($id)
    {
        $field = $this->fieldRepository->getById($id);
        return view('dashboard.site.fields.edit', compact('field'));
    }

    public function update(FieldsRequest $request, $id)
    {
        $this->fieldRepository->update($id, $request->validated());
        return redirect()->route('fields.index')->with(['success' => __('messages.Field was updated successfully')]);
    }

    public function destroy($id)
    {
        $field = $this->fieldRepository->getById($id);
        if(Gate::allows('delete-field', $field)) {
            $this->fieldRepository->delete($id);
            return redirect()->route('fields.index')->with(['success' => __('messages.Field was deleted successfully')]);
        } else {
            return redirect()->route('fields.index')->with(['error' => __('messages.Cannot delete a field which have companies assigned to it')]);
        }
    }
}
