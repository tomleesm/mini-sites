<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index() {
        $tasks = DB::select('SELECT id, content FROM tasks');
        return view('tasks.index')->with( 'tasks', $tasks );
    }

    public function store(Request $request) {
        $request->validate([
            'new-task' => 'required'
        ]);

        DB::transaction(function () use ($request) {
            DB::insert('INSERT INTO tasks (content, created_at, updated_at) VALUES ( ?, ?, ? )',
                [ $request->input('new-task'), now(), now() ]);
        });

        return redirect()->route('tasks.index');
    }

    public function edit($id) {
        $result = DB::select('SELECT id, content FROM tasks WHERE id = ?', [ $id ]);
        return view('tasks.edit')->with('task', $result[0]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'update-task' => 'required'
        ]);

        DB::transaction(function () use ($request, $id) {
            DB::update('UPDATE tasks SET content = ?, updated_at = ? WHERE id = ?', [
                $request->input('update-task'), now(), $id
            ]);
        });

        return redirect()->route('tasks.index');
    }

    public function destroy($id) {
        DB::transaction(function () use ($id) {
            DB::delete('DELETE FROM tasks WHERE id = ?', [ $id ]);
        });

        return redirect()-> route('tasks.index');
    }
}
