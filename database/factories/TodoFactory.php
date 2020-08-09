<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\DataTodoListModel;
use Faker\Generator as Faker;

$factory->define(DataTodoListModel::class, function (Faker $faker) {
    return [
        'created_by_user_id' => 1,
        'title' => $faker->sentence,
        'description' => $faker->paragraph(20),
    ];
});
