<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PatientPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PatientPhotoController extends Controller
{
    /**
     * Store a newly uploaded photo.
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'patient_id' => 'required|exists:patients,id',
            'photo_type' => 'required|in:profile,evolution',
            'description' => 'nullable|string|max:500',
            'weight' => 'nullable|numeric|min:0|max:500',
            'photo_date' => 'required|date',
        ]);

        // Verificar se o usuário tem permissão para fazer upload
        $patient = Patient::findOrFail($request->patient_id);
        
        // Se for médico, pode fazer upload para qualquer paciente
        // Se for paciente, só pode fazer upload para si mesmo
        if (Auth::user()->isPatient() && $patient->user_id !== Auth::id()) {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        // Upload da foto
        $photoPath = $request->file('photo')->store('patient-photos', 'public');

        // Criar registro da foto
        $photo = PatientPhoto::create([
            'patient_id' => $request->patient_id,
            'photo_path' => $photoPath,
            'photo_type' => $request->photo_type,
            'description' => $request->description,
            'weight' => $request->weight,
            'photo_date' => $request->photo_date,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Foto enviada com sucesso!',
            'photo' => $photo->load('patient')
        ]);
    }

    /**
     * Get photos for a specific patient.
     */
    public function index(Request $request, $patientId)
    {
        $patient = Patient::findOrFail($patientId);
        
        // Verificar permissões
        if (Auth::user()->isPatient() && $patient->user_id !== Auth::id()) {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        $photos = $patient->photos()
            ->when($request->type, function ($query, $type) {
                return $query->where('photo_type', $type);
            })
            ->orderBy('photo_date', 'desc')
            ->get();

        return response()->json($photos);
    }

    /**
     * Delete a photo.
     */
    public function destroy($photoId)
    {
        $photo = PatientPhoto::findOrFail($photoId);
        
        // Verificar permissões
        if (Auth::user()->isPatient() && $photo->patient->user_id !== Auth::id()) {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        // Deletar arquivo físico
        Storage::disk('public')->delete($photo->photo_path);
        
        // Deletar registro
        $photo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Foto excluída com sucesso!'
        ]);
    }
}
