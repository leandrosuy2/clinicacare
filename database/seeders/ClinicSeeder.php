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
        // Criar médicos
        $doctors = [
            [
                'user' => [
                    'name' => 'Dr. João Silva',
                    'email' => 'joao.silva@clinicacare.com',
                    'password' => Hash::make('password'),
                    'role' => 'doctor',
                    'email_verified_at' => now(),
                ],
                'doctor' => [
                    'crm' => '12345-SP',
                    'specialty' => 'Cardiologia',
                    'phone' => '(11) 99999-9999',
                    'bio' => 'Especialista em cardiologia com mais de 10 anos de experiência. Focado em prevenção e tratamento de doenças cardiovasculares.',
                    'is_active' => true,
                ]
            ],
            [
                'user' => [
                    'name' => 'Dra. Ana Costa',
                    'email' => 'ana.costa@clinicacare.com',
                    'password' => Hash::make('password'),
                    'role' => 'doctor',
                    'email_verified_at' => now(),
                ],
                'doctor' => [
                    'crm' => '67890-SP',
                    'specialty' => 'Endocrinologia',
                    'phone' => '(11) 66666-6666',
                    'bio' => 'Endocrinologista especializada em diabetes e obesidade. Experiência em medicina preventiva e estilo de vida saudável.',
                    'is_active' => true,
                ]
            ],
            [
                'user' => [
                    'name' => 'Dr. Pedro Mendes',
                    'email' => 'pedro.mendes@clinicacare.com',
                    'password' => Hash::make('password'),
                    'role' => 'doctor',
                    'email_verified_at' => now(),
                ],
                'doctor' => [
                    'crm' => '11111-SP',
                    'specialty' => 'Nutrição Clínica',
                    'phone' => '(11) 77777-7777',
                    'bio' => 'Nutricionista clínico com foco em reeducação alimentar e perda de peso saudável. Especialista em dietas personalizadas.',
                    'is_active' => true,
                ]
            ],
            [
                'user' => [
                    'name' => 'Dra. Carla Rodrigues',
                    'email' => 'carla.rodrigues@clinicacare.com',
                    'password' => Hash::make('password'),
                    'role' => 'doctor',
                    'email_verified_at' => now(),
                ],
                'doctor' => [
                    'crm' => '22222-SP',
                    'specialty' => 'Psicologia',
                    'phone' => '(11) 88888-8888',
                    'bio' => 'Psicóloga especializada em transtornos alimentares e comportamento. Apoio emocional para mudanças de estilo de vida.',
                    'is_active' => true,
                ]
            ]
        ];

        foreach ($doctors as $doctorData) {
            $user = User::create($doctorData['user']);
            Doctor::create(array_merge($doctorData['doctor'], ['user_id' => $user->id]));
        }

        // Criar pacientes
        $patients = [
            [
                'user' => [
                    'name' => 'Maria Santos',
                    'email' => 'maria.santos@email.com',
                    'password' => Hash::make('password'),
                    'role' => 'patient',
                    'email_verified_at' => now(),
                ],
                'patient' => [
                    'cpf' => '123.456.789-00',
                    'birth_date' => '1985-05-15',
                    'phone' => '(11) 99999-1111',
                    'address' => 'Rua das Flores, 123 - Vila Madalena, São Paulo, SP',
                    'emergency_contact' => 'João Santos',
                    'emergency_phone' => '(11) 99999-1112',
                    'allergies' => 'Penicilina, Amoxicilina',
                    'medical_history' => 'Hipertensão controlada com Losartana 50mg. Histórico familiar de diabetes tipo 2.',
                ]
            ],
            [
                'user' => [
                    'name' => 'Carlos Oliveira',
                    'email' => 'carlos.oliveira@email.com',
                    'password' => Hash::make('password'),
                    'role' => 'patient',
                    'email_verified_at' => now(),
                ],
                'patient' => [
                    'cpf' => '987.654.321-00',
                    'birth_date' => '1990-08-22',
                    'phone' => '(11) 88888-2222',
                    'address' => 'Av. Paulista, 456 - Bela Vista, São Paulo, SP',
                    'emergency_contact' => 'Sofia Oliveira',
                    'emergency_phone' => '(11) 88888-2223',
                    'allergies' => 'Nenhuma alergia conhecida',
                    'medical_history' => 'Diabetes tipo 2 diagnosticado em 2020. Uso de Metformina 850mg 2x ao dia.',
                ]
            ],
            [
                'user' => [
                    'name' => 'Ana Beatriz Silva',
                    'email' => 'ana.beatriz@email.com',
                    'password' => Hash::make('password'),
                    'role' => 'patient',
                    'email_verified_at' => now(),
                ],
                'patient' => [
                    'cpf' => '456.789.123-00',
                    'birth_date' => '1992-03-10',
                    'phone' => '(11) 77777-3333',
                    'address' => 'Rua Augusta, 789 - Consolação, São Paulo, SP',
                    'emergency_contact' => 'Roberto Silva',
                    'emergency_phone' => '(11) 77777-3334',
                    'allergies' => 'Diclofenaco',
                    'medical_history' => 'Síndrome do ovário policístico. Uso de anticoncepcional e Spironolactona.',
                ]
            ],
            [
                'user' => [
                    'name' => 'João Pedro Ferreira',
                    'email' => 'joao.pedro@email.com',
                    'password' => Hash::make('password'),
                    'role' => 'patient',
                    'email_verified_at' => now(),
                ],
                'patient' => [
                    'cpf' => '789.123.456-00',
                    'birth_date' => '1988-12-05',
                    'phone' => '(11) 66666-4444',
                    'address' => 'Rua Oscar Freire, 321 - Jardins, São Paulo, SP',
                    'emergency_contact' => 'Maria Ferreira',
                    'emergency_phone' => '(11) 66666-4445',
                    'allergies' => 'Ibuprofeno',
                    'medical_history' => 'Apneia do sono leve. Uso de CPAP durante a noite.',
                ]
            ],
            [
                'user' => [
                    'name' => 'Fernanda Lima',
                    'email' => 'fernanda.lima@email.com',
                    'password' => Hash::make('password'),
                    'role' => 'patient',
                    'email_verified_at' => now(),
                ],
                'patient' => [
                    'cpf' => '321.654.987-00',
                    'birth_date' => '1995-07-18',
                    'phone' => '(11) 55555-5555',
                    'address' => 'Av. Faria Lima, 1000 - Itaim Bibi, São Paulo, SP',
                    'emergency_contact' => 'Carlos Lima',
                    'emergency_phone' => '(11) 55555-5556',
                    'allergies' => 'Nenhuma alergia conhecida',
                    'medical_history' => 'Hipotireoidismo. Uso de Levotiroxina 75mcg em jejum.',
                ]
            ],
            [
                'user' => [
                    'name' => 'Roberto Almeida',
                    'email' => 'roberto.almeida@email.com',
                    'password' => Hash::make('password'),
                    'role' => 'patient',
                    'email_verified_at' => now(),
                ],
                'patient' => [
                    'cpf' => '654.321.789-00',
                    'birth_date' => '1983-11-25',
                    'phone' => '(11) 44444-6666',
                    'address' => 'Rua Haddock Lobo, 500 - Cerqueira César, São Paulo, SP',
                    'emergency_contact' => 'Patricia Almeida',
                    'emergency_phone' => '(11) 44444-6667',
                    'allergies' => 'Sulfa',
                    'medical_history' => 'Hipertensão e colesterol alto. Uso de Enalapril 10mg e Sinvastatina 20mg.',
                ]
            ],
            [
                'user' => [
                    'name' => 'Juliana Martins',
                    'email' => 'juliana.martins@email.com',
                    'password' => Hash::make('password'),
                    'role' => 'patient',
                    'email_verified_at' => now(),
                ],
                'patient' => [
                    'cpf' => '147.258.369-00',
                    'birth_date' => '1991-09-14',
                    'phone' => '(11) 33333-7777',
                    'address' => 'Rua Bela Cintra, 200 - Jardins, São Paulo, SP',
                    'emergency_contact' => 'Marcos Martins',
                    'emergency_phone' => '(11) 33333-7778',
                    'allergies' => 'Nenhuma alergia conhecida',
                    'medical_history' => 'Ansiedade leve. Uso de Sertralina 50mg e acompanhamento psicológico.',
                ]
            ],
            [
                'user' => [
                    'name' => 'Lucas Pereira',
                    'email' => 'lucas.pereira@email.com',
                    'password' => Hash::make('password'),
                    'role' => 'patient',
                    'email_verified_at' => now(),
                ],
                'patient' => [
                    'cpf' => '258.369.147-00',
                    'birth_date' => '1987-04-30',
                    'phone' => '(11) 22222-8888',
                    'address' => 'Av. Rebouças, 1500 - Pinheiros, São Paulo, SP',
                    'emergency_contact' => 'Camila Pereira',
                    'emergency_phone' => '(11) 22222-8889',
                    'allergies' => 'Dipirona',
                    'medical_history' => 'Gastrite crônica. Uso de Omeprazol 40mg e dieta restritiva.',
                ]
            ],
            [
                'user' => [
                    'name' => 'Patricia Souza',
                    'email' => 'patricia.souza@email.com',
                    'password' => Hash::make('password'),
                    'role' => 'patient',
                    'email_verified_at' => now(),
                ],
                'patient' => [
                    'cpf' => '369.147.258-00',
                    'birth_date' => '1993-01-08',
                    'phone' => '(11) 11111-9999',
                    'address' => 'Rua Estados Unidos, 800 - Jardim América, São Paulo, SP',
                    'emergency_contact' => 'Antonio Souza',
                    'emergency_phone' => '(11) 11111-9990',
                    'allergies' => 'Nenhuma alergia conhecida',
                    'medical_history' => 'Saudável. Busca por orientação nutricional e estilo de vida saudável.',
                ]
            ],
            [
                'user' => [
                    'name' => 'Marcos Santos',
                    'email' => 'marcos.santos@email.com',
                    'password' => Hash::make('password'),
                    'role' => 'patient',
                    'email_verified_at' => now(),
                ],
                'patient' => [
                    'cpf' => '741.852.963-00',
                    'birth_date' => '1980-06-20',
                    'phone' => '(11) 99999-0000',
                    'address' => 'Av. Brigadeiro Luiz Antonio, 300 - Bela Vista, São Paulo, SP',
                    'emergency_contact' => 'Lucia Santos',
                    'emergency_phone' => '(11) 99999-0001',
                    'allergies' => 'Aspirina',
                    'medical_history' => 'Diabetes tipo 2 e hipertensão. Uso de Metformina 1000mg, Losartana 50mg e Glibenclamida 5mg.',
                ]
            ]
        ];

        foreach ($patients as $patientData) {
            $user = User::create($patientData['user']);
            Patient::create(array_merge($patientData['patient'], ['user_id' => $user->id]));
        }

        $this->command->info('Seeds criadas com sucesso!');
        $this->command->info('Médicos criados: ' . count($doctors));
        $this->command->info('Pacientes criados: ' . count($patients));
        $this->command->info('Total de usuários: ' . (count($doctors) + count($patients)));
    }
}
