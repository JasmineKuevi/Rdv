<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create(Request $request)
    {
        $doctors = Doctor::with('user:id,name')
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($doctor) {
                $name = $doctor->user?->name ?? 'Medecin';
                $specialty = $doctor->specialite ?: 'Generaliste';

                return [
                    'id' => $doctor->id,
                    'label' => 'Dr '.$name.' - '.$specialty,
                ];
            });

        return view('rendezvous.create', [
            'doctors' => $doctors,
            'prefillDoctor' => $request->integer('doctor'),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => ['required', 'exists:doctors,id'],
            'scheduled_at' => ['required', 'date', 'after:now'],
            'reason' => ['nullable', 'string', 'max:1000'],
        ], [
            'scheduled_at.after' => 'La date et l heure doivent etre dans le futur.',
        ]);

        $exists = Appointment::where('user_id', $request->user()->id)
            ->where('scheduled_at', $validated['scheduled_at'])
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['scheduled_at' => 'Vous avez deja un rendez-vous a ce creneau.'])
                ->withInput();
        }

        Appointment::create([
            'user_id' => $request->user()->id,
            'doctor_id' => $validated['doctor_id'],
            'scheduled_at' => $validated['scheduled_at'],
            'status' => Appointment::STATUS_PENDING,
            'reason' => $validated['reason'] ?? null,
        ]);

        return redirect()
            ->route('patient.dashboard')
            ->with('success', 'Votre demande de rendez-vous a ete enregistree.');
    }

    public function show(Appointment $appointment)
    {
        return redirect()
            ->route('patient.dashboard')
            ->with('status', 'Rendez-vous du '.$appointment->formatted_date.'.');
    }

    public function edit(Appointment $appointment)
    {
        return redirect()->route('rendezvous.create', [
            'doctor' => $appointment->doctor_id,
        ]);
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->update([
            'status' => Appointment::STATUS_CANCELLED,
        ]);

        return redirect()
            ->route('patient.dashboard')
            ->with('success', 'Rendez-vous annule.');
    }
}
