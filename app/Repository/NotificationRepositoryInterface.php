<?php

namespace App\Repository;

interface NotificationRepositoryInterface extends RepositoryInterface
{
    public function fetch();

    public function read();

    public function unreadCount();

    public function deleteAll();
}
