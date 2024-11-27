<?php

namespace App\Providers;

use App\Exceptions\ActivateAdException;
use App\Exceptions\DeleteNotificationException;
use App\Http\Traits\Responser;
use App\Repository\JobRepositoryInterface;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    use Responser;
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('publish-ad', function ($user) {
            return is_null($user->seeker->ad) || $user->seeker->ad->is_active == 0;
        });

        Gate::define('activate-ad', function ($user) {
            if(!is_null($user->seeker->ad) && $user->seeker->ad->is_active == 1) {
                throw new ActivateAdException;
            }
            return true;
        });

        Gate::define('create-chat-room', function ($user) {
            return $user->user_type == 0;
        });

        Gate::define('access-chat-room', function ($user, $chat_room_id) {
            return $user->chatRooms()->where('chat_room_id', $chat_room_id)->exists();
        });

        Gate::define('delete-admin', function ($admin, $adminId) {
            return $admin->id != $adminId;
        });

        Gate::define('delete-job', function ($admin, $job) {
            return !$job->seekers()->exists();
        });

        Gate::define('delete-skill', function ($admin, $skill) {
            return !$skill->seekers()->exists();
        });

        Gate::define('delete-country', function ($admin, $country) {
            return !$country->cities()->exists() && $country->name_en != 'Saudi Arabia';
        });

        Gate::define('edit-country', function ($admin, $country) {
            return $country->name_en != 'Saudi Arabia';
        });

        Gate::define('delete-city', function ($admin, $city) {
            return !$city->seekers()->exists();
        });

        Gate::define('delete-field', function ($admin, $field) {
            return !$field->companies()->exists();
        });

        Gate::define('delete-nationality', function ($admin, $nationality) {
            return !$nationality->seekers()->exists();
        });

        Gate::define('delete-qualification', function ($admin, $qualification) {
            return !$qualification->ads()->exists();
        });

        Gate::define('delete-seeker', function ($admin, $seeker) {
            return !$seeker->ad?->is_active;
        });

        Gate::define('admin-publish-ad', function ($admin, $seeker) {
            return $seeker->job_id !== null;
        });

        Gate::define('delete-notification', function ($user, $notification) {
            return $user->notifications()->wherePivot('notification_id', $notification)->exists();
        });
    }
}
