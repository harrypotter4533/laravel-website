@extends('layouts.main') 
@section('content')

<div class="container-lg" style="margin:0 auto;">
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
            {{ Session::get('message') }}
        </p>
    @endif

    <div class="row mt-5 ms-5"> 
        
        @foreach($departments as $department)
        <div class="col-lg-4 col-md-4 col-sm-12 text-center mb-3"><!--margin bottom 3 and margin left and right are 5 -->
            
            <div class="card" style="width: 18rem">
                <img src="{{$department->image}}" style="width:200px ;margin:0 auto"/>
                <div class="card-title"> {{$department->Name}} </div>
                <div class="card-content">{{$department->Description}}</div>

                <form method="post" action="{{route('showappointments')}}" class='mt-2 mb-1'>
                    @csrf
            
                    <input type=text name='department_id' value='{{$department->id}}' style='display:none'>
                    <input type=submit value='show appointments' class='btn btn-primary'>
                </form>

            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection