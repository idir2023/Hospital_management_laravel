<?php

namespace App\Http\Controllers;

use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function addView()
    {
        if (Auth::id()) {
            if (Auth::user()->typeuser == 1) {
                return view('admin.add_doctor');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }


    public function upload(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'room' => 'required|string',
            'speciality' => 'required|string',
            'image' => 'required|image', // Validez le fichier comme une image
        ]);

        $image = $request->file('image'); // Utilisez $request->file() pour accéder au fichier téléchargé
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('doctorimage'), $imagename);

        $doctor = new Doctor;
        $doctor->name = $request->input('name');
        $doctor->phone = $request->input('phone');
        $doctor->room = $request->input('room');
        $doctor->specialty = $request->input('speciality');
        $doctor->image = $imagename;
        $doctor->save();

        return redirect()->back()->with('message', 'Doctor Added Successfully');
    }
    public function showappointmet()
    {
        if (Auth::id()) {
            if (Auth::user()->typeuser == 1) {
                $appointment = Appointment::all();
                return view('admin.showappointmet', compact('appointment'));
            } else {
                return redirect()->back();
            }
        } else {
            return Redirect('login');
        }
    }
    public function approve($id)
    {
        $data = Appointment::find($id);
        $data->status = 'Approved';
        $data->save();
        return redirect()->back();
    }

    public function cancel($id)
    {
        $data = Appointment::find($id);
        $data->status = 'Canceled';
        $data->save();
        return redirect()->back();
    }

    public function showdoctor()
    {
        $doctor = Doctor::all();
        return view('admin.showdoctor', compact('doctor'));
    }

    public function deletedoctor($id)
    {
        $doctor = doctor::find($id);
        $doctor->delete();
        return redirect()->back();
    }

    public function Updatedoctor($id)
    {

        $doctor = Doctor::find($id);
        if (!$doctor) {
            // Gérez ici le cas où le médecin n'est pas trouvé
            return redirect()->back()->with('error', 'Doctor not found');
        }

        return view('admin.update_doctor', compact('doctor'));
    }

    public function editdoctor($id, Request $request)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            // Gérez ici le cas où le médecin n'est pas trouvé
            return redirect()->back()->with('error', 'Doctor not found');
        }

        $doctor->name = $request->input('name');
        $doctor->phone = $request->input('phone');
        $doctor->room = $request->input('room');
        $doctor->specialty = $request->input('speciality');
        $image = $request->file('image');
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('doctorimage'), $imagename);
            $doctor->image = $imagename;
        }

        $doctor->save();

        return redirect()->back()->with('message', 'Doctor Updated Successfully');
    }
    public function emailView($id)
    {
        $data = Appointment::find($id);
        return view('admin.email_view', compact('data'));
    }

    public function sendEmail(Request $request, $id)
    {
        $data = Appointment::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Appointment not found');
        }

        $details = [
            'greeting' => $request->input('greeting'),
            'body' => $request->input('body'),
            'actiontext' => $request->input('actiontext'),
            'actionurl' => $request->input('actionurl'),
            'endpart' => $request->input('endpart'),
        ];

        $users = $data->name;

        if ($users) {
            Notification::send($users, new SendEmailNotification($details));
            return redirect()->back()->with('message', 'Message sent successfully');
        } else {
            return redirect()->back()->with('message', 'User not found for this appointment');
        }
    }
}
