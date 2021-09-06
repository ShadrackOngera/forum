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
            $response = $this->get('/threads')
                ->assertSee($this->thread->title);

        }

    function a_user_can_read_a_single_thread()
        {

            $response = $this->get($this->thread->path())
                ->assertSee($this->thread->title);
        }

    function a_user_can_read_replies_that_are_associated_with_a_thread()
        {
            $reply = factory('App\Reply')
                ->create(['thread_id' => $this->thread->id]);

            $response = $this->get($this->thread->path())
                ->assertSee($reply->body);
        }
}