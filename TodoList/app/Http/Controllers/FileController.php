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
        $extention = $file->extension();
        switch ($extention) {
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
            $rs = $this->storeImg($request,'avatar');    
            return response()->json($rs, 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode());
        }
    }
    public function delete(Request $request) 
    {

        try {
            $request->validate([
                'img_name' =>'require|number'
            ]);    
            return response()->json($rs, 200);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode());
        }
        $request->validate([
            'img_name' =>'require|number'
        ]);

    }

}