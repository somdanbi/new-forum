<?php

namespace Tests\Unit;


use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ThreadTest extends TestCase
{

    use DatabaseMigrations, DatabaseTransactions;
    protected $thread;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    function a_thread_has_replies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /** @test */
    function a_thread_has_a_creator()
    {
        $this->assertInstanceOf('App\User', $this->thread->creator);
    }

    /** @test */
    function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1,
        ]);
        $this->assertCount(1, $this->thread->replies);
    }
}
