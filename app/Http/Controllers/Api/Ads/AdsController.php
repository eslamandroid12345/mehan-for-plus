<?php

namespace App\Http\Controllers\Api\Ads;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Ads\PublishAdsRequest;
use App\Http\Services\Api\Ads\AdsService;
use App\Http\Traits\FileManager;
use App\Http\Traits\Responser;
use Illuminate\Support\Facades\Gate;

class AdsController extends Controller
{
    use Responser, FileManager;

    protected AdsService $ads;

    public function __construct(AdsService $adsService)
    {
        $this->middleware('auth:api');
        $this->middleware('can:activate-ad')->only('activate');
        $this->ads = $adsService;
    }

    public function publish(PublishAdsRequest $request) {
        return $this->ads->publish($request);
    }

    public function activate() {
        return $this->ads->activate();
    }

    public function hired() {
        return $this->ads->hired();
    }
}
