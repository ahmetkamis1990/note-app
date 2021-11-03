<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\NoteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NoteApiController extends Controller
{
    protected $noteRepository;

    public function __construct()
    {
        $this->noteRepository = new NoteRepository();
    }


    public function list()
    {

        $user = auth()->user();

        if ($user == null) {
            return response(['errors' => ['Invalid User']]);
        }

        $notes = $this->noteRepository->list($user->id);
        return response(['errors' => [], 'notes' => $notes]);

    }


    public function store(Request $request)
    {

        $validatedData = $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
        $user = auth()->user();

        $data = [
            'user_id' => $user->id,
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'access_key' => uniqid()
        ];

        if ($this->noteRepository->store($data)) {
            return response(['errors' => [], 'note' => $data]);
        } else {
            return response(['errors' => ['Internal Error Has Occurred']]);
        }

    }

    public function show($accessKey)
    {
        $note = $this->noteRepository->getByAccessKey($accessKey);
        if ($note != null) {
            return response(['errors' => [], 'note' => $note]);
        } else {
            return response(['errors' => ['Invalid Access Key']]);
        }

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


        if ($this->noteRepository->update($accessKey, $data)) {
            return response(['errors' => [], 'note' => $data]);
        } else {
            return response(['errors' => ['Invalid Access Key']]);
        }

    }


    public function destroy($accessKey)
    {

        if ($this->noteRepository->delete($accessKey)) {
            return response(['errors' => []]);
        } else {
            return response(['errors' => ['Invalid Access Key']]);
        }

    }

}
