<x-app-layout>
    <div class="p-6">
        <div class="max-w-7xl mx-auto">
            @if(auth()->user()->isPatient())
                <!-- Patient Dashboard -->
                
                <!-- Important Notice -->
                <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                <strong>Importante:</strong> Adicione sua primeira foto de evolução para liberar todas as funcionalidades do sistema.
                                <a href="#" class="font-medium underline text-yellow-700 hover:text-yellow-600">Vá para "Evolução" → "Fotos de Evolução" para começar.</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Patient Info -->
                <div class="mb-8 bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="h-16 w-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-xl font-bold text-white">MS</span>
                        </div>
                        <div class="ml-6">
                            <h1 class="text-2xl font-bold text-gray-900">Maria Silva</h1>
                            <p class="text-lg text-gray-600">32 anos</p>
                            <p class="text-sm text-blue-600 font-medium">Próxima consulta: 15/01/2025</p>
                        </div>
                    </div>
                </div>

                <!-- Weight Goal Card -->
                <div class="mb-8 bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Meta de Peso</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="bg-blue-50 rounded-lg p-4">
                                <p class="text-sm text-gray-600 mb-2">Peso Atual</p>
                                <p class="text-3xl font-bold text-blue-600">74 kg</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="bg-green-50 rounded-lg p-4">
                                <p class="text-sm text-gray-600 mb-2">Meta</p>
                                <p class="text-3xl font-bold text-green-600">65 kg</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <div class="text-center">
                            <p class="text-sm text-gray-600">Perdidos</p>
                            <p class="text-xl font-bold text-green-600">11 kg</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-gray-600">Faltam</p>
                            <p class="text-xl font-bold text-orange-600">9 kg</p>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Weight Lost -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Peso Perdido</p>
                                <p class="text-2xl font-semibold text-gray-900">11 kg</p>
                            </div>
                        </div>
                    </div>

                    <!-- Current BMI -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">IMC Atual</p>
                                <p class="text-2xl font-semibold text-gray-900">24.8</p>
                            </div>
                        </div>
                    </div>

                    <!-- Medications -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Medicações Hoje</p>
                                <p class="text-2xl font-semibold text-gray-900">1/3</p>
                            </div>
                        </div>
                    </div>

                    <!-- Progress -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Progresso</p>
                                <p class="text-2xl font-semibold text-gray-900">55%</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Weight Evolution Chart -->
                <div class="mb-8 bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Evolução do Peso</h2>
                    <div class="h-64 flex items-end justify-between">
                        <div class="flex flex-col items-center">
                            <div class="w-8 bg-blue-500 rounded-t" style="height: 60px;"></div>
                            <span class="text-xs text-gray-600 mt-2">Jan</span>
                            <span class="text-xs text-gray-500">72kg</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-8 bg-blue-500 rounded-t" style="height: 80px;"></div>
                            <span class="text-xs text-gray-600 mt-2">Fev</span>
                            <span class="text-xs text-gray-500">76kg</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-8 bg-blue-500 rounded-t" style="height: 100px;"></div>
                            <span class="text-xs text-gray-600 mt-2">Mar</span>
                            <span class="text-xs text-gray-500">80kg</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-8 bg-blue-500 rounded-t" style="height: 120px;"></div>
                            <span class="text-xs text-gray-600 mt-2">Abr</span>
                            <span class="text-xs text-gray-500">84kg</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-8 bg-blue-500 rounded-t" style="height: 130px;"></div>
                            <span class="text-xs text-gray-600 mt-2">Mai</span>
                            <span class="text-xs text-gray-500">87kg</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-8 bg-green-500 rounded-t" style="height: 90px;"></div>
                            <span class="text-xs text-gray-600 mt-2">Jun</span>
                            <span class="text-xs text-gray-500">74kg</span>
                        </div>
                    </div>
                </div>

                <!-- Today's Medications -->
                <div class="mb-8 bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Medicações de Hoje</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                <div>
                                    <p class="font-medium text-gray-900">Metformina</p>
                                    <p class="text-sm text-gray-600">08:00</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">Tomado</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-orange-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-orange-500 rounded-full mr-3"></div>
                                <div>
                                    <p class="font-medium text-gray-900">Omega 3</p>
                                    <p class="text-sm text-gray-600">12:00</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-orange-100 text-orange-800 text-sm font-medium rounded-full">Pendente</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-orange-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-orange-500 rounded-full mr-3"></div>
                                <div>
                                    <p class="font-medium text-gray-900">Vitamina D</p>
                                    <p class="text-sm text-gray-600">18:00</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-orange-100 text-orange-800 text-sm font-medium rounded-full">Pendente</span>
                        </div>
                    </div>
                </div>

                <!-- Daily Reminders -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Lembretes do Dia</h2>
                    <div class="space-y-3">
                        <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                            <svg class="h-5 w-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-gray-700">Beber pelo menos 2L de água</p>
                        </div>
                        <div class="flex items-center p-3 bg-green-50 rounded-lg">
                            <svg class="h-5 w-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-gray-700">Fazer caminhada de 30 minutos</p>
                        </div>
                        <div class="flex items-center p-3 bg-orange-50 rounded-lg">
                            <svg class="h-5 w-5 text-orange-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-gray-700">Tomar medicação às 12:00</p>
                        </div>
                    </div>
                </div>
            @else
                <!-- Doctor Dashboard -->
                
                <!-- Welcome Header -->
                <div class="mb-8">
                    <div class="bg-gradient-to-r from-blue-600 to-cyan-600 rounded-lg p-6 text-white">
                        <h1 class="text-2xl font-bold mb-2">
                            Bem-vindo, {{ auth()->user()->name }}!
                        </h1>
                        <p class="text-blue-100">
                            Gerencie seus pacientes e consultas de forma eficiente.
                        </p>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Patients -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Pacientes Ativos</p>
                                <p class="text-2xl font-semibold text-gray-900">24</p>
                            </div>
                        </div>
                    </div>

                    <!-- Today's Appointments -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Consultas Hoje</p>
                                <p class="text-2xl font-semibold text-gray-900">8</p>
                            </div>
                        </div>
                    </div>

                    <!-- Next Appointment -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Próxima Consulta</p>
                                <p class="text-2xl font-semibold text-gray-900">14:30</p>
                            </div>
                        </div>
                    </div>

                    <!-- Reviews -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Avaliações</p>
                                <p class="text-2xl font-semibold text-gray-900">4.8</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today's Schedule -->
                <div class="mb-8 bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Agenda de Hoje</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-blue-600">09:00</span>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium text-gray-900">Maria Silva</p>
                                    <p class="text-sm text-gray-600">Consulta de rotina</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">Concluída</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-orange-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-orange-600">10:30</span>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium text-gray-900">João Santos</p>
                                    <p class="text-sm text-gray-600">Retorno</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-orange-100 text-orange-800 text-sm font-medium rounded-full">Em andamento</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-gray-600">14:30</span>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium text-gray-900">Ana Costa</p>
                                    <p class="text-sm text-gray-600">Primeira consulta</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">Pendente</span>
                        </div>
                    </div>
                </div>

                <!-- Patient Overview -->
                <div class="mb-8 bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Visão Geral dos Pacientes</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Weight Loss Progress -->
                        <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg p-4">
                            <h3 class="font-semibold text-green-800 mb-3">Progresso de Perda de Peso</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-green-700">Meta atingida</span>
                                    <span class="font-medium text-green-800">12 pacientes</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-green-700">Em progresso</span>
                                    <span class="font-medium text-green-800">8 pacientes</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-green-700">Iniciando</span>
                                    <span class="font-medium text-green-800">4 pacientes</span>
                                </div>
                            </div>
                        </div>

                        <!-- Medication Compliance -->
                        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg p-4">
                            <h3 class="font-semibold text-blue-800 mb-3">Adesão às Medicações</h3>
                            <div class="space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-blue-700">Excelente (90%+)</span>
                                    <span class="font-medium text-blue-800">15 pacientes</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-blue-700">Boa (70-89%)</span>
                                    <span class="font-medium text-blue-800">6 pacientes</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-blue-700">Precisa atenção</span>
                                    <span class="font-medium text-blue-800">3 pacientes</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Patients -->
                <div class="mb-8 bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Pacientes Recentes</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-blue-600">MS</span>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium text-gray-900">Maria Silva</p>
                                    <p class="text-sm text-gray-600">Última consulta: 15/10/2024</p>
                                    <p class="text-xs text-green-600">Perdeu 5kg este mês</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Ativo
                                </span>
                                <p class="text-xs text-gray-500 mt-1">Próxima: 25/10</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="h-12 w-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-green-600">JS</span>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium text-gray-900">João Santos</p>
                                    <p class="text-sm text-gray-600">Última consulta: 12/10/2024</p>
                                    <p class="text-xs text-blue-600">IMC melhorou 2 pontos</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Ativo
                                </span>
                                <p class="text-xs text-gray-500 mt-1">Próxima: 22/10</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="h-12 w-12 bg-purple-100 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-purple-600">AC</span>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium text-gray-900">Ana Costa</p>
                                    <p class="text-sm text-gray-600">Primeira consulta: 10/10/2024</p>
                                    <p class="text-xs text-orange-600">Novo paciente</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Novo
                                </span>
                                <p class="text-xs text-gray-500 mt-1">Próxima: 20/10</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Ações Rápidas</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <button class="flex items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                            <svg class="h-6 w-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="font-medium text-blue-800">Nova Consulta</span>
                        </button>
                        <button class="flex items-center justify-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                            <svg class="h-6 w-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="font-medium text-green-800">Novo Paciente</span>
                        </button>
                        <button class="flex items-center justify-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors">
                            <svg class="h-6 w-6 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span class="font-medium text-purple-800">Relatórios</span>
                        </button>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>