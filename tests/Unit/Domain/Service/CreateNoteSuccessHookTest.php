<?php

namespace App\Tests\Unit\Domain\Service;

use App\Domain\Repository\EntitySaver;
use App\Domain\Service\CreateUserSuccessHookImpl;
use App\Tests\Extra\StubServices;
use App\Tests\Extra\ValidEntities;
use PHPUnit\Framework\TestCase;

class CreateNoteSuccessHookTest extends TestCase
{
    public function testProcess() : void
    {
        $user = ValidEntities::getUser();

        $passwordEncoder = StubServices::getPasswordEncoder(
            $user,
            'AnEncodedPassword'
        );

        $entitySaver = $this->createMock(EntitySaver::class);

        $successHook = new CreateUserSuccessHookImpl($passwordEncoder, $entitySaver);

        $userAfterSuccessHook = $successHook->process($user);

        $this->assertEquals('AnEncodedPassword', $userAfterSuccessHook->getPassword());
    }
}
