<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserhomepageController extends Controller
{
    public function index()
    {
        return view ('userhomepage.index');
    }
}

