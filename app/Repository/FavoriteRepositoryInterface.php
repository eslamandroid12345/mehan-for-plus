<?php

namespace App\Repository;

interface FavoriteRepositoryInterface extends RepositoryInterface
{
    public function toggle($seeker_id);

}
