<?php
namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    private function storeImg(Request $request, $name)
    {
        $file = $request->file($name);
        if(!$file) {
            return 'empty file';
        }

        $extention = $file->extension();
        if(!$extention) {
            return 'empty extention';
        }

        switch ($extention) {
            // 확장자 추가
            case 'png':
            case 'jpeg':
            case 'jpg':
                $path = Storage::putFile('public/'.Auth::user()->id, $file, 'public');
                $image = new Image;
                $image->user_id = Auth::user()->id;
                $image->name = $file->getClientOriginalName();
                $image->path = $path;
                $image->save();
                return [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path
                ];
            default:
                return 'form is not img :'.$extention;
        }
    }

    public function update(Request $request)
    {
        try {
            $rs = $this->storeImg($request,'file');
            return response($rs, 200);
        } catch (\Throwable $th) {
            return response([
                'error msg' => $th->getMessage(),
                'error code' => $th->getCode()
            ], 200);
        }
    }
    public function delete(Request $request)
    {
       
    }

    public function getImgIndex() {
        if(Auth::user() === null) {
            return response([
                'msg' => 'not login'
            ], 200);
        }
        $datas = DB::table('images')
            ->select()
            ->where('user_id', Auth::user()->id)
            ->get();
        return response([
            'imageInfos' => $datas,
        ], 200);
    }

    public function getImageFromId($id) {
        if(Auth::user() === null) {
            return response([
                'msg' => 'not login'
            ], 200);
        }
        $rs = DB::table('images')
            ->select(['path'])
            ->where([
                'id' => $id,
                'user_id' => Auth::user()->id
            ])->first();

        return response([
            'imageInfos' => $rs,
        ], 200);
    
        
    }
}
