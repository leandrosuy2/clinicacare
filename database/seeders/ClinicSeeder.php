<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar usuário médico
        $doctorUser = User::create([
            'name' => 'Dr. João Silva',
            'email' => 'joao.silva@clinicacare.com',
            'password' => Hash::make('password'),
            'role' => 'doctor',
            'email_verified_at' => now(),
        ]);

        Doctor::create([
            'user_id' => $doctorUser->id,
            'crm' => '12345-SP',
            'specialty' => 'Cardiologia',
            'phone' => '(11) 99999-9999',
            'bio' => 'Especialista em cardiologia com mais de 10 anos de experiência.',
            'is_active' => true,
        ]);

        // Criar usuário paciente
        $patientUser = User::create([
            'name' => 'Maria Santos',
            'email' => 'maria.santos@email.com',
            'password' => Hash::make('password'),
            'role' => 'patient',
            'email_verified_at' => now(),
        ]);

        Patient::create([
            'user_id' => $patientUser->id,
            'cpf' => '123.456.789-00',
            'birth_date' => '1985-05-15',
            'phone' => '(11) 88888-8888',
            'address' => 'Rua das Flores, 123 - São Paulo, SP',
            'emergency_contact' => 'João Santos',
            'emergency_phone' => '(11) 77777-7777',
            'allergies' => 'Penicilina',
            'medical_history' => 'Hipertensão controlada',
        ]);

        // Criar mais um médico
        $doctorUser2 = User::create([
            'name' => 'Dra. Ana Costa',
            'email' => 'ana.costa@clinicacare.com',
            'password' => Hash::make('password'),
            'role' => 'doctor',
            'email_verified_at' => now(),
        ]);

        Doctor::create([
            'user_id' => $doctorUser2->id,
            'crm' => '67890-SP',
            'specialty' => 'Pediatria',
            'phone' => '(11) 66666-6666',
            'bio' => 'Pediatra especializada em cuidados infantis.',
            'is_active' => true,
        ]);

        // Criar mais um paciente
        $patientUser2 = User::create([
            'name' => 'Carlos Oliveira',
            'email' => 'carlos.oliveira@email.com',
            'password' => Hash::make('password'),
            'role' => 'patient',
            'email_verified_at' => now(),
        ]);

        Patient::create([
            'user_id' => $patientUser2->id,
            'cpf' => '987.654.321-00',
            'birth_date' => '1990-08-22',
            'phone' => '(11) 55555-5555',
            'address' => 'Av. Paulista, 456 - São Paulo, SP',
            'emergency_contact' => 'Sofia Oliveira',
            'emergency_phone' => '(11) 44444-4444',
            'allergies' => 'Nenhuma',
            'medical_history' => 'Diabetes tipo 2',
        ]);
    }
}
