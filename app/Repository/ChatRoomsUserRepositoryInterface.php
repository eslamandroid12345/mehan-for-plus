<?php

namespace App\Repository;

interface ChatRoomsUserRepositoryInterface extends RepositoryInterface
{

    public function read($room_id);

}
