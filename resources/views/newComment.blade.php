@extends('Layout.template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Comment</div>

                    <div class="card-body">
                        <form method="POST" action="{{isset($comment) ? url('/comment/update') : url('/comment/store')}}">
                            @csrf

                            <div class="form-group row">
                                <label for="body" class="col-md-4 col-form-label text-md-right">Comment</label>

                                <div class="col-md-6">
                                    <textarea rows="10" id="body" type="text" class="form-control" name="body" required autofocus >{{isset($comment) ? $comment->body : ''}}</textarea>

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{isset($comment) ? 'Update' : 'Create'}} comment
                                    </button>
                                </div>
                            </div>

                            <input type="hidden" name="id" id="id" value="{{isset($comment) ? $comment->id : ''}}">

                            @if(isset($id_type_video))
                                <input type="hidden" name="id_type_video" id="id_type_video" value="{{$id_type_video}}">
                            @elseif(isset($id_type_user))
                                <input type="hidden" name="id_type_user" id="id_type_user" value="{{$id_type_user}}">
                            @endif


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
