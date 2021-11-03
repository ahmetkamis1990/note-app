@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <a class="btn btn-sm btn-secondary" href="{{ url('/') }}">
                    Home Page
                </a>
                <div class="panel panel-default">
                    <div class="panel-heading">Edit note</div>
                    <div class="panel-body">
                        <form method="post" action="{{url('note/edit/'.$note->access_key)}}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="form-group"><input type="text" name="title" class="form-control"
                                                           value="{{ $note->title }}">
                            </div>
                            <div class="form-group"><textarea name="body" rows="5"
                                                              class="form-control">{{ $note->body }}</textarea></div>


                            <div class="form-group">
                                <img id="picture" src="/uploads/{{ $note->image }}"
                                     style="display: {{ $note->image?'':'none'}}" height="100" width="100"/>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label>
                                <input type="file" class="form-control" style="height: 42px" name="image-file"
                                       id="image-file"
                                       onchange="loadFile(event)">
                            </div>


                            <script>
                                function loadFile(event) {
                                    let reader = new FileReader();
                                    let imageFile = document.getElementById('image-file');
                                    let picture = document.getElementById('picture');
                                    reader.onload = function () {
                                        picture.src = reader.result;

                                    };
                                    if (imageFile.files.length > 0) {
                                        picture.style.display = 'inline'
                                        reader.readAsDataURL(event.target.files[0]);
                                    } else {

                                        picture.style.display = 'none'
                                    }
                                }
                            </script>

                            <input type="submit" class="btn btn-primary pull-right" value="Save"/>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
