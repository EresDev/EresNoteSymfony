<?php

namespace App\Tests\Unit\Domain\Service\Security;

use App\Domain\Exception\EntityDoesNotExistException;
use App\Domain\Exception\UserIsNotTheOwnerException;
use App\Domain\Service\Security\OwnershipImpl;
use App\Tests\Extra\StubServices;
use App\Tests\Extra\ValidEntities;
use PHPUnit\Framework\TestCase;

class OwnershipImplTest extends TestCase
{
    public function testCheckWhenThereIsNoOwner() : void
    {
        $this->expectException(EntityDoesNotExistException::class);

        $user = ValidEntities::getUser();
        $security = StubServices::getSecurity('getUser', $user);
        $entityOwnerProvider = StubServices::getEntityOwnerProvider(null);

        $ownership = new OwnershipImpl($security, $entityOwnerProvider);

        $ownership->check(1);

    }

    public function testCheckWhenUserIsNotTheOwner() : void
    {
        $this->expectException(UserIsNotTheOwnerException::class);

        $security = StubServices::getSecurity('isCurrentUser', false);
        $user = ValidEntities::getUser();
        $entityOwnerProvider = StubServices::getEntityOwnerProvider($user);

        $ownership = new OwnershipImpl($security, $entityOwnerProvider);

        $ownership->check(1);

    }
}
