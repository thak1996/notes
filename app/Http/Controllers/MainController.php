<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Operations;

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

    public function editNote($id)
    {
        $id = Operations::decryptId($id);
        echo "Edit note with ID: $id";
    }

    public function deleteNote($id)
    {
        $id = Operations::decryptId($id);
        echo "Delete note with ID: $id";
    }
}
