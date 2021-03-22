<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected UserRepository $userRepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        // 여기도 마찬가지로 스토어 부분은 넣는 부분이므로 건들면 안됨
        // policy 설정
        $this->authorizeResource(User::class, 'user', ['except' => 'store']);
    }

    public function index()
    {
        return response([
                'body' => $this->userRepository->read()
            ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6|confirmed',
            ]);

            if($validator->fails())
            {
                return response([
                    'error' => $validator->errors()->all()
                ], 200);
            }

            $datas = [
                'password' => Hash::make($request->password, ['round' => env('PASSWORD_HASH_ROUND')]),
                'email' => $request->email,
                //'remember_token' => Str::random(10), spa 인증용은 이게 없어도 됨
                'name' => $request->name,
                'grade' => "user"
            ];

            $user = $this->userRepository->create($datas);

            return response([
                'msg' => 'success ',
                'user_email' => $user->email,
                'user_id' => $user->id,

            ], 200);

         } catch(Exception $e) {
            return response([
                'msg' => 'Error in Registration',
                'error' => $e,
            ], 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response($this->userRepository->findByPK($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response($this->userRepository->update($id, $request->toArray()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            return response($this->userRepository->delete($id), 200);
        } catch (\Throwable $th) {
            return response('delete fali : '.$th->getMessage(),  $th->getCode());
        }
    }
}
