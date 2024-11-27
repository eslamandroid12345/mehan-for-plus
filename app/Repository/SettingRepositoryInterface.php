<?php

namespace App\Repository;

interface SettingRepositoryInterface extends RepositoryInterface
{

    public function _getAll();

    public function _update($key, $value);

    public function getSetting($key);

}
