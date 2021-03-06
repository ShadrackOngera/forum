<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;


    /** @test */
    function guests_may_not_create_threads()
    {

        $this->withExceptionHandling();

        $this->get('/threads/create')
            ->assertRedirect('/login');

        $this->get('/threads/create')
            ->assertRedirect('/login');

//
//    $this->expectException('Illuminate\Auth\AuthenticationException');
//
//    $thread = make('App\Thread');
//    $this->post('/threads', $thread)->toArray();

    }

    /** @test */
    function an_authenticated_user_can_create_new_forum_threads()
    {
        $this->signIn();
        $thread = make('App\Thread');
        $response = $this->post('/threads', $thread->toArray());

        $response = $this->get($response->headers->get('location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    function a_thread_requires_a_title()
    {

        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');

    }

    public function publishThread($overrides)
    {

        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread', $overrides);


        return $this->post('/threads', $thread->toArray());
    }

    function a_thread_requires_a_body()
    {

        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');

    }

    function a_thread_requires_a_valid_channel()
    {
        factory('App\Channel', 2)->create();

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 999])
            ->assertSessionHasErrors('channel_id');


    }

}
