<?php

namespace App\Repository;

interface PasswordResetRepositoryInterface extends RepositoryInterface
{

    public function createCode($email, $code);

    public function search($code, $email);

}
