<?php
use App\Models\Project;

test('should get projects', function () {
    $this->get(route('projects.index').'?sortBy=id&sortDirection=desc')->assertStatus(200);
});

test('should fail to get projects', function () {
    $this->get(route('projects.index'))->assertStatus(302);
});

test('should get one project', function () {
    $this->get(route('projects.index').'/100')->assertStatus(200);
});

test('should create a project', function () {
    $this->post(route('projects.store'),
        [
            'name' => 'Yes',
            'description' => 'By the way',
            'status' => 1,
            'priority' => 1
        ]
    )
    ->assertStatus(201);
});

test('should update a project', function () {

    $project = Project::latest()->first();

    $this->put(route('projects.update', $project->id),
        [
            'name' => 'No',
            'description' => 'Anyway',
            'status' => 0,
            'priority' => 9
        ]
    )
    ->assertStatus(200);
});

test('should delete a project', function () {

    $project = Project::latest()->first();

    $this->delete(route('projects.destroy', $project->id))
    ->assertStatus(200);
});
