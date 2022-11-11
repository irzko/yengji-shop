<?php


namespace App\Controllers;
use App\SessionGuard as Guard;
use App\Controllers\Controller;
use App\Models\Product;

class ProfilesController extends Controller
{
    public function index() {
        $user = Guard::user();
        $this->sendPage('profile', ["user" => $user]);
    }
}