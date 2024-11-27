<?php

namespace App\Http\Services\Api\Favorites;

use App\Http\Traits\Responser;
use App\Repository\FavoriteRepositoryInterface;
use App\Repository\UserRepositoryInterface;

class FavoritesService
{
    use Responser;

    protected FavoriteRepositoryInterface $favoriteRepository;
    protected UserRepositoryInterface $userRepository;

    public function __construct(
        FavoriteRepositoryInterface $favoriteRepository,
        UserRepositoryInterface $userRepository,
    )
    {
        $this->favoriteRepository = $favoriteRepository;
        $this->userRepository = $userRepository;
    }

    public function toggle($id) {
        try {
            $user = $this->userRepository->getById($id);
            $this->favoriteRepository->toggle($user->seeker->id);
            return $this->responseSuccess();
        } catch (\Exception $e) {
            return $this->responseFail();
        }
    }
}
