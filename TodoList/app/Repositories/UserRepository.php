<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class UserRepository implements RepositoryBase
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create(array $datas) : User
    {
        return User::create($datas);
    }

    public function update($id, array $datas)
    {
        return User::where('id', $id)->update($datas);
    }

    public function delete($id)
    {
        $user = User::find($id);

        if(!$user) {
            return 111;
        }

        $user->delete();
    }

    public function read()
    {
        return DB::table('users')->get();
    }

    public function findByPK($id)
    {
        return User::find($id)->first();
    }
}
