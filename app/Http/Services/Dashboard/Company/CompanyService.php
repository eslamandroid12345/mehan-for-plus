<?php

namespace App\Http\Services\Dashboard\Company;

use App\Http\Services\Mutual\FileManagerService;
use App\Repository\NationalityRepositoryInterface;
use App\Repository\CompanyRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CompanyService
{
    private UserRepositoryInterface $userRepository;
    private CompanyRepositoryInterface $companyRepository;

    protected FileManagerService $fileManager;
    public function __construct(
        UserRepositoryInterface $userRepository,
        CompanyRepositoryInterface $companyRepository,
        NationalityRepositoryInterface $nationalityRepository,
        FileManagerService $fileManagerService,
    )
    {
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
        $this->fileManager = $fileManagerService;
    }

    public function store($request) {
        DB::beginTransaction();
        try {
            $user = $this->storeUser($request);
            $this->storeCompany($request, $user);
            DB::commit();
            return redirect()->route('companies.index')->with(['success' => __('messages.Company registered successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('companies.create')->with(['error' => __('messages.Something went wrong')]);
        }
    }

    private function storeUser($request) {
        return $this->userRepository->create([
            'user_type' => 0,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'image' => !is_null($request->image) ? $this->fileManager->handle('image', 'profiles') : null
        ]);
    }

    private function storeCompany($request, $user) {
        return $this->companyRepository->create([
            'user_id' => $user->id,
            'field_id' => $request->field_id,
        ]);
    }

    public function update($request, $id) {
        $user = $this->userRepository->getById($id);
        DB::beginTransaction();
        try {
            $this->updateUser($request, $user);
            $this->updateCompany($request, $user);
            DB::commit();
            return redirect()->to($request->redirects_to)->with(['success' => __('messages.Company updated successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('companies.edit', $id)->with(['error' => __('messages.Something went wrong')]);
        }
    }

    private function updateUser($request, $user) {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];
        if(!is_null($request->image)) {
            $data['image'] = $this->fileManager->handle('image', 'profiles', $user->getRawOriginal('image'));
        }
        if(!is_null($request->password)) {
            $data['password'] = $request->password;
        }
        return $user->update($data);
    }

    private function updateCompany($request, $user) {
        $data = [
            'user_id' => $user->id,
            'field_id' => $request->field_id,
        ];
        return $user->company->update($data);
    }

}
