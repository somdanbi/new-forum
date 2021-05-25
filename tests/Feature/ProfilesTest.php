<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfilesTest extends TestCase
{

    use DatabaseMigrations;

    //ByManu revisa la linea 19, ya que de el tiene 2 corchetes

    /**  @test */
    function a_user_has_a_profile()
    {
        $user = create('App\User');

        $this->get("/profiles/{$user->name}")
            ->assertSee($user->name);
    }

    /** @test */
    function profiles_display_all_threads_created_by_the_associated_user()
    {
        //1. Create a user
        $user = create('App\User');
        //2. and a thread create by this user
        $thread = create('App\Thread', [ 'user_id' => $user->id ]);
        //3. when we visit this user profile: I assert to see the title and body
        $this->get("/profiles/{$user->name}")
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

}
