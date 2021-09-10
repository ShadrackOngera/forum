<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class profilesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_has_a_profile()
    {
        $user = factory('App\User')->create();

        $this->withoutExceptionHandling();

        $this->get("/profiles/$user->name")->assertSee($user->name);
    }
}
