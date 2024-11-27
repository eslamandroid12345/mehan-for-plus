<?php

namespace App\Http\Controllers\Dashboard\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admins\CreateAdminRequest;
use App\Http\Requests\Dashboard\Admins\UpdateAdminRequest;
use App\Repository\AdminRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminsController extends Controller
{
    private AdminRepositoryInterface $adminRepository;

    public function __construct(
        AdminRepositoryInterface $adminRepository,
    )
    {
        $this->middleware('auth:admin');
        $this->adminRepository = $adminRepository;
    }

    public function index()
    {
        $admins = $this->adminRepository->getAll(['id', 'name', 'email']);
        return view('dashboard.site.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('dashboard.site.admins.create');
    }

    public function store(CreateAdminRequest $request)
    {
        $this->adminRepository->create($request->validated());
        return redirect()->route('admins.index')->with(['success' => __('messages.Admin was registered successfully')]);
    }

    public function edit($id)
    {
        $admin = $this->adminRepository->getById($id);
        return view('dashboard.site.admins.edit', compact('admin'));
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        $this->adminRepository->update($id, $request->validated());
        return redirect()->route('admins.index')->with(['success' => __('messages.Admin was updated successfully')]);
    }

    public function destroy($id)
    {
        if(Gate::allows('delete-admin', $id)) {
            $this->adminRepository->delete($id);
            return redirect()->route('admins.index')->with(['success' => __('messages.Admin was deleted successfully')]);
        } else {
            return redirect()->route('admins.index')->with(['error' => __('messages.Something went wrong')]);
        }
    }

}
