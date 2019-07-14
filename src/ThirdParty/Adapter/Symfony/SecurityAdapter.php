<?php

namespace App\ThirdParty\Adapter\Symfony;

use App\Domain\Entity\User;
use App\Domain\Exception\EntityDoesNotExistException;
use App\Domain\Exception\UserIsNotTheOwnerException;
use App\Domain\Exception\UserNotAuthenticatedException;
use App\Domain\Repository\EntityOwned;
use App\Domain\Service\Security\Ownership;
use App\Domain\Service\Security\Security;
use Symfony\Component\Security\Core\Security as SymfonySecurity;

class SecurityAdapter implements Security, Ownership
{
    private $security;
    private $entityOwned;

    public function __construct(SymfonySecurity $security, EntityOwned $entityOwned)
    {
        $this->security = $security;
        $this->entityOwned = $entityOwned;
    }

    public function getUser(): User
    {
        $user = $this->security->getUser();

        if ($user == null) {
            throw new UserNotAuthenticatedException(
                'User is not authenticated to perform the action.'
            );
        }

        return $user;
    }

    public function check(int $entityId) : void
    {
        $user = $this->entityOwned->getOwner($entityId);

        if ($user == null) {
            throw new EntityDoesNotExistException(
                404,
                'Given entity does not exist to perform the action.'
            );
        }

        if (!$this->getUser()->equals($user)) {
            throw new UserIsNotTheOwnerException(
                401,
                'User does not own the entity to perform the action.'
            );
        }
    }
}
