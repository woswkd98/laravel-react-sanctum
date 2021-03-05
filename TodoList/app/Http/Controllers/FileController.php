<?php 
namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

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
            // 
            case 'png':
            case 'jpg':
                $path = $file->store($name);
                return 'success '.$path;
            default:
                return 'form is not img :'.$extention;
        }
    } 

    public function update(Request $request) 
    {
        try {
            $rs = $this->storeImg($request,'file');    
            return response()->json($rs, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error msg' => $th->getMessage(),
                'error code' => $th->getCode()
            ], 200);
        }
    }
    public function delete(Request $request) 
    {
        try {
            $validate = $request->validate([
                'img_name' =>'require|number'
            ]);    
            
            return response()->json([
                'msg' => 'success'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode());
        }
    }

    public function getImgs(Request $request) {

    }
}