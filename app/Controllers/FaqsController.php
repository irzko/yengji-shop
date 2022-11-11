<?php

namespace App\Controllers;

use App\Models\Cart;
use App\Controllers\Controller;
use App\SessionGuard as Guard;

class FaqsController extends Controller
{
    public function index () {
        $this->sendPage('faq');
    }
}