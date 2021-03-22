<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use Exception;
use App\Models\Task;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function index()
    {

        return response([
            'posts' => $this->taskRepository->readWithUser()
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
            if(Auth::user() === null) {
                return response([
                    'msg' => '로그인 안되있음'
                ], 200);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'context' => 'required',
            ]);

            if($validator->fails())
            {
                return response([
                    'msg' => $validator->errors()->all()
                ], 200);
            }

            $datas = [
                'title' => $request->title,
                'context' => $request->context,
                'user_id' => Auth::user()->id
            ];

            $this->taskRepository->create($datas);

            return response([
                'msg' => 'success'
            ], 200);

        } catch(Exception $e) {
            return response([
                'msg' => $e->getMessage()
            ],  $e->getCode());
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

        return response([
            'msg' => '성공',
            'post' => $this->taskRepository->findByPK($id)
        ], 200);

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


        $rs = $request->validate([
            'title' => 'required',
            'context' => 'required'
        ]);

        $datas = [
            'title' => $request->title,
            'context' => $request->context,
        ];

        return response([
            'msg' => $this->taskRepository->update($id, $datas)
        ], 200);



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
            $task = $this->taskRepository->findByPK($id);
            if(Auth::user()->id !== $task->user_id) {
                return response([
                    'msg' => '삭제할 수 없습니다'
                ], 200);
            }
            $task->delete();
            return response([
                'msg' => 'success'
            ], 200);
        } catch (Exception $e) {
            return response([
                'msg' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function showByUserId()
    {
        $datas = $this->taskRepository->findByUserKey();
        return response([
            'body' => $datas
        ], 200);
    }
}
