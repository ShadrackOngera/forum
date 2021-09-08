<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    function setUp(): void
        {
            parent::setUp();

            $this->thread = factory('App\Thread')->create();
        }

    /** @test  */
    public function a_user_can_view_all_threads()
        {
            $this->get('/threads')
                ->assertSee($this->thread->title);

        }

    function a_user_can_read_a_single_thread()
        {

            $this->get($this->thread->path())
                ->assertSee($this->thread->title);
        }

    function a_user_can_read_replies_that_are_associated_with_a_thread()
        {
            $reply = factory('App\Reply')
                ->create(['thread_id' => $this->thread->id]);

            $response = $this->get($this->thread->path())
                ->assertSee($reply->body);
        }

        function a_user_can_filter_threads_according_to_a_channel(){
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id ]);
        $threadNotInChannel = create('App\Channel');

        $this->get('/threads/'. $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
        }

        function a_user_can_filter_threads_by_any_username(){
            $this->signIn(create('App\User', ['name' => 'JohnDoe']));

            $threadByJohn = create('App\Thread', ['user_id' => auth()->id()]);
            $threadNotByJohn = create('App\Thread');

            $this->get('threads?by=JohnDoe')
                ->assertSee($threadByJohn->title)
                ->assertDontSee($threadNotByJohn->title);
        }
}
