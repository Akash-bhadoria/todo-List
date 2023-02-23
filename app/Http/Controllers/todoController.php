<?php

namespace App\Http\Controllers;

use App\Events\addNewTodo;
use App\Models\todoList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class todoController extends Controller
{

    public function addTask(Request $request)
    {
        $authId = Auth::id();

        $todoArr = [
            'todo_task' => $request->taskValue,
            'created_by' => $authId,
            'updated_by' => $authId,
        ];

        todoList::create($todoArr);

        $title = "New Task Added";
        $body = $this->getUserName() . " Added a Task in Todo List";

        event(new addNewTodo($authId, $title, $body));

        return response()->json(['status' => 'success', 'message' => 'Task Added Successfully']);
    }

    public function getTask()
    {
        $authId = Auth::id();
        $query = todoList::where(['created_by' => $authId, 'is_active' => 1])->get();
        return response()->json(['status' => 'success', 'data' => $query]);
    }

    public function deleteTask(Request $request)
    {
        $authId = Auth::id();
        todoList::where(['id' => $request->id, 'created_by' => $authId])->update(['is_active' => 0]);
        return response()->json(['status' => 'success', 'message' => 'Task Deleted Successfully']);
    }

    public function completeTask(Request $request)
    {
        $authId = Auth::id();
        todoList::where(['id' => $request->id, 'created_by' => $authId])->update(['is_done' => 1]);
        return response()->json(['status' => 'success', 'message' => 'Task Completed Successfully']);
    }

    public function notCompleteTask(Request $request)
    {
        $authId = Auth::id();
        todoList::where(['id' => $request->id, 'created_by' => $authId])->update(['is_done' => 0]);
        return response()->json(['status' => 'success', 'message' => 'Task Is Not Closed']);
    }

    public function getUserName()
    {
        return User::where('id', Auth::id())->value('name');
    }
}
