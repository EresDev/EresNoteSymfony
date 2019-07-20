<?php

namespace App\Domain\Service\Security;

use App\Domain\Exception\EntityDoesNotExistException;
use App\Domain\Exception\UserIsNotTheOwnerException;
use App\Domain\Repository\EntityOwnerProvider;

class OwnershipImpl implements Ownership
{
    private $security;
    private $entityOwnerProvider;

    public function __construct(
        Security $security,
        EntityOwnerProvider $entityOwnerProvider
    ) {
        $this->security = $security;
        $this->entityOwnerProvider = $entityOwnerProvider;
    }

    public function check(int $entityId) : void
    {
        $user = $this->entityOwnerProvider->getOwner($entityId);

        if ($user == null) {
            throw EntityDoesNotExistException::from(
                $entityId,
                get_class($this->entityOwnerProvider)
            );
        }

        if (!$this->security->isCurrentUser($user)) {
            throw UserIsNotTheOwnerException::from(
                $entityId,
                $this->security->getUser()->getId(),
                get_class($this->entityOwnerProvider)
            );
        }
    }
}
