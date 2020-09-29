<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ToDoTest extends TestCase
{
    use withFaker, RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function cannot_create_task_without_login()
    {
        $task = [
            'body' => $this->faker->sentence,
            'status' => false
        ];

        $response = $this->json('POST', '/api/v1/tasks/store',$task);
        $response->assertStatus(401);
        $response->assertJson(['message' => "Unauthenticated."]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function can_user_create_task()
    {
        $category = Category::factory()->create();
        $title = $this->faker->sentence;
        $task = [
            'task' => $title,
            'status' => 0,
            'category_id' => $category->id
        ];

        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')
                        ->json('POST', '/api/v1/tasks/store',$task);

        $response->assertStatus(200);
        $response->assertJson(['status' => 0]);
        $response->assertJson(['task' => $title]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function can_user_update_task()
    {
        list( $user, $task ) = $this->createDummyTask();

        $response = $this->actingAs($user, 'api')
            ->json('PATCH', '/api/v1/tasks/update', ['id' => $task->id, 'status' => 1]);

        $response->assertStatus(200);
        $response->assertJson(['status' => 1]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function can_user_delete_task()
    {
//        $this->withoutExceptionHandling();
        list( $user, $task ) = $this->createDummyTask();

        $response = $this->actingAs($user, 'api')
            ->json('POST', '/api/v1/tasks/destroy', ['id' => $task->id]);

        $response->assertStatus(200);
        $this->assertDeleted('tasks', $task->toArray());
    }

    /**
     * @return array
     */
    public function createDummyTask(): array
    {
        $category = Category::factory()->create();
        $title = $this->faker->sentence;

        $user = User::factory()->create();
        $task = Task::factory( [
            'user_id'     => $user->id,
            'task'        => $title,
            'status'      => 0,
            'category_id' => $category->id
        ] )->create();

        return array($user, $task);
    }
}
