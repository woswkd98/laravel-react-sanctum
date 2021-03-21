<?php


namespace App\Repositories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskRepository implements RepositoryBase
{
    protected Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;

    }

    public function create(array $datas) : Task
    {
        return Task::create($datas);
    }

    public function update($id, array $datas)
    {
        return Task::where('id', $id)->update($datas);
    }

    public function delete($id)
    {
        $task = Task::find($id);

        if(!$task) {
            return null;
        }

        $task->delete();
    }

    public function read()
    {
        return DB::table('tasks')->get();
    }

    public function readWithUser() {
        return DB::table('tasks')
            ->join('users', 'users.id', '=', 'tasks.user_id')
            ->select([
                'tasks.*',
                'users.email'
            ])->get();
    }

    public function findByPK($id)
    {
        return Task::find($id)->first();
    }

    public function findByUserKey()
    {
        return User::find(Auth::user()->id)->first()->tasks()->get();
    }

}
