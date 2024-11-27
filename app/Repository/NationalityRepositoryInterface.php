<?php

namespace App\Repository;

interface NationalityRepositoryInterface extends RepositoryInterface
{
    public function isSaudi($nationality_id);
}
