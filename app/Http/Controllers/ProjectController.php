<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Appointment;
use App\Models\Booking;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{
    function getdata(Request $request){
        $data="This is the data part";
        return view('index',['key' => $data]);
    }
    //We Need to import the data of the departments table into the views using the model

    function getAllDepartments(Request $request){
        $departments=Department::all();
        return view('index',["departments" => $departments]);
    }

    function showappointments(Request $request){
        $department_id=$request->input('department_id');
        $appointments=Appointment::where('Dept_Id',$department_id)->get();
        return view('appointments',['appointments'=>$appointments]);
    }

    public function bookappointment(Request $request){
        $appointment_id=$request->input("appointment_id");
        $dept_name=$request->input("dept_name");
        $appointment_date=$request->input("appointment_date");

        $exists=Booking::where("appointment_id","=",$appointment_id)->exists();
        if($exists){
            //return "Appointment already booked";
            session::flash("message","Appointment already booked");
            session::flash('alert-class','alert-danger');
            return redirect('/');
        }
        else{
            //book this appointment

            $booking=new Booking();
            $booking->appointment_id=$appointment_id;
            $booking->Dept_Name=$dept_name;
            $booking->appointment_date=$appointment_date;
            $booking->username=Auth::user()->name;
            $booking->user_id=Auth::user()->id;

            $booking->save();

            //change appointment status 
            Appointment::where("id",$appointment_id)->update(['taken'=>1]);

             session::flash("message","Appointment booked successfully");
            session::flash('alert-class','alert-success');
            return redirect('/');


        }        
    }
    public function mybookings(Request $request){ 
        $bookings=Booking::where("user_id",Auth::user()->id)->get();
        return view('myBookings',['bookings'=>$bookings]);      
    }
    
    public function cancelbooking(Request $request){
        $booking_id=$request->input('booking_id');
        $appointment_id=$request->input('appointment_id');
        Booking::where('id',$booking_id)->delete();

        Appointment::where('id',$appointment_id)->update(['taken'=>0]);

         session::flash("message","Appointment cancelled successfully");
            session::flash('alert-class','alert-success');
            return redirect('/');

    }
}
