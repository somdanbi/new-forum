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
}
