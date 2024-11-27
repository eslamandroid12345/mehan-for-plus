<?php

namespace App\Repository;

interface AdRepositoryInterface extends RepositoryInterface
{
    public function publish($seeker_id, $values, $silently);

    public function feeds();

    public function filter($request);

    public function favorites();

    public function incrementView($id);

    public function endExpiredAds();

    public function hired($id);

    public function bestFive();

}
