<?php

namespace App\Http\Controllers\Api\Favorites;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Favorite\FavoriteRequest;
use App\Http\Resources\FeedCollection;
use App\Http\Services\Api\Favorites\FavoritesService;
use App\Http\Services\Mutual\GetService;
use App\Repository\AdRepositoryInterface;
use App\Repository\FavoriteRepositoryInterface;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{

    private AdRepositoryInterface $adRepository;

    private FavoritesService $favorite;
    private GetService $get;

    public function __construct(
        AdRepositoryInterface $adRepository,
        FavoritesService      $favoriteService,
        GetService            $getService,
    )
    {
        $this->middleware('auth:api');
        $this->adRepository = $adRepository;
        $this->favorite = $favoriteService;
        $this->get = $getService;

    }

    public function toggle(FavoriteRequest $request) {
        return $this->favorite->toggle($request->user_id);
    }

    public function get() {
        return $this->get->handle(resource: FeedCollection::class, repository: $this->adRepository, method: 'favorites', is_instance: true);
    }
}
