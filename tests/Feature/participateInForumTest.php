<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class participateInForumTest extends TestCase
{

    use DatabaseMigrations;

    function unauthenticated_users_may_not_add_replies(){

        $this->expectExeption('Illuminate\Auth\AuthenticationExeption');
        $this->post('/threads/1/replies', []);

//        $thread = factory('App\Thread')->create();
//
//        $reply = factory('App\Reply')->create;
//        $this->post($thread->path().'/replies', $reply->toArray());

    }

    /** @test */
    function an_authenticated_user_may_participate_in_forum_threads(){
        $this->be($user = factory('App\User')->create());

        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->make();
        $this->post($thread->path().'/replies', $reply->toArray());

//        dd($thread->replies);

        $this->get($thread->path())->assertSee($reply->body);
    }
}
