@extends('Layout.template')

@section('content')

    <div class="container">
        @if(isset($check))
            @if($check == 1)
                <div class="alert alert-success" role="alert">
                    Succesfull sended
                </div>
            @elseif($check = 2)
                <div class="alert alert-danger" role="alert">
                    Error to send
                </div>
            @endif




        @endif

            @if(Auth::user()->role == 1)
                <div class="alert alert-success" role="alert">
                    You are a super user!, please, click in the button to send the mail
                </div>
                @else
                <div class="alert alert-warning" role="alert">
                    You are not a super, get out of here!
                </div>
            @endif



        <div class="row">



            <div class="col-12">
                <form method="POST" action="{{url('/sendnotification')}}">
                    @csrf
                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            @if(Auth::user()->role == 1)
                                <button type="submit" class="btn btn-primary">
                                    Send Notify
                                </button>
                            @endif

                        </div>
                    </div>
                </form>

            </div>


        </div>
    </div>

@endsection
