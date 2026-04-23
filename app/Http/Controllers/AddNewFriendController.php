<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddNewFriendController extends Controller
{
    public function addNewFriendView(){
        return view('add-new-friend');
    }
}
