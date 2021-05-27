<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{

    use DatabaseMigrations, DatabaseTransactions;

    /** @test */
    public function an_authenticated_users_may_not_add_replies()
    {
        $this->withExceptionHandling()
            ->post('/threads/some-channel/1/replies', [])
            ->assertRedirect('/login');
    }

    /** @test */
    function an_authenticated_user_may_participated_in_forum_threads()
    {

        $this->signIn();
        $thread = create('App\Thread');
        $reply = make('App\Reply');

        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply', [ 'body' => null ]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }

    /** @test */
    function unauthorized_user_cannot_delete_replies()
    {
        $this->withExceptionHandling();

        // I have a reply
        $reply = create('App\Reply');

        // and I want to deleted, but it'll redirect to login page
        $this->delete("/replies/{$reply->id}")
            ->assertRedirect('login');
    }
}
