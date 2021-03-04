<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use Exception;
use App\Models\Task;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $this->authorizeResource(Task::class, 'task');

    }

    public function index()
    {
        return response()->json([
            'data' => $this->taskRepository->read()
        ]);
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
                'title' => 'required',
                'context' => 'required',
            ]);

            if($validator->fails())
            {
                return response()->json([
                    'error' => $validator->errors()->all()
                ], 200);
            }

            $datas = [
                'title' => $request->title,
                'context' => $request->context,
                'user_id' => Auth::user()->id
            ];

            $this->taskRepository->create($datas);

            return response()->json([
                'msg' => 'success'
            ], 200);

        } catch(Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ],  $e->getCode());
        }
        //$this->taskRepository->create($request->toArray());
        return response()->json([
            'msg' => $request->toArray()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
            'user_id' => Auth::user()->id
        ];

        return $this->taskRepository->update($id, $datas);


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
            $this->taskRepository->delete($id);
            return response()->json([
                'error' => 'success'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode());
        }

    }

    public function showByUserId()
    {
        $datas = $this->taskRepository->findByUserKey();
        return response()->json([
            'body' => $datas
        ], 200);


    }
}
