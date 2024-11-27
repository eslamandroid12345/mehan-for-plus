<?php

namespace App\Repository;

interface ChatRoomRepositoryInterface extends RepositoryInterface
{

    public function rooms();

    public function provide($user_id);

    public function search($user1, $user2 = null);

}
