<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\HtmlPurifierService;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::with('user')
            ->where('user_id', request()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('note.view', ['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'note' => ['required', 'string']
        ]);

        $data['user_id'] = $request->user()->id;
        $note = Note::create(['note' => HtmlPurifierService::clean($data['note']), 'user_id' => $data['user_id']]);

        return to_route('note.detail', $note)->with('message', 'Note was create');
    }

    /**
     * Display the specified resource.
     */
    public function detail(Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }
        return view('note.detail', ['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }
        $data = $request->validate([
            'note' => ['required', 'string']
        ]);

        $note->update($data);

        return to_route('note.detail', $note)->with('message', 'Note was updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }
        $note->delete();

        return to_route('note.index')->with('message', 'Note was deleted');
    }
}
