<x-app-layout>
    <div class="p-4 md:p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-6 md:mb-8">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-xl md:text-2xl font-bold text-gray-900">Perfil do Paciente</h1>
                        <p class="text-sm md:text-base text-gray-600">Gerencie suas informações pessoais e histórico médico</p>
                    </div>
                    <button class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors text-sm md:text-base">
                        Editar
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Left Column - Patient Photo and Basic Info -->
                <div class="lg:col-span-1">
                    <!-- Patient Photo -->
                    <div class="bg-white rounded-lg shadow p-4 md:p-6 mb-4 md:mb-6">
                        <h2 class="text-sm md:text-base font-semibold text-gray-900 mb-3 md:mb-4">Foto do Paciente</h2>
                        <div class="text-center">
                            <div class="w-20 h-20 md:w-24 md:h-24 lg:w-32 lg:h-32 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-3 md:mb-4">
                                <span class="text-lg md:text-2xl lg:text-4xl font-bold text-white">MS</span>
                            </div>
                            <button class="text-blue-600 hover:text-blue-700 font-medium text-xs md:text-sm">
                                Alterar Foto
                            </button>
                        </div>
                    </div>

                    <!-- Basic Information -->
                    <div class="bg-white rounded-lg shadow p-4 md:p-6">
                        <h2 class="text-sm md:text-base font-semibold text-gray-900 mb-3 md:mb-4">Informações Básicas</h2>
                        <div class="space-y-3 md:space-y-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Nome</label>
                                <p class="text-xs md:text-sm text-gray-900 font-medium">Maria Silva</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Idade</label>
                                <p class="text-xs md:text-sm text-gray-900">32 anos</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Peso Atual</label>
                                <p class="text-xs md:text-sm text-gray-900">74 kg</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Altura</label>
                                <p class="text-xs md:text-sm text-gray-900">165 cm</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Meta de Peso</label>
                                <p class="text-xs md:text-sm text-gray-900">65 kg</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Tabs -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow">
                        <!-- Tab Navigation -->
                        <div class="border-b border-gray-200">
                            <nav class="-mb-px flex flex-wrap space-x-2 md:space-x-8 px-4 md:px-6" aria-label="Tabs">
                                <button class="border-blue-500 text-blue-600 whitespace-nowrap py-2 md:py-3 px-1 border-b-2 font-medium text-xs">
                                    Dados Pessoais
                                </button>
                                <button class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 md:py-3 px-1 border-b-2 font-medium text-xs">
                                    Histórico Clínico
                                </button>
                                <button class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 md:py-3 px-1 border-b-2 font-medium text-xs">
                                    Fotos de Evolução
                                </button>
                            </nav>
                        </div>

                        <!-- Tab Content -->
                        <div class="p-4 md:p-6">
                            <!-- Dados Pessoais Tab -->
                            <div id="personal-data" class="space-y-4 md:space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Nome Completo</label>
                                        <input type="text" placeholder="Digite o nome completo" value="Maria Silva" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Email</label>
                                        <input type="email" placeholder="exemplo@email.com" value="maria.silva@email.com" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Telefone</label>
                                        <input type="tel" placeholder="(11) 99999-9999" value="(11) 99999-9999" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Data de Nascimento</label>
                                        <input type="date" value="1992-05-15" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">CPF</label>
                                        <input type="text" placeholder="000.000.000-00" value="123.456.789-00" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Endereço</label>
                                        <input type="text" placeholder="Rua, número, bairro, cidade - UF" value="Rua das Flores, 123 - São Paulo/SP" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Contato de Emergência</label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Nome</label>
                                            <input type="text" placeholder="Nome do contato de emergência" value="João Silva" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Telefone</label>
                                            <input type="tel" placeholder="(11) 88888-8888" value="(11) 88888-8888" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-4">
                                    <button class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors text-xs md:text-sm">
                                        Cancelar
                                    </button>
                                    <button class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-xs md:text-sm">
                                        Salvar Alterações
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
