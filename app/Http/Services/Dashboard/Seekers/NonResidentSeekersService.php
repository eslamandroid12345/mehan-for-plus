<?php

namespace App\Http\Services\Dashboard\Seekers;

use App\Http\Services\Mutual\FileManagerService;
use App\Repository\NationalityRepositoryInterface;
use App\Repository\SeekerRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class NonResidentSeekersService
{
    private UserRepositoryInterface $userRepository;
    private SeekerRepositoryInterface $seekerRepository;
    private NationalityRepositoryInterface $nationalityRepository;

    protected FileManagerService $fileManager;
    public function __construct(
        UserRepositoryInterface $userRepository,
        SeekerRepositoryInterface $seekerRepository,
        NationalityRepositoryInterface $nationalityRepository,
        FileManagerService $fileManagerService,
    )
    {
        $this->userRepository = $userRepository;
        $this->seekerRepository = $seekerRepository;
        $this->nationalityRepository = $nationalityRepository;
        $this->fileManager = $fileManagerService;
    }

    public function store($request) {
        DB::beginTransaction();
        try {
            $user = $this->storeUser($request);
            $this->storeSeeker($request, $user);
            DB::commit();
            return redirect()->route('non-resident-seekers.index')->with(['success' => __('messages.Seeker registered successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('non-resident-seekers.create')->with(['error' => __('messages.Something went wrong')]);
        }
    }

    private function storeUser($request) {
        return $this->userRepository->create([
            'user_type' => 1,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'image' => !is_null($request->image) ? $this->fileManager->handle('image', 'profiles') : null,
        ]);
    }

    private function storeSeeker($request, $user) {
        $seeker = $this->seekerRepository->create([
            'user_id' => $user->id,
            'job_id' => $request->job_id,
            'nationality_id' => $request->nationality_id,
            'gender' => $request->gender,
            'city_id' => $request->city_id,
            'is_resident' => 0,
            'religion' => $request->religion,
            'is_worked_before_in_ksa' => $request->is_worked_before_in_ksa,
            'cv' => !is_null($request->cv) ? $this->fileManager->handle('cv', 'CVs') : null,
        ]);
        return $seeker->skills()->sync($request->skills);
    }

    public function update($request, $id) {
        $user = $this->userRepository->getById($id);
        DB::beginTransaction();
        try {
            $this->updateUser($request, $user);
            $this->updateSeeker($request, $user);
            DB::commit();
            return redirect()->to($request->redirects_to)->with(['success' => __('messages.Seeker updated successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('non-resident-seekers.edit', $id)->with(['error' => __('messages.Something went wrong')]);
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

    private function updateSeeker($request, $user) {
        $data = [
            'job_id' => $request->job_id,
            'nationality_id' => $request->nationality_id,
            'gender' => $request->gender,
            'city_id' => $request->city_id,
            'is_worked_before_in_ksa' => $request->is_worked_before_in_ksa,
            'religion' => $request->religion,
        ];
        if(!is_null($request->cv)) {
            $data['cv'] = $this->fileManager->handle('cv', 'CVs', $user->seeker->cv);
        }
        $user->seeker->update($data);
        return $user->seeker->skills()->sync($request->skills);
    }

}
