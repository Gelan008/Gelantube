@extends('Layout.template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Video</div>

                    <div class="card-body">
                        <form method="POST" action="{{isset($video) ? url('/video/update') : url('/video/store')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="video" class="col-md-4 col-form-label text-md-right float-left">Video</label>
                                @if(isset($video))
                                    <video class="embed-responsive-item mx-auto d-block" controls>
                                        <source src="{{ route('getVideo', $video->id)  }}" type="video/{{pathinfo($video->video_path)['extension']}}">
                                    </video>
                                @endif




                                <div class="col-md-6 mx-auto mt-3">
                                    <input type="file" name="video" id="video" accept="video/*" required>
                                </div>


                            </div>

                            <div class="form-group row">
                                <label for="thumbnail" class="col-md-4 col-form-label text-md-right">Thumbnail</label>

                                @if(isset($video))
                                    <img class="img-fluid img-circle d-block mx-auto mb-3" src="{{ route('getThumb', $video->id)  }}" alt="Card image cap">
                                @endif

                                <div class="col-md-6 mx-auto">
                                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*" required>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{isset($video) ? $video->title : ''}}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                                <div class="col-md-6">
                                    <textarea rows="10" id="description" type="text" class="form-control" name="description" required autofocus >{{isset($video) ? $video->description : ''}}</textarea>

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{isset($video) ? 'Update' : 'Upload'}} video
                                    </button>
                                </div>
                            </div>

                            <input type="hidden" name="id" id="id" value="{{isset($video) ? $video->id : ''}}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
