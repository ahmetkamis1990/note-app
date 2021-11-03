<?php

namespace App\Repositories;

use App\Models\Note;

class NoteRepository
{

    public function getByAccessKey($accessKey)
    {
       return Note::where('access_key', $accessKey)
            ->select('notes.*')
            ->first();
    }

    public function store($data)
    {
        return Note::create($data);
    }

    public function update($accessKey,$data)
    {
        return Note::where('access_key',$accessKey)->update($data);
    }

    public function delete($accessKey)
    {
        return Note::where('access_key',$accessKey)->delete();
    }


    public function list($userId)
    {
        return Note::where('user_id', $userId)
            ->orderBy('updated_at', 'DESC')
            ->get();
    }



}

