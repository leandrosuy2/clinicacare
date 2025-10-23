<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Store a newly created appointment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date|after:now',
            'type' => 'required|in:consultation,follow_up,emergency',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Verificar se o usuário é médico
        if (!Auth::user()->isDoctor()) {
            return response()->json(['error' => 'Apenas médicos podem agendar consultas'], 403);
        }

        // Criar agendamento
        $appointment = Appointment::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => Auth::id(),
            'appointment_date' => $request->appointment_date,
            'type' => $request->type,
            'notes' => $request->notes,
            'status' => 'scheduled',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Consulta agendada com sucesso!',
            'appointment' => $appointment->load(['patient.user', 'doctor'])
        ]);
    }

    /**
     * Get appointments for a specific patient.
     */
    public function index(Request $request, $patientId)
    {
        $patient = Patient::findOrFail($patientId);
        
        // Verificar permissões
        if (Auth::user()->isPatient() && $patient->user_id !== Auth::id()) {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        $appointments = $patient->appointments()
            ->with(['doctor'])
            ->when($request->status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->orderBy('appointment_date', 'desc')
            ->get();

        return response()->json($appointments);
    }

    /**
     * Update appointment status.
     */
    public function updateStatus(Request $request, $appointmentId)
    {
        $request->validate([
            'status' => 'required|in:scheduled,completed,cancelled,no_show',
            'observations' => 'nullable|string|max:1000',
            'weight' => 'nullable|numeric|min:0|max:500',
        ]);

        $appointment = Appointment::findOrFail($appointmentId);
        
        // Verificar se o usuário é médico
        if (!Auth::user()->isDoctor()) {
            return response()->json(['error' => 'Apenas médicos podem atualizar consultas'], 403);
        }

        $appointment->update([
            'status' => $request->status,
            'observations' => $request->observations,
            'weight' => $request->weight,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status da consulta atualizado com sucesso!',
            'appointment' => $appointment->load(['patient.user', 'doctor'])
        ]);
    }

    /**
     * Get today's appointments for doctor.
     */
    public function today()
    {
        if (!Auth::user()->isDoctor()) {
            return response()->json(['error' => 'Apenas médicos podem ver agendamentos'], 403);
        }

        $appointments = Appointment::where('doctor_id', Auth::id())
            ->whereDate('appointment_date', today())
            ->with(['patient.user'])
            ->orderBy('appointment_date')
            ->get();

        return response()->json($appointments);
    }
}
