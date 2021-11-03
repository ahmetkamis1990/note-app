@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>
                            <a class="btn btn-sm btn-primary" href="{{ url('note/create') }}">
                                Create Note
                            </a>
                        </h1>
                    </div>
                    <div class="panel-body">
                    <!--<div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong> <?php
                    // echo $_SESSION["status_delete"]; ?></strong>
                        </div>
-->
                        @if($notes->isEmpty())
                            <p>
                                There is not any notes yet!
                            </p>
                        @else
                            <table class="table table-responsive">
                                @foreach($notes as $note)
                                    <tr>
                                        <td class="col-md-7">
                                            {{ $note->title }}
                                        </td>
                                        <td class="col-md-1">
                                            <a class="btn btn-sm btn-secondary"
                                               href="{{ url('note/view', [$note->access_key]) }}">
                                                View
                                            </a>
                                        </td>
                                        <td class="col-md-1">
                                            <a class="btn btn-sm btn-secondary"
                                               href="{{ url('note/edit', [$note->access_key]) }}">
                                                Edit
                                            </a></td>
                                        <td class="col-md-1">
                                            <a class="btn btn-sm btn-secondary"
                                               href="#" onclick="copyUrl('{{$note->access_key}}')">
                                                Share
                                            </a>
                                        </td>
                                        <td class="col-md-1">
                                            <a class="btn btn-sm btn-danger"
                                               href="{{ url('note/delete', [$note->access_key]) }}">
                                                Delete
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function copyUrl(accessKey) {

            let url = window.location.protocol + "//" + window.location.host + "/shared-note/view/" + accessKey

            navigator.clipboard.writeText(url).then(function () {
                alert('Url has been copied!');
            }, function (err) {
                console.error('Could not copy text: ', err);
            });
        }
    </script>
@endsection
