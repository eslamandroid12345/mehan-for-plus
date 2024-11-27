<?php

namespace App\Http\Services\Dashboard\Settings;

use App\Http\Services\Mutual\FileManagerService;
use App\Http\Traits\FileManager;
use App\Repository\SettingRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SettingsService
{

    private SettingRepositoryInterface $settingRepository;
    protected FileManagerService $fileManager;

    public function __construct(
        SettingRepositoryInterface $settingRepository,
        FileManagerService $fileManagerService,
    )
    {
        $this->settingRepository = $settingRepository;
        $this->fileManager = $fileManagerService;
    }

    public function store($request) {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if (isset($data['default_profile_image'])) {
                $defaultProfileImagePath = $this->uploadDefaultProfileImage();
                $data['default_profile_image'] = $defaultProfileImagePath;
                Cache::forever('default_profile_image', $defaultProfileImagePath);
            }
            foreach ($data as $key => $value) {
                $this->settingRepository->_update($key, $value);
            }
            DB::commit();
            return redirect()->back()->with(['success' => __('messages.Settings saved successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    private function uploadDefaultProfileImage() {
        $oldPath = $this->settingRepository->getSetting('default_profile_image');
        return $this->fileManager->handle('default_profile_image', 'profiles', $oldPath);
    }

}
