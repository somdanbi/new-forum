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
}
