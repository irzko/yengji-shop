<?php

namespace App\Controllers;

use App\Models\Cart;
use App\Controllers\Controller;
use App\SessionGuard as Guard;

class CartsController extends Controller
{

	public function getCart()
	{
        if (!Guard::isUserLoggedIn()) {
            redirect('/login');
        }

		$carts = Cart::all()->where('user_id', '=', Guard::user()->id);
		$this->sendPage('cart', ['carts' => $carts]);
	}

    public function addCart()
    {   
        if (!Guard::isUserLoggedIn()) {
            redirect('/login');
        }
        $data = $this->filterCartData($_POST); 
        $old_carts = Cart::where('user_id', '=', $data['user_id'])->where('product_id', '=', $data['product_id'])->get();
        if(count($old_carts) != 0) {
            Cart::where('user_id', '=', $data['user_id'])->where('product_id', '=', $data['product_id'])->update(['amount' => $data['amount']]);
        } else {
            $cart = new Cart();
            $cart->fill($data);
            $cart->save();
        }

    }

    public function removeCart()
    {
        $data = $this->filterCartData($_POST); 
        Cart::where('user_id', '=', $data['user_id'])->where('product_id', '=', $data['product_id'])->delete();
    }

    protected function filterCartData(array $data)
    {
        return [
            'user_id' => Guard::user()->id,
            'product_id' => $data['product_id'],
            'amount' => $data['amount']
        ];
    }

}

?>