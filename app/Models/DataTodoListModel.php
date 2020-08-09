<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataTodoListModel extends Model
{
    use SoftDeletes;

    protected $fillable = ['title','completed'];

    protected $table    = 'data_todo_list';
}
