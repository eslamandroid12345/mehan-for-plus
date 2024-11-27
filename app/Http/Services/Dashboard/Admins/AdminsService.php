<?php

namespace App\Http\Services\Dashboard\Admins;

use App\Repository\AdminRepositoryInterface;

class AdminsService
{

    protected AdminRepositoryInterface $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function store($request) {
        $this->adminRepository->create($request->validated());
        return redirect()->route('admins')->with(['success' => __('messages.Admin was registered successfully')]);
    }

}
