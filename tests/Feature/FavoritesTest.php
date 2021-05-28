<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavoritesTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    function guest_cannot_favorited_anything()
    {
        $this->withExceptionHandling()
            ->post('replies/1/favorites')
            ->assertRedirect('/login');
    }

    /**  @test */
    function an_authenticated_user_can_favorited_any_reply()
    {
        // 1. sign in
        $this->signIn();
        // 2. create a replie - /replies/id/favorites
        $reply = create('App\Reply');
        // 3. If I point a "favorite" endpoint
        $this->post('replies/' . $reply->id . '/favorites');
        /// 4. it should record in the db
        $this->assertCount(1, $reply->favorites);
    }

    /**  @test */
    function an_authenticated_user_can_unfavorited_a_reply()
    {
        $this->signIn();
        $reply = create('App\Reply');
        $this->post('replies/' . $reply->id . '/favorites');
        $this->assertCount(1, $reply->favorites);

        $this->delete('replies/' . $reply->id . '/favorites');
        $this->assertCount(0, $reply->fresh()->favorites);
    }


    /** @test */
    function an_authenticated_user_may_only_favorite_a_reply_once()
    {
        $this->signIn();
        $reply = create('App\Reply');
        try {
            $this->post('replies/' . $reply->id . '/favorites');
            $this->post('replies/' . $reply->id . '/favorites');

        } catch (\Exception $e) {
            $this->fail('Did not expect to insert the same record set twice');
        }
        $this->assertCount(1, $reply->favorites);
    }
}
