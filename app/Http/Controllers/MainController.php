<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Note;

class MainController extends Controller
{
    public function index()
    {
        $id = session('user.id');
        $notes = User::find($id)->notes()->get()->toArray();
        return view('home', [
            'notes' => $notes,
        ]);
    }

    public function newNote()
    {
        echo 'Create a new note here!';
    }
}
