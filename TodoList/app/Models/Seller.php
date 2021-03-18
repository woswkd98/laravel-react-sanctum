<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    public function buyer() {
        return $this
            ->belongsToMany('App\Models\Buyer')
            ->using('App\Models\BuyerSeller')
            ->as('bidding') // 입찰이라고 한다 이 부분이 중간테이블 모델에 대한 이름을 지정하는 것으로 여기서는 입찰이라고 했지만 order 등으로 바꾸는게 가능하다
            ->withPivot([
                'created_at',
                'updated_at',
                'price'
            ]);
    }

    /* 실제로는 유저 연결용 입니다*/
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function findSeller($id) : Seller {
        return Seller::find($id)->first();
    }

}
