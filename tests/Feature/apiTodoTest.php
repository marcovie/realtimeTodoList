<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\DataUsersModel;
use App\Models\DataTodoListModel;

class apiTodoTest extends TestCase
{
    use WithFaker;
    use withoutMiddleware;
    use RefreshDatabase;

    protected $user;

    public function setUp():void {
        parent::setUp();

        $this->user = factory(DataUsersModel::class)->create();

        $this->actingAs($this->user, 'api');
    }

    //create
    public function test_can_create_todo()
    {
        $data = [
            'title'         => $this->faker->sentence,
            'description'   => $this->faker->paragraph(20),
        ];

        $this->post(route('internalApi-Todo-List.store'), $data)
            ->assertStatus(200)
            ->assertJson(['message' => 'Successfully completed.']);
    }

    //update
    public function test_can_update_todo()
    {
        $todo = factory(DataTodoListModel::class)->make();

        $this->user->todo()->save($todo);

        $updatedData = [
            'id'            => $todo->id,
            'title'         => $this->faker->sentence,
            'description'   => $this->faker->paragraph(20),
        ];

        $this->json('PUT', route('internalApi-Todo-List.update', $todo->id), $updatedData)
            ->assertStatus(200)
            ->assertJson(['message' => 'Successfully updated.']);
    }

    //delete/destroy
    public function test_can_delete_todo()
    {
        $todo = factory(DataTodoListModel::class)->make();

        $this->user->todo()->save($todo);

        $this->delete(route('internalApi-Todo-List.destroy', $todo->id))->assertStatus(200);
    }

    //Get records from index api
    public function test_can_fetch_list_todos()
    {
        $todo = factory(DataTodoListModel::class, 3)->make();

        $this->user->todo()->saveMany($todo);

        $this->get(route('internalApi-Todo-List.index'))
        ->assertJson(['data'=> $todo->toArray()])
        ->assertJsonStructure([
            'successful',
            'message',
            'data'          =>  ['*'=>['created_by_user_id','title','description']],
            'definitions',
            'functionName',
        ])
        ->assertStatus(200);
    }
}
