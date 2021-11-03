<?php

namespace App\Http\Controllers;

use App\Repositories\NoteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NoteController extends Controller
{


    protected $noteRepository;

    public function __construct()
    {
        $this->noteRepository = new NoteRepository();
    }

    public function index()
    {
        $notes = [];
        $isLoggedIn = Auth::check();

        if ($isLoggedIn) {
            $userId = Auth::id();
            $noteRepository = new NoteRepository();
            $notes = $noteRepository->list($userId);

        }
        return view('note.index', [
            'isLoggedIn' => $isLoggedIn,
            'notes' => $notes
        ]);
    }

    public function create()
    {

        return view('note.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $userId = Auth::id();

        $data = [
            'user_id' => $userId,
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'access_key' => uniqid()
        ];


        $file = $request->file('image-file');

        if($file != ""){
            $ext = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' .$ext;
            $data['image'] = $fileName;
            $file->move(base_path().'/public/uploads', $fileName);
        }


        if ($this->noteRepository->store($data)) {
            return redirect('/');
        } else {
            Log::error("An error has occurred while storing note : ".json_encode($data));
        }

    }

    public function show($accessKey)
    {
        $note = $this->noteRepository->getByAccessKey($accessKey);
        return view('note.view', [
            'note' => $note
        ]);
    }

    public function edit($accessKey)
    {
        $note = $this->noteRepository->getByAccessKey($accessKey);
        return view('note.edit', [
            'note' => $note
        ]);
    }

    public function update(Request $request, $accessKey)
    {

        $validatedData = $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $data = [
            'title' => $validatedData['title'],
            'body' => $validatedData['body']
        ];

        $file = $request->file('image-file');

        if($file != ""){
            $ext = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' .$ext;
            $data['image'] = $fileName;
            $file->move(base_path().'/public/uploads', $fileName);
        }


        if ($this->noteRepository->update($accessKey,$data)) {
            return redirect('/');
        } else {
            Log::error("An error has occurred while updating note : ".$accessKey);
        }
    }

    public function destroy(Request $request, $accessKey)
    {

        if ($this->noteRepository->delete($accessKey)) {
            return redirect('/');
        } else {
            Log::error("An error has occurred while deleting note : ".$accessKey);
        }

    }

}
