@extends('layouts.main')
@section('content')

<div class="container-lg" style="margin:0 auto;">
    <h2 class="text-center">APPOINTMENTS</h2>
     <table  border-style:solid ; class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Department</th>
            <th>Appointment Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($appointments as $appointment)
        <tr>
            <td>{{$appointment->id}}</td>
            <td>{{$appointment->Dept_Name}}</td>
            <td>{{$appointment->appointment_date}}</td>
            @if($appointment->taken)
                <td>SLOT NOT AVAILABLE</td>
            @else
                <td>
                    <form method="POST" action="{{Route('bookappointment')}}">
                        @csrf
                        <input type="text" value="{{$appointment->id}}" name="appointment_id" style="display:none">
                        <input type="text" value="{{$appointment->Dept_Name}}" name="dept_name" style="display:none"> 
                        <input type="text" value="{{$appointment->appointment_date}}" name="appointment_date" style="display:none">
                        <input type=submit value='BOOK NOW' class="btn btn-primary">
                    </form>
                </td>
            @endif 
        </tr>
        @endforeach
    </tbody>

     </table>
</div>

@endsection