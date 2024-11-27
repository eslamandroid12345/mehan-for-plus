<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Settings\SettingsRequest;
use App\Http\Services\Dashboard\Settings\SettingsService;
use App\Repository\SettingRepositoryInterface;

class SettingsController extends Controller
{
    private SettingRepositoryInterface $settingRepository;
    protected SettingsService $settings;

    public function __construct(
        SettingRepositoryInterface $settingRepository,
        SettingsService $settingsService,
    )
    {
        $this->middleware('auth:admin');
        $this->settingRepository = $settingRepository;
        $this->settings = $settingsService;
    }

    public function index()
    {
        $settings = $this->settingRepository->_getAll();
        return view('dashboard.site.settings.index', compact('settings'));
    }

    public function store(SettingsRequest $request)
    {
        return $this->settings->store($request);
    }
}
