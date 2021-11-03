@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <a class="btn btn-sm btn-secondary" href="{{ url('/') }}">
                        Home Page
                    </a>

                    <div class="panel-heading">Create new note</div>
                    <div class="panel-body">
                        <form action="{{ url('note/create') }}" method="POST" class="form" role="form"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                                       placeholder="Enter title here..." required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                <textarea class="form-control" name="body" rows="3" placeholder="Enter note here..."
                                          required>{{ old('body') }}</textarea>

                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group" >
                                <img id="picture" style="display: none" height="100" width="100"/>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label>
                                <input type="file" class="form-control" style="height: 42px" name="image-file" id="image-file"
                                       onchange="loadFile(event)">
                            </div>




                            <button class="btn btn-primary pull-right">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function loadFile(event) {
            let reader = new FileReader();
            let imageFile = document.getElementById('image-file');
            let picture = document.getElementById('picture');
            reader.onload = function () {
                picture.src = reader.result;

            };
            if(imageFile.files.length >0) {
                picture.style.display='inline'
                reader.readAsDataURL(event.target.files[0]);
            }else{

                picture.style.display='none'
            }
        }
    </script>
@endsection
