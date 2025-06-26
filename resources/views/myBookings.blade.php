@extends('layouts.main')
@section('content')

<div class="container-lg" style="margin:0 auto;">
    <h2 class="text-center">MY BOOKINGS</h2>
     <table class="table table-hover">
    <thead>
        <tr>
            <th>Booking Id</th>
            <th>Appointment Id</th>
            <th>Department Name</th>
            <th>Appointment Date</th>
            <th>Cancel Booking</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr>
            <td>{{$booking->id}}</td>
            <td>{{$booking->appointment_id}}</td>
            <td>{{$booking->dept_name}}</td>
          <td>{{$booking->appointment_date}}</td> 
          <td>
            <form method="POST" action="{{route('cancelbooking')}}">
                @csrf
                <input type="text" value="{{$booking->id}}" name="booking_id" style="display:none">
                <input type="text" value="{{$booking->appointment_id}}" name="appointment_id" style="display:none">
                <input type="submit" value="Cancel" class="btn btn-danger">

            </form>
          </td> 
        @endforeach
    </tbody>

     </table>
</div>

@endsection