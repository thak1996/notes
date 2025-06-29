<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        echo 'Welcome to the main page!';
    }

    public function newNote()
    {
        echo 'Create a new note here!';
    }
}
