<?php

use App\Http\Controllers\Api\Ads\AdsController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Chat\ChatController;
use App\Http\Controllers\Api\Company\CompanyController;
use App\Http\Controllers\Api\Favorites\FavoritesController;
use App\Http\Controllers\Api\Fields\FieldsController;
use App\Http\Controllers\Api\Jobs\JobsController;
use App\Http\Controllers\Api\Locations\LocationsController;
use App\Http\Controllers\Api\Notification\NotificationController;
use App\Http\Controllers\Api\Qualifications\QualificationsController;
use App\Http\Controllers\Api\Seekers\SeekersController;
use App\Http\Controllers\Api\Skills\SkillsController;
use App\Http\Controllers\Api\Structure\StructureController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([
    'middleware' => 'localize-api',
    // 'domain' => 'api.mhnplus.com'
], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('register', [AuthController::class, 'register']);
        Route::post('register/decide-residency-fields', [AuthController::class, 'decideResidencyFields']);
        Route::post('register/assign-job-and-skills', [AuthController::class, 'assignJobsAndSkills']);
        Route::post('profile-image', [AuthController::class, 'uploadProfileImage']);
        Route::group(['prefix' => 'reset-password'], function () {
            Route::post('request', [AuthController::class, 'resetPasswordRequest']);
            Route::post('code', [AuthController::class, 'resetPasswordCode']);
            Route::post('submit', [AuthController::class, 'resetPasswordSubmit']);
        });
    });

    Route::group(['prefix' => 'get'], function () {
        Route::get('jobs', [JobsController::class, 'getAll']);
        Route::get('skills', [SkillsController::class, 'getAll']);
        Route::get('fields', [FieldsController::class, 'getAll']);
        Route::get('nationalities', [LocationsController::class, 'getAllNationalities']);
        Route::get('countries', [LocationsController::class, 'getAllCountries']);
        Route::get('cities/{country:id}', [LocationsController::class, 'getCountryCities'])->name('getCountryCities');
        Route::get('saudi-cities', [LocationsController::class, 'getSaudiCities']);
        Route::get('qualifications', [QualificationsController::class, 'getAll']);
    });

    Route::group(['prefix' => 'search'], function () {
        Route::post('jobs', [JobsController::class, 'search']);
        Route::post('skills', [SkillsController::class, 'search']);
    });

    Route::group(['prefix' => 'seeker'], function () {
        Route::group(['prefix' => 'home'], function () {
            Route::get('details', [SeekersController::class, 'details']);
        });
        Route::group(['prefix' => 'ads'], function () {
            Route::post('publish', [AdsController::class, 'publish']);
            Route::post('activate', [AdsController::class, 'activate']);
            Route::post('hired', [AdsController::class, 'hired']);
        });
    });

    Route::group(['prefix' => 'company'], function () {
        Route::group(['prefix' => 'home'], function () {
            Route::get('feeds', [CompanyController::class, 'feeds']);
            Route::post('filter', [CompanyController::class, 'filter']);
        });
        Route::group(['prefix' => 'seeker'], function () {
            Route::get('{user:id}', [CompanyController::class, 'seeker']);
            Route::post('view', [CompanyController::class, 'view']);
        });
        Route::group(['prefix' => 'favorites'], function () {
            Route::get('/', [FavoritesController::class, 'get']);
            Route::post('toggle', [FavoritesController::class, 'toggle']);
        });
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', [CompanyController::class, 'profile']);
            Route::post('update', [CompanyController::class, 'update']);
        });
    });

    Route::group(['prefix' => 'chat'], function () {
        Route::get('rooms', [ChatController::class, 'rooms']);
        Route::post('provide', [ChatController::class, 'provide']);
        Route::post('attach', [ChatController::class, 'attach']);
        Route::post('send', [ChatController::class, 'send']);
        Route::post('read', [ChatController::class, 'read']);
        Route::get('unread-count', [ChatController::class, 'unreadCount']);
    });

    Route::group(['prefix' => 'notifications'], function () {
        Route::get('get', [NotificationController::class, 'get']);
        Route::post('read', [NotificationController::class, 'read']);
        Route::get('unread-count', [NotificationController::class, 'unreadCount']);
        Route::delete('delete', [NotificationController::class, 'delete']);
        Route::delete('delete-all', [NotificationController::class, 'deleteAll']);
    });

    Route::group(['prefix' => 'structure'], function () {
        Route::get('best-five', [StructureController::class, 'bestFive']);
        Route::get('{key}', [StructureController::class, 'get']);
    });

});
