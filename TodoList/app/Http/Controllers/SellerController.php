<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Services\UserService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\BuyerSeller;
use App\Models\Buyer;
use App\Models\Seller;
use Opis\Closure\SerializableClosure;


class SellerController extends Controller
{
    public function __construct()
    {
       
    }

    public function order(Request $request) {


        $newBidding = new BuyerSeller();
        $newBidding->seller_id =  $request->seller_id;
        $newBidding->buyer_id =  $request->buyer_id;
        $newBidding->price =  $request->price;
        $rs = $newBidding->save();

        return response([
            'msg' => $rs
        ],200);
    }

    public function getOrdersBySeller(Request $request) {

        $sellerId = $request->seller_id;
        $seller = Seller::find($sellerId)->first();
        return response($seller->buyer()->first()->user->name, 200);
    }
}
