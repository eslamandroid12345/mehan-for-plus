<?php

namespace App\Providers;

use App\Repository\AdminRepositoryInterface;
use App\Repository\AdRepositoryInterface;
use App\Repository\ChatMessageRepositoryInterface;
use App\Repository\ChatRoomRepositoryInterface;
use App\Repository\ChatRoomsUserRepositoryInterface;
use App\Repository\CityRepositoryInterface;
use App\Repository\CompanyRepositoryInterface;
use App\Repository\CountryRepositoryInterface;
use App\Repository\Eloquent\AdminRepository;
use App\Repository\Eloquent\AdRepository;
use App\Repository\Eloquent\ChatMessageRepository;
use App\Repository\Eloquent\ChatRoomRepository;
use App\Repository\Eloquent\ChatRoomsUserRepository;
use App\Repository\Eloquent\FavoriteRepository;
use App\Repository\Eloquent\NotificationRepository;
use App\Repository\Eloquent\PasswordResetRepository;
use App\Repository\Eloquent\ProfileViewRepository;
use App\Repository\Eloquent\QualificationRepository;
use App\Repository\Eloquent\Repository;
use App\Repository\Eloquent\CityRepository;
use App\Repository\Eloquent\CompanyRepository;
use App\Repository\Eloquent\CountryRepository;
use App\Repository\Eloquent\FieldRepository;
use App\Repository\Eloquent\JobRepository;
use App\Repository\Eloquent\NationalityRepository;
use App\Repository\Eloquent\SeekerRepository;
use App\Repository\Eloquent\SettingRepository;
use App\Repository\Eloquent\SkillRepository;
use App\Repository\Eloquent\StructureRepository;
use App\Repository\Eloquent\TransactionRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\FavoriteRepositoryInterface;
use App\Repository\NotificationRepositoryInterface;
use App\Repository\PasswordResetRepositoryInterface;
use App\Repository\ProfileViewRepositoryInterface;
use App\Repository\QualificationRepositoryInterface;
use App\Repository\RepositoryInterface;
use App\Repository\FieldRepositoryInterface;
use App\Repository\JobRepositoryInterface;
use App\Repository\NationalityRepositoryInterface;
use App\Repository\SeekerRepositoryInterface;
use App\Repository\SettingRepositoryInterface;
use App\Repository\SkillRepositoryInterface;
use App\Repository\StructureRepositoryInterface;
use App\Repository\TransactionRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, Repository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(SeekerRepositoryInterface::class, SeekerRepository::class);
        $this->app->bind(AdRepositoryInterface::class, AdRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(FieldRepositoryInterface::class, FieldRepository::class);
        $this->app->bind(JobRepositoryInterface::class, JobRepository::class);
        $this->app->bind(NationalityRepositoryInterface::class, NationalityRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(SkillRepositoryInterface::class, SkillRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(QualificationRepositoryInterface::class, QualificationRepository::class);
        $this->app->bind(FavoriteRepositoryInterface::class, FavoriteRepository::class);
        $this->app->bind(ProfileViewRepositoryInterface::class, ProfileViewRepository::class);
        $this->app->bind(ChatRoomRepositoryInterface::class, ChatRoomRepository::class);
        $this->app->bind(ChatRoomsUserRepositoryInterface::class, ChatRoomsUserRepository::class);
        $this->app->bind(ChatMessageRepositoryInterface::class, ChatMessageRepository::class);
        $this->app->bind(StructureRepositoryInterface::class, StructureRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
        $this->app->bind(PasswordResetRepositoryInterface::class, PasswordResetRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
