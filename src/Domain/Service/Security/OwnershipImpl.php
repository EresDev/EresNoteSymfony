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
            throw new EntityDoesNotExistException(
                404,
                sprintf(
                    'Owner of the given Entity ID does not exist in the database. ' .
                    'Entity ID: %s. ' .
                    'Entity repository class: %s. ',
                    $entityId,
                    get_class($this->entityOwnerProvider)
                )
            );
        }

        if (!$this->security->isCurrentUser($user)) {
            throw new UserIsNotTheOwnerException(
                401,
                sprintf(
                    'Currently authenticated user is not the owner of the given Entity ID. ' .
                    'Entity ID: %s. ' .
                    'Entity repository class: %s. ',
                    $entityId,
                    get_class($this->entityOwnerProvider)
                )
            );
        }
    }
}
