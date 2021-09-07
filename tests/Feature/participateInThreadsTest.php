<?php

namespace Tests\Feature;

use App\Channel;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class participateInThreadsTest extends TestCase
{

    use DatabaseMigrations;

    function unauthenticated_users_may_not_add_replies(){

        $this->withExceptionHandling()
            ->post('/threads/some-channel/1/replies', [])
            ->assertRedirect('/login');


//        $thread = Thread::factory()->create();
//        $channel = Channel::factory()->create([
//            'thread_id' => $thread->id
//        ]);
//
//        $this->withExceptionHandling()
//            ->post('/threads/'.$channel->id.'/'.$thread->id.'/'.'/replies', [])
//            ->assertRedirect('/login');



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
