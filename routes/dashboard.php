<?php

use App\Http\Controllers\Dashboard\Admins\AdminsController;
use App\Http\Controllers\Dashboard\Ads\AdsController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\Chats\ChatsController;
use App\Http\Controllers\Dashboard\Cities\CitiesController;
use App\Http\Controllers\Dashboard\Company\CompaniesController;
use App\Http\Controllers\Dashboard\Countries\CountriesController;
use App\Http\Controllers\Dashboard\Fields\FieldsController;
use App\Http\Controllers\Dashboard\Home\HomeController;
use App\Http\Controllers\Dashboard\Jobs\JobsController;
use App\Http\Controllers\Dashboard\Nationalities\NationalitiesController;
use App\Http\Controllers\Dashboard\Notification\NotificationController;
use App\Http\Controllers\Dashboard\Qualifications\QualificationsController;
use App\Http\Controllers\Dashboard\Seekers\NonResidentSeekersController;
use App\Http\Controllers\Dashboard\Seekers\ResidentSeekersController;
use App\Http\Controllers\Dashboard\Settings\SettingsController;
use App\Http\Controllers\Dashboard\Skills\SkillsController;
use App\Http\Controllers\Dashboard\Structure\AboutUsController;
use App\Http\Controllers\Dashboard\Structure\ContactUsController;
use App\Http\Controllers\Dashboard\Structure\CreditsController;
use App\Http\Controllers\Dashboard\Structure\PrivacyPolicyController;
use App\Http\Controllers\Dashboard\Structure\TermsAndConditionsController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'domain' => 'dashboard.mhnplus.com',
], function() {

    Route::get('/', [HomeController::class, 'index'])->name('/');

    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', [AuthController::class, '_login']);
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::resource('admins', AdminsController::class)->except('show');

    Route::resource('resident-seekers', ResidentSeekersController::class);

    Route::resource('non-resident-seekers', NonResidentSeekersController::class);

    Route::resource('companies', CompaniesController::class);

    Route::resource('ads', AdsController::class)->except(['create', 'store', 'destroy']);

    Route::resource('jobs', JobsController::class)->except('show');

    Route::resource('skills', SkillsController::class)->except('show');

    Route::resource('fields', FieldsController::class)->except('show');

    Route::resource('countries', CountriesController::class)->except('show');

    Route::resource('cities', CitiesController::class)->except('show');

    Route::resource('nationalities', NationalitiesController::class)->except('show');

    Route::resource('notifications', NotificationController::class)->only(['index', 'store']);

    Route::resource('qualifications', QualificationsController::class)->except('show');

    Route::group(['prefix' => 'structures'], function () {
//        Route::resource('home', \App\Http\Controllers\Dashboard\Structure\HomeController::class)->only(['index', 'store']);
        Route::resource('contact-us', ContactUsController::class)->only(['index', 'store']);
        Route::resource('credits', CreditsController::class)->only(['index', 'store']);
        Route::resource('about-us', AboutUsController::class)->only(['index', 'store']);
        Route::resource('terms-and-conditions', TermsAndConditionsController::class)->only(['index', 'store']);
        Route::resource('privacy-policy', PrivacyPolicyController::class)->only(['index', 'store']);
    });

    Route::group(['prefix' => 'content'], function () {
        Route::resource('about', \App\Http\Controllers\Dashboard\Structure\Content\AboutUsController::class)->only(['index', 'store']);
        Route::resource('home', \App\Http\Controllers\Dashboard\Structure\Content\HomeController::class)->only(['index', 'store']);
    });

    Route::resource('settings', SettingsController::class)->only(['index', 'store']);

    Route::controller(ChatsController::class)
        ->prefix('chats')
        ->as('chats.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'search')->name('search');
            Route::get('/{room:id}', 'get')->name('get');
        });
});

