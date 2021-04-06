<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{

    use DatabaseMigrations, DatabaseTransactions;

    /** @test */
    function an_authenticated_user_can_create_new_forum_threads()
    {
        // Given we have a signed user
        $this->actingAs(make('App\User'));

        // when we hit the endpoint to createa new thread
        $thread = make('App\Thread');

        $this->post('/threads', $thread->toArray());

        // then we visit the thread path and
        // We should see the new thread
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);

    }

    /** @test */
    function guests_may_not_create_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $thread = make('App\Thread');
        $this->post('/threads', $thread->toArray());
    }

}
