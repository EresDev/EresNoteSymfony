<?php

namespace App\Domain\Service\Security;

use App\Domain\Exception\EntityDoesNotExistException;
use App\Domain\Exception\UserIsNotTheOwnerException;

interface Ownership
{
    /**
     * @throws EntityDoesNotExistException
     * @throws UserIsNotTheOwnerException
     */
    public function check(int $entityId) : void;
}
