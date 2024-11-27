<?php

namespace App\Repository;

interface ProfileViewRepositoryInterface extends RepositoryInterface
{

    public function isViewedBefore($ad_id);

}
