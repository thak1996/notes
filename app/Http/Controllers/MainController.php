<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;

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
        return view('notes.new_note');
    }

    public function newNoteSubmit()
    {
        $note = request()->validate(
            [
                'text_title' => 'required|min:3|max:255',
                'text_note' => 'required|min:3|max:3000',
            ],
            [
                'text_title.required' => 'Title is required',
                'text_title.max' => 'Title cannot exceed :max characters',
                'text_title.min' => 'Title must be at least :min characters',
                'text_note.required' => 'Note content is required',
                'text_note.max' => 'Note content cannot exceed :max characters',
                'text_note.min' => 'Note content must be at least :min characters',
            ]
        );
        $id = session('user.id');
        $note = new Note();
        $note->user_id = $id;
        $note->title = $note['text_title'];
        $note->text = $note['text_note'];
        $note->save();
        return redirect()->route('home');
    }

    public function editNote($id)
    {
        $id = Operations::decryptId($id);
        $note = Note::find($id);
        return view('notes.edit_note', [
            'note' => $note,
        ]);
    }

    public function editNoteSubmit(Request $request) {
        $request->validate(
            [
                'text_title' => 'required|min:3|max:255',
                'text_note' => 'required|min:3|max:3000',
            ],
            [
                'text_title.required' => 'Title is required',
                'text_title.max' => 'Title cannot exceed :max characters',
                'text_title.min' => 'Title must be at least :min characters',
                'text_note.required' => 'Note content is required',
                'text_note.max' => 'Note content cannot exceed :max characters',
                'text_note.min' => 'Note content must be at least :min characters',
            ]
        );

        if ($request->note_id == null) {
            return redirect()->route('home');
        }

        $id = Operations::decryptId($request->note_id);
        $note = Note::find($id);
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        return redirect()->route('home');
    }

    public function deleteNote($id)
    {
        $id = Operations::decryptId($id);
        echo "Delete note with ID: $id";
    }
}
