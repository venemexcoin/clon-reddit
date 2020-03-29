<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostsControllerTest extends TestCase

{

    use DatabaseMigrations;

    /** @test */

    public function a_guest_can_see_all_the_posts()
    {
        // Arrange

        $posts = factory(\App\Post::class, 10)->create();

        //Act

        $response = $this->get(route('post_path'));

        //assert

        $response->assertStatus(200);

        foreach ($posts as $post) {
            $response->assertSee($post->title);
        }
    }
}
