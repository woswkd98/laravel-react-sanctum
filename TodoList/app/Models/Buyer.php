<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;


    public function seller() {
        return $this
            ->belongsToMany('App\Models\Seller')
            ->using('App\Models\BuyerSeller')
            ->withPivot([
                'created_at',
                'updated_at',
                'price'
            ]);

    }


    public function findBuyer($id) : Buyer {
        return Buyer::find($id)->first();
    }

    /* 주석 달았지만 실제로는 연결입니다 */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

}
