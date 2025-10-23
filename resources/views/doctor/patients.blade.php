<x-app-layout>
    <div class="p-4 md:p-6" x-data="patientManager()">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-6 md:mb-8">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-gray-900">Pacientes</h1>
                        <p class="text-sm md:text-base text-gray-600">Gerencie todos os seus pacientes</p>
                    </div>
                    <button @click="openNewPatientModal()" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors text-sm md:text-base">
                        Novo Paciente
                    </button>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="bg-white rounded-lg shadow p-4 md:p-6 mb-4 md:mb-6">
                <div class="space-y-4">
                    <!-- Search Bar -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 md:h-5 md:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" placeholder="Buscar pacientes por nome, email ou telefone..." 
                               class="block w-full pl-8 md:pl-10 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               x-model="searchTerm"
                               @input="filterPatients()">
                    </div>
                    
                    <!-- Filters -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
                            <select class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                                <option>Todos os Status</option>
                                <option>Ativo</option>
                                <option>Inativo</option>
                                <option>Novo</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Progresso</label>
                            <select class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                                <option>Todos os Pacientes</option>
                                <option>Meta Atingida</option>
                                <option>Em Progresso</option>
                                <option>Iniciando</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Patients Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
                <!-- Patient Card 1 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow cursor-pointer" 
                     @click="window.location.href='{{ route('doctor.patient-details', 1) }}'"
                     x-show="isPatientVisible(1, 'Maria Silva', '32 anos')">
                    <div class="p-3 md:p-4 lg:p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 md:w-12 md:h-12 lg:w-16 lg:h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                <span class="text-sm md:text-lg lg:text-xl font-bold text-white">MS</span>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm md:text-base lg:text-lg font-semibold text-gray-900">Maria Silva</h3>
                                <p class="text-xs text-gray-600">32 anos</p>
                            </div>
                        </div>
                        
                        <div class="space-y-1 mb-3">
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Peso:</span>
                                <span class="font-medium">74 kg</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Meta:</span>
                                <span class="font-medium">65 kg</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Perdido:</span>
                                <span class="font-medium text-green-600">11 kg</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Faltam:</span>
                                <span class="font-medium text-orange-600">9 kg</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Ativo
                            </span>
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-gray-500">25/10</span>
                                <div class="flex space-x-1">
                                    <button @click.stop="openEditPatientModal(1)" title="Editar paciente" class="p-1 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded">
                                        <svg class="h-3 w-3 md:h-4 md:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button @click.stop="openDeletePatientModal(1, 'Maria Silva')" title="Excluir paciente" class="p-1 text-red-600 hover:text-red-800 hover:bg-red-50 rounded">
                                        <svg class="h-3 w-3 md:h-4 md:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Patient Card 2 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow cursor-pointer" 
                     @click="window.location.href='{{ route('doctor.patient-details', 2) }}'"
                     x-show="isPatientVisible(2, 'João Santos', '28 anos')">
                    <div class="p-3 md:p-4 lg:p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 md:w-12 md:h-12 lg:w-16 lg:h-16 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center">
                                <span class="text-sm md:text-lg lg:text-xl font-bold text-white">JS</span>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm md:text-base lg:text-lg font-semibold text-gray-900">João Santos</h3>
                                <p class="text-xs text-gray-600">28 anos</p>
                            </div>
                        </div>
                        
                        <div class="space-y-1 mb-3">
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Peso:</span>
                                <span class="font-medium">82 kg</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Meta:</span>
                                <span class="font-medium">75 kg</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Perdido:</span>
                                <span class="font-medium text-green-600">8 kg</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Faltam:</span>
                                <span class="font-medium text-orange-600">7 kg</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Ativo
                            </span>
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-gray-500">22/10</span>
                                <div class="flex space-x-1">
                                    <button @click.stop="openEditPatientModal(1)" title="Editar paciente" class="p-1 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded">
                                        <svg class="h-3 w-3 md:h-4 md:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button @click.stop="openDeletePatientModal(1, 'Maria Silva')" title="Excluir paciente" class="p-1 text-red-600 hover:text-red-800 hover:bg-red-50 rounded">
                                        <svg class="h-3 w-3 md:h-4 md:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Patient Card 3 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow cursor-pointer" 
                     @click="window.location.href='{{ route('doctor.patient-details', 3) }}'"
                     x-show="isPatientVisible(3, 'Ana Costa', '35 anos')">
                    <div class="p-3 md:p-4 lg:p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 md:w-12 md:h-12 lg:w-16 lg:h-16 bg-gradient-to-r from-purple-500 to-pink-600 rounded-full flex items-center justify-center">
                                <span class="text-sm md:text-lg lg:text-xl font-bold text-white">AC</span>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm md:text-base lg:text-lg font-semibold text-gray-900">Ana Costa</h3>
                                <p class="text-xs text-gray-600">35 anos</p>
                            </div>
                        </div>
                        
                        <div class="space-y-1 mb-3">
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Peso:</span>
                                <span class="font-medium">68 kg</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Meta:</span>
                                <span class="font-medium">60 kg</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Perdido:</span>
                                <span class="font-medium text-green-600">3 kg</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Faltam:</span>
                                <span class="font-medium text-orange-600">8 kg</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Novo
                            </span>
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-gray-500">20/10</span>
                                <div class="flex space-x-1">
                                    <button @click.stop="openEditPatientModal(1)" title="Editar paciente" class="p-1 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded">
                                        <svg class="h-3 w-3 md:h-4 md:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button @click.stop="openDeletePatientModal(1, 'Maria Silva')" title="Excluir paciente" class="p-1 text-red-600 hover:text-red-800 hover:bg-red-50 rounded">
                                        <svg class="h-3 w-3 md:h-4 md:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Patient Card 4 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow cursor-pointer" 
                     @click="window.location.href='{{ route('doctor.patient-details', 4) }}'"
                     x-show="isPatientVisible(4, 'Pedro Ferreira', '41 anos')">
                    <div class="p-3 md:p-4 lg:p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 md:w-12 md:h-12 lg:w-16 lg:h-16 bg-gradient-to-r from-orange-500 to-red-600 rounded-full flex items-center justify-center">
                                <span class="text-sm md:text-lg lg:text-xl font-bold text-white">PF</span>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm md:text-base lg:text-lg font-semibold text-gray-900">Pedro Ferreira</h3>
                                <p class="text-xs text-gray-600">41 anos</p>
                            </div>
                        </div>
                        
                        <div class="space-y-1 mb-3">
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Peso:</span>
                                <span class="font-medium">95 kg</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Meta:</span>
                                <span class="font-medium">85 kg</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Perdido:</span>
                                <span class="font-medium text-green-600">15 kg</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Faltam:</span>
                                <span class="font-medium text-orange-600">10 kg</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Meta Atingida
                            </span>
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-gray-500">28/10</span>
                                <div class="flex space-x-1">
                                    <button @click.stop="openEditPatientModal(1)" title="Editar paciente" class="p-1 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded">
                                        <svg class="h-3 w-3 md:h-4 md:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button @click.stop="openDeletePatientModal(1, 'Maria Silva')" title="Excluir paciente" class="p-1 text-red-600 hover:text-red-800 hover:bg-red-50 rounded">
                                        <svg class="h-3 w-3 md:h-4 md:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Patient Card 5 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow cursor-pointer" 
                     @click="window.location.href='{{ route('doctor.patient-details', 5) }}'"
                     x-show="isPatientVisible(5, 'Lucas Rodrigues', '29 anos')">
                    <div class="p-3 md:p-4 lg:p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 md:w-12 md:h-12 lg:w-16 lg:h-16 bg-gradient-to-r from-teal-500 to-cyan-600 rounded-full flex items-center justify-center">
                                <span class="text-sm md:text-lg lg:text-xl font-bold text-white">LR</span>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm md:text-base lg:text-lg font-semibold text-gray-900">Lucas Rodrigues</h3>
                                <p class="text-xs text-gray-600">29 anos</p>
                            </div>
                        </div>
                        
                        <div class="space-y-1 mb-3">
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Peso:</span>
                                <span class="font-medium">78 kg</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Meta:</span>
                                <span class="font-medium">70 kg</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Perdido:</span>
                                <span class="font-medium text-green-600">6 kg</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Faltam:</span>
                                <span class="font-medium text-orange-600">8 kg</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Em Progresso
                            </span>
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-gray-500">30/10</span>
                                <div class="flex space-x-1">
                                    <button @click.stop="openEditPatientModal(1)" title="Editar paciente" class="p-1 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded">
                                        <svg class="h-3 w-3 md:h-4 md:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button @click.stop="openDeletePatientModal(1, 'Maria Silva')" title="Excluir paciente" class="p-1 text-red-600 hover:text-red-800 hover:bg-red-50 rounded">
                                        <svg class="h-3 w-3 md:h-4 md:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Patient Card 6 -->
                <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow cursor-pointer" 
                     @click="window.location.href='{{ route('doctor.patient-details', 6) }}'"
                     x-show="isPatientVisible(6, 'Carla Mendes', '37 anos')">
                    <div class="p-3 md:p-4 lg:p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 md:w-12 md:h-12 lg:w-16 lg:h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                                <span class="text-sm md:text-lg lg:text-xl font-bold text-white">CM</span>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm md:text-base lg:text-lg font-semibold text-gray-900">Carla Mendes</h3>
                                <p class="text-xs text-gray-600">37 anos</p>
                            </div>
                        </div>
                        
                        <div class="space-y-1 mb-3">
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Peso:</span>
                                <span class="font-medium">71 kg</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Meta:</span>
                                <span class="font-medium">65 kg</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Perdido:</span>
                                <span class="font-medium text-green-600">4 kg</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-gray-600">Faltam:</span>
                                <span class="font-medium text-orange-600">6 kg</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Ativo
                            </span>
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-gray-500">26/10</span>
                                <div class="flex space-x-1">
                                    <button @click.stop="openEditPatientModal(1)" title="Editar paciente" class="p-1 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded">
                                        <svg class="h-3 w-3 md:h-4 md:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>
                                    <button @click.stop="openDeletePatientModal(1, 'Maria Silva')" title="Excluir paciente" class="p-1 text-red-600 hover:text-red-800 hover:bg-red-50 rounded">
                                        <svg class="h-3 w-3 md:h-4 md:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination - Only show if more than 1 page -->
            <div id="pagination-container" class="mt-8 items-center justify-between hidden">
                <div class="text-sm text-gray-700">
                    Mostrando <span class="font-medium" id="showing-start">1</span> a 
                    <span class="font-medium" id="showing-end">6</span> de 
                    <span class="font-medium" id="total-patients">6</span> pacientes
                </div>
                
                <div class="flex items-center space-x-1">
                    <button id="prev-btn" onclick="changePage(currentPage - 1)" 
                            class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    
                    <div id="page-numbers" class="flex">
                        <!-- Pages will be generated by JavaScript -->
                    </div>
                    
                    <button id="next-btn" onclick="changePage(currentPage + 1)" 
                            class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Novo Paciente -->
    <div x-show="showNewPatientModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50"
         @click.self="closeNewPatientModal()">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <!-- Header -->
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base md:text-lg font-medium text-gray-900">Novo Paciente</h3>
                    <button @click="closeNewPatientModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5 md:h-6 md:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Form -->
                <form class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Nome Completo *</label>
                            <input type="text" placeholder="Digite o nome completo do paciente" required class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Email *</label>
                            <input type="email" placeholder="exemplo@email.com" required class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Telefone</label>
                            <input type="tel" placeholder="(11) 99999-9999" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Data de Nascimento *</label>
                            <input type="date" required class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">CPF *</label>
                            <input type="text" placeholder="000.000.000-00" required class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Altura (cm)</label>
                            <input type="number" placeholder="170" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Peso Atual (kg)</label>
                            <input type="number" step="0.1" placeholder="75.5" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Meta de Peso (kg)</label>
                            <input type="number" step="0.1" placeholder="65.0" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Endereço</label>
                        <input type="text" placeholder="Rua, número, bairro, cidade - UF" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Contato de Emergência</label>
                            <input type="text" placeholder="Nome do contato de emergência" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Telefone de Emergência</label>
                            <input type="tel" placeholder="(11) 88888-8888" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Alergias</label>
                        <textarea rows="2" placeholder="Descreva as alergias conhecidas ou deixe em branco se não houver" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Histórico Médico</label>
                        <textarea rows="3" placeholder="Descreva o histórico médico do paciente, condições pré-existentes, medicações em uso, etc." class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-4 pt-4">
                        <button type="button" @click="closeNewPatientModal()" class="w-full sm:w-auto px-4 py-2 text-xs md:text-sm border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Cancelar
                        </button>
                        <button type="submit" @click="handleNewPatientSubmit($event)" class="w-full sm:w-auto px-4 py-2 text-xs md:text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Criar Paciente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar Paciente -->
    <div x-show="showEditPatientModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50"
         @click.self="closeEditPatientModal()">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <!-- Header -->
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base md:text-lg font-medium text-gray-900">Editar Paciente</h3>
                    <button @click="closeEditPatientModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5 md:h-6 md:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Form -->
                <form class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Nome Completo *</label>
                            <input type="text" value="Maria Silva" required class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Email *</label>
                            <input type="email" value="maria.silva@email.com" required class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Telefone</label>
                            <input type="tel" value="(11) 99999-9999" placeholder="(11) 99999-9999" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Data de Nascimento *</label>
                            <input type="date" value="1992-05-15" required class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">CPF *</label>
                            <input type="text" value="123.456.789-00" required class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Altura (cm)</label>
                            <input type="number" value="165" placeholder="165" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Peso Atual (kg)</label>
                            <input type="number" value="74" step="0.1" placeholder="74.0" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Meta de Peso (kg)</label>
                            <input type="number" value="65" step="0.1" placeholder="65.0" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Endereço</label>
                        <input type="text" value="Rua das Flores, 123 - São Paulo/SP" placeholder="Rua, número, bairro, cidade - UF" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Contato de Emergência</label>
                            <input type="text" value="João Silva" placeholder="Nome do contato de emergência" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Telefone de Emergência</label>
                            <input type="tel" value="(11) 88888-8888" placeholder="(11) 88888-8888" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Alergias</label>
                        <textarea rows="2" placeholder="Descreva as alergias conhecidas ou deixe em branco se não houver" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">Nenhuma alergia conhecida</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Histórico Médico</label>
                        <textarea rows="3" placeholder="Descreva o histórico médico do paciente, condições pré-existentes, medicações em uso, etc." class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">Paciente em tratamento para perda de peso. Sem histórico de doenças crônicas.</textarea>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-4 pt-4">
                        <button type="button" @click="closeEditPatientModal()" class="w-full sm:w-auto px-4 py-2 text-xs md:text-sm border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Cancelar
                        </button>
                        <button type="submit" @click="handleEditPatientSubmit($event)" class="w-full sm:w-auto px-4 py-2 text-xs md:text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Confirmar Exclusão -->
    <div x-show="showDeletePatientModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50"
         @click.self="closeDeletePatientModal()">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/3 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="mx-auto flex items-center justify-center h-10 w-10 md:h-12 md:w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-5 w-5 md:h-6 md:w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div class="text-center">
                    <h3 class="text-base md:text-lg font-medium text-gray-900 mb-2">Confirmar Exclusão</h3>
                    <p class="text-xs md:text-sm text-gray-500 mb-6" x-text="deleteMessage">
                        Tem certeza que deseja excluir este paciente? Esta ação não pode ser desfeita.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-4">
                        <button @click="closeDeletePatientModal()" class="w-full sm:w-auto px-4 py-2 text-xs md:text-sm border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Cancelar
                        </button>
                        <button @click="confirmDeletePatient()" class="w-full sm:w-auto px-4 py-2 text-xs md:text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Excluir
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/patient-manager.js') }}"></script>
    @endpush
</x-app-layout>
