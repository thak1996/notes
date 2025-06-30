<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Note;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

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
        $id = $this->decryptId($id);
        echo "Edit note with ID: $id";
    }

    public function deleteNote($id)
    {
        $id = $this->decryptId($id);
        echo "Delete note with ID: $id";
    }

    private function decryptId($id)
    {
        try {
            return Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('home');
        }
        return $id;
    }
}
