<?php

namespace App\Controllers;

use App\Models\Order;
use App\Controllers\Controller;
use App\SessionGuard as Guard;

class OrdersController extends Controller
{

	public function getOrder()
	{
        if (!Guard::isUserLoggedIn()) {
            redirect('/login');
        }

        if (Guard::user()->permissionLevel === 2) {
            $orders = Order::all();
            $this->sendPage('order', ['orders' => $orders]);
        } else {
            redirect('/home');
        }
	}

    public function findOrderById($OrderId)
	{
        if (!Guard::isUserLoggedIn()) {
            redirect('/login');
        }

        if (Guard::user()->permissionLevel === 2) {
            $order = Order::find($OrderId);
            echo $order;
        } else {
            redirect('/home');
        }
	}


    public function addOrder()
    {   
        if (!Guard::isUserLoggedIn()) {
            redirect('/login');
        }

        $data = $this->filterOrderData($_POST); 
        // echo '<pre>'; print_r($data); echo '</pre>';
        $order = new Order();
        $order->fill($data);
        $order->save();
        $prod = ProductsController::findById($data['product_id']);
        $prod->update(['sold' => $prod->sold + $data['amount'], 'remaining' => $prod->remaining - $data['amount']]);

    }

    public function removeOrder()
    {
        // $data = $this->filterOrderData($_POST); 
        // Order::where('user_id', '=', $data['user_id'])->where('product_id', '=', $data['product_id'])->delete();
        Order::find($_POST['id'])->delete();
    }

    protected function filterOrderData(array $data)
    {
        return [
            'user_id' => Guard::user()->id,
            'product_id' => $data['product_id'],
            'amount' => $data['amount'],
            'unit_price' => $data['unit_price'],
            'delivery_address' => $data['delivery_address'],
            'phone_number' => $data['phone_number']
        ];
    }

}

?>