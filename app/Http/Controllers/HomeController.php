<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Appointment;

class HomeController extends Controller
{
    public function redirect()
    {
        // Vérifier si l'utilisateur est authentifié
        if (Auth::check()) {
            // Obtenir l'utilisateur actuellement authentifié
            $user = Auth::user();

            // Vérifier le type d'utilisateur (usertype)
            if ($user->typeuser === '0') {
                $doctor = doctor::all();
                // Rediriger l'utilisateur normal vers le tableau de bord
                return view('user.home', compact('doctor'));
            } else {
                // Rediriger les autres utilisateurs vers la page d'accueil de l'interface d'administration
                return view('admin.home');
            }
        }

        // Si l'utilisateur n'est pas authentifié, rediriger vers la page précédente
        return redirect()->back();
    }
    public function index()
    {
        if (Auth::id()) {
            return redirect('home');
        } else {
            $doctor = doctor::all();
            return view('user.home', compact('doctor'));
        }
    }

    public function appointment(Request $request) // Renommer la fonction en "appointment"
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'phone' => 'required|string',
            'doctor' => 'required|string',
            'date' => 'required|date', // Utilisation de 'date' pour valider la date
            'message' => 'required|string',
        ]);
    
        $data = new Appointment;
    
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->doctor = $request->input('doctor');
        $data->date = $request->input('date');
        $data->message = $request->input('message');
        $data->status = 'In progress';
    
        if (Auth::check()) { // Vérifier si un utilisateur est connecté
            $data->user_id = Auth::user()->id; // Utiliser le nom de l'utilisateur connecté
        } else {
            $data->name = $request->input('name');
        }
    
        $data->save();
    
        return redirect()->back()->with('message', 'Rendez-vous ajouté avec succès');
    }
    

    public function myappointment()
    {
        if (Auth::id()) {
            if (Auth::user()->typeuser == 0) {
                $userid = Auth::user()->id;
                $appointment = Appointment::where('user_id', $userid)->get();
                return view('user.my_appointment', compact('appointment'));
            } else {
                return Redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }

    public function cancel_appoint($id)
    {
        $data = appointment::find($id);
        $data->delete();
        return redirect()->back();
    }
}
