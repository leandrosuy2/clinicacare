<x-app-layout>
    <div class="p-6" x-data="{
        // Estado dos modais - TODOS FECHADOS POR PADRÃO
        showEditPatientModal: false,
        showNewConsultationModal: false,
        showPhotoUploadModal: false,
        
        // Estado das abas
        activeTab: 'personal-data',
        
        // Estado do upload de foto
        photoType: 'profile',
        photoFile: null,
        photoDescription: '',
        photoWeight: '',
        photoDate: new Date().toISOString().split('T')[0],
        
        // Estado do agendamento
        appointmentDate: '',
        appointmentTime: '',
        appointmentType: 'consultation',
        appointmentNotes: '',
        
        // ID do paciente
        patientId: {{ $patientId ?? 1 }},
        
        // Funções das abas
        showTab(tabName) {
            this.activeTab = tabName;
        },
        
        // Funções dos modais
        openEditPatientModal() {
            console.log('Abrindo modal de edição');
            this.showEditPatientModal = true;
            document.body.style.overflow = 'hidden';
        },
        
        closeEditPatientModal() {
            console.log('Fechando modal de edição');
            this.showEditPatientModal = false;
            document.body.style.overflow = 'auto';
        },
        
        openNewConsultationModal() {
            console.log('Abrindo modal de consulta');
            this.showNewConsultationModal = true;
            document.body.style.overflow = 'hidden';
            
            // Definir data e hora padrão
            const now = new Date();
            this.appointmentDate = now.toISOString().split('T')[0];
            this.appointmentTime = '09:00';
        },
        
        closeNewConsultationModal() {
            console.log('Fechando modal de consulta');
            this.showNewConsultationModal = false;
            document.body.style.overflow = 'auto';
            this.resetAppointmentForm();
        },
        
        openPhotoUploadModal(type) {
            console.log('Abrindo modal de foto:', type);
            this.photoType = type;
            this.showPhotoUploadModal = true;
            document.body.style.overflow = 'hidden';
            
            // Resetar formulário
            this.photoFile = null;
            this.photoDescription = '';
            this.photoWeight = '';
            this.photoDate = new Date().toISOString().split('T')[0];
        },
        
        closePhotoUploadModal() {
            console.log('Fechando modal de foto');
            this.showPhotoUploadModal = false;
            document.body.style.overflow = 'auto';
            this.resetPhotoForm();
        },
        
        // Funções de formulário
        resetAppointmentForm() {
            this.appointmentDate = '';
            this.appointmentTime = '';
            this.appointmentType = 'consultation';
            this.appointmentNotes = '';
        },
        
        resetPhotoForm() {
            this.photoFile = null;
            this.photoDescription = '';
            this.photoWeight = '';
            this.photoDate = new Date().toISOString().split('T')[0];
        },
        
        // Upload de foto
        handlePhotoUpload() {
            if (!this.photoFile) {
                this.showNotification('Selecione uma foto para enviar', 'error');
                return;
            }
            
            const formData = new FormData();
            formData.append('photo', this.photoFile);
            formData.append('patient_id', this.patientId);
            formData.append('photo_type', this.photoType);
            formData.append('description', this.photoDescription);
            formData.append('weight', this.photoWeight);
            formData.append('photo_date', this.photoDate);
            
            // Enviar para o backend
            fetch('{{ route("photos.upload") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.showNotification(data.message, 'success');
                    this.closePhotoUploadModal();
                    // Recarregar a página para mostrar a nova foto
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    this.showNotification(data.error || 'Erro ao enviar foto', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.showNotification('Erro ao enviar foto', 'error');
            });
        },
        
        // Agendamento de consulta
        handleAppointmentSubmit() {
            if (!this.appointmentDate || !this.appointmentTime) {
                this.showNotification('Preencha a data e hora da consulta', 'error');
                return;
            }
            
            const appointmentDateTime = `${this.appointmentDate} ${this.appointmentTime}:00`;
            
            const data = {
                patient_id: this.patientId,
                appointment_date: appointmentDateTime,
                type: this.appointmentType,
                notes: this.appointmentNotes
            };
            
            fetch('{{ route("appointments.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.showNotification(data.message, 'success');
                    this.closeNewConsultationModal();
                    // Recarregar a página para mostrar o novo agendamento
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    this.showNotification(data.error || 'Erro ao agendar consulta', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.showNotification('Erro ao agendar consulta', 'error');
            });
        },
        
        // Sistema de notificações
        showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white text-sm font-medium transform transition-all duration-300 translate-x-full`;
            
            if (type === 'success') {
                notification.classList.add('bg-green-500');
            } else if (type === 'error') {
                notification.classList.add('bg-red-500');
            } else {
                notification.classList.add('bg-blue-500');
            }
            
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
    }">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-6 md:mb-8">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center">
                        <button onclick="window.history.back()" class="mr-3 md:mr-4 p-2 text-gray-400 hover:text-gray-600">
                            <svg class="h-5 w-5 md:h-6 md:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <div>
                            <h1 class="text-xl md:text-2xl font-bold text-gray-900">Perfil do Paciente</h1>
                            <p class="text-sm md:text-base text-gray-600">Detalhes completos do paciente</p>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3 w-full sm:w-auto">
                        <button @click="openEditPatientModal()" class="w-full sm:w-auto px-3 md:px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors text-sm md:text-base">
                            Editar
                        </button>
                        <button @click="openNewConsultationModal()" class="w-full sm:w-auto px-3 md:px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm md:text-base">
                            Nova Consulta
                        </button>
                    </div>
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
                            <button @click="openPhotoUploadModal('profile')" class="text-blue-600 hover:text-blue-700 font-medium text-xs md:text-sm">
                                Alterar Foto
                            </button>
                        </div>
                    </div>

                    <!-- Basic Information -->
                    <div class="bg-white rounded-lg shadow p-4 md:p-6">
                        <h2 class="text-sm md:text-base font-semibold text-gray-900 mb-3 md:mb-4">Informações Básicas</h2>
                        <div class="space-y-3 md:space-y-4">
                            <div>
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Nome</label>
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
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">IMC Atual</label>
                                <p class="text-xs md:text-sm text-gray-900">27.2</p>
                            </div>
                            <div>
                                <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Status</label>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Ativo
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Summary -->
                    <div class="bg-white rounded-lg shadow p-4 md:p-6 mt-4 md:mt-6">
                        <h2 class="text-sm md:text-base font-semibold text-gray-900 mb-3 md:mb-4">Resumo do Progresso</h2>
                        <div class="space-y-3 md:space-y-4">
                            <div class="bg-green-50 rounded-lg p-3 md:p-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-xs font-medium text-green-800">Peso Perdido</span>
                                    <span class="text-xs md:text-sm font-bold text-green-900">11 kg</span>
                                </div>
                            </div>
                            <div class="bg-blue-50 rounded-lg p-3 md:p-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-xs font-medium text-blue-800">Meta Restante</span>
                                    <span class="text-xs md:text-sm font-bold text-blue-900">9 kg</span>
                                </div>
                            </div>
                            <div class="bg-purple-50 rounded-lg p-3 md:p-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-xs font-medium text-purple-800">Progresso</span>
                                    <span class="text-xs md:text-sm font-bold text-purple-900">55%</span>
                                </div>
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
                                <button @click="showTab('personal-data')" 
                                        :class="activeTab === 'personal-data' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                        class="whitespace-nowrap py-2 md:py-3 px-1 border-b-2 font-medium text-xs">
                                    Dados Pessoais
                                </button>
                                <button @click="showTab('medical-history')" 
                                        :class="activeTab === 'medical-history' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                        class="whitespace-nowrap py-2 md:py-3 px-1 border-b-2 font-medium text-xs">
                                    Histórico Clínico
                                </button>
                                <button @click="showTab('evolution-photos')" 
                                        :class="activeTab === 'evolution-photos' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                        class="whitespace-nowrap py-2 md:py-3 px-1 border-b-2 font-medium text-xs">
                                    Fotos de Evolução
                                </button>
                                <button @click="showTab('consultations')" 
                                        :class="activeTab === 'consultations' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                        class="whitespace-nowrap py-2 md:py-3 px-1 border-b-2 font-medium text-xs">
                                    Consultas
                                </button>
                            </nav>
                        </div>

                        <!-- Tab Content -->
                        <div class="p-4 md:p-6">
                            <!-- Dados Pessoais Tab -->
                            <div x-show="activeTab === 'personal-data'" class="tab-content space-y-4 md:space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Nome Completo</label>
                                        <p class="text-xs md:text-sm text-gray-900">Maria Silva</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Email</label>
                                        <p class="text-xs md:text-sm text-gray-900">maria.silva@email.com</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Telefone</label>
                                        <p class="text-xs md:text-sm text-gray-900">(11) 99999-9999</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Data de Nascimento</label>
                                        <p class="text-xs md:text-sm text-gray-900">15/05/1992</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">CPF</label>
                                        <p class="text-xs md:text-sm text-gray-900">123.456.789-00</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700 mb-1">Endereço</label>
                                        <p class="text-xs md:text-sm text-gray-900">Rua das Flores, 123 - São Paulo/SP</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Contato de Emergência</label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Nome</label>
                                            <p class="text-xs md:text-sm text-gray-900">João Silva</p>
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Telefone</label>
                                            <p class="text-xs md:text-sm text-gray-900">(11) 88888-8888</p>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Alergias</label>
                                    <p class="text-xs md:text-sm text-gray-900">Nenhuma alergia conhecida</p>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Histórico Médico</label>
                                    <p class="text-xs md:text-sm text-gray-900">Paciente em tratamento para perda de peso. Sem histórico de doenças crônicas.</p>
                                </div>
                            </div>

                            <!-- Histórico Clínico Tab -->
                            <div x-show="activeTab === 'medical-history'" class="tab-content hidden space-y-4 md:space-y-6">
                                <div class="bg-blue-50 rounded-lg p-4 md:p-6">
                                    <h3 class="text-sm md:text-base font-semibold text-blue-900 mb-3 md:mb-4">Condições Médicas</h3>
                                    <div class="space-y-2 md:space-y-3">
                                        <div class="flex items-center justify-between p-3 bg-white rounded-lg">
                                            <span class="text-xs md:text-sm text-gray-900">Obesidade</span>
                                            <span class="text-xs text-blue-600 font-medium">Em tratamento</span>
                                        </div>
                                        <div class="flex items-center justify-between p-3 bg-white rounded-lg">
                                            <span class="text-xs md:text-sm text-gray-900">Hipertensão</span>
                                            <span class="text-xs text-green-600 font-medium">Controlada</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-green-50 rounded-lg p-4 md:p-6">
                                    <h3 class="text-sm md:text-base font-semibold text-green-900 mb-3 md:mb-4">Medicações Atuais</h3>
                                    <div class="space-y-2 md:space-y-3">
                                        <div class="flex items-center justify-between p-3 bg-white rounded-lg">
                                            <div>
                                                <span class="text-xs md:text-sm text-gray-900 font-medium">Metformina</span>
                                                <p class="text-xs text-gray-600">500mg - 2x ao dia</p>
                                            </div>
                                            <span class="text-xs text-green-600 font-medium">Ativa</span>
                                        </div>
                                        <div class="flex items-center justify-between p-3 bg-white rounded-lg">
                                            <div>
                                                <span class="text-xs md:text-sm text-gray-900 font-medium">Omega 3</span>
                                                <p class="text-xs text-gray-600">1000mg - 1x ao dia</p>
                                            </div>
                                            <span class="text-xs text-green-600 font-medium">Ativa</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-yellow-50 rounded-lg p-4 md:p-6">
                                    <h3 class="text-sm md:text-base font-semibold text-yellow-900 mb-3 md:mb-4">Exames Recentes</h3>
                                    <div class="space-y-2 md:space-y-3">
                                        <div class="flex items-center justify-between p-3 bg-white rounded-lg">
                                            <div>
                                                <span class="text-xs md:text-sm text-gray-900 font-medium">Hemograma Completo</span>
                                                <p class="text-xs text-gray-600">15/10/2024</p>
                                            </div>
                                            <span class="text-xs text-green-600 font-medium">Normal</span>
                                        </div>
                                        <div class="flex items-center justify-between p-3 bg-white rounded-lg">
                                            <div>
                                                <span class="text-xs md:text-sm text-gray-900 font-medium">Glicemia</span>
                                                <p class="text-xs text-gray-600">15/10/2024</p>
                                            </div>
                                            <span class="text-xs text-green-600 font-medium">Normal</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Fotos de Evolução Tab -->
                            <div x-show="activeTab === 'evolution-photos'" class="tab-content hidden space-y-4 md:space-y-6">
                                <div class="text-center py-6 md:py-8">
                                    <div class="w-12 h-12 md:w-16 md:h-16 lg:w-20 lg:h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="h-6 w-6 md:h-8 md:w-8 lg:h-10 lg:w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-sm md:text-base lg:text-lg font-medium text-gray-900 mb-2">Nenhuma foto de evolução</h3>
                                    <p class="text-xs md:text-sm text-gray-500 mb-4">Adicione fotos para acompanhar o progresso do paciente</p>
                                    <button @click="openPhotoUploadModal('evolution')" class="px-4 py-2 text-xs md:text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                        Adicionar Foto
                                    </button>
                                </div>

                                <!-- Exemplo de fotos (quando houver) -->
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    <div class="bg-gray-100 rounded-lg p-3 md:p-4 text-center">
                                        <div class="w-full h-24 md:h-32 bg-gray-200 rounded mb-2"></div>
                                        <p class="text-xs text-gray-600">15/10/2024</p>
                                    </div>
                                    <div class="bg-gray-100 rounded-lg p-3 md:p-4 text-center">
                                        <div class="w-full h-24 md:h-32 bg-gray-200 rounded mb-2"></div>
                                        <p class="text-xs text-gray-600">01/10/2024</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Consultas Tab -->
                            <div x-show="activeTab === 'consultations'" class="tab-content hidden space-y-3 md:space-y-4">
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                                <span class="text-xs font-bold text-blue-600">15/10</span>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-xs md:text-sm font-medium text-gray-900">Consulta de Rotina</p>
                                                <p class="text-xs text-gray-600">Peso: 74kg | IMC: 27.2</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Concluída
                                            </span>
                                            <p class="text-xs text-gray-500 mt-1">09:00</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-green-100 rounded-full flex items-center justify-center">
                                                <span class="text-xs font-bold text-green-600">01/10</span>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-xs md:text-sm font-medium text-gray-900">Retorno</p>
                                                <p class="text-xs text-gray-600">Peso: 76kg | Perda: 2kg</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Concluída
                                            </span>
                                            <p class="text-xs text-gray-500 mt-1">14:30</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-orange-100 rounded-full flex items-center justify-center">
                                                <span class="text-xs font-bold text-orange-600">25/10</span>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-xs md:text-sm font-medium text-gray-900">Próxima Consulta</p>
                                                <p class="text-xs text-gray-600">Avaliação de progresso</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                Agendada
                                            </span>
                                            <p class="text-xs text-gray-500 mt-1">10:00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal Upload de Foto -->
    <div x-show="showPhotoUploadModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50"
         @click.self="closePhotoUploadModal()">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <!-- Header -->
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base md:text-lg font-medium text-gray-900">
                        <span x-text="photoType === 'profile' ? 'Alterar Foto do Paciente' : 'Adicionar Foto de Evolução'"></span>
                    </h3>
                    <button @click="closePhotoUploadModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5 md:h-6 md:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Form -->
                <div class="space-y-4">
                    <!-- File Upload -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Foto *</label>
                        <input type="file" 
                               @change="photoFile = $event.target.files[0]" 
                               accept="image/*"
                               class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Photo Date -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Data da Foto *</label>
                        <input type="date" 
                               x-model="photoDate"
                               class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Weight (only for evolution photos) -->
                    <div x-show="photoType === 'evolution'">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Peso (kg)</label>
                        <input type="number" 
                               x-model="photoWeight"
                               step="0.1" 
                               placeholder="75.5"
                               class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Descrição</label>
                        <textarea rows="3" 
                                  x-model="photoDescription"
                                  placeholder="Descreva a foto..."
                                  class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-4 pt-4">
                        <button @click="closePhotoUploadModal()" class="w-full sm:w-auto px-4 py-2 text-xs md:text-sm border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Cancelar
                        </button>
                        <button @click="handlePhotoUpload()" class="w-full sm:w-auto px-4 py-2 text-xs md:text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Enviar Foto
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Nova Consulta -->
    <div x-show="showNewConsultationModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50"
         @click.self="closeNewConsultationModal()">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <!-- Header -->
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base md:text-lg font-medium text-gray-900">Nova Consulta</h3>
                    <button @click="closeNewConsultationModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5 md:h-6 md:w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Form -->
                <div class="space-y-4">
                    <!-- Date and Time -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Data *</label>
                            <input type="date" 
                                   x-model="appointmentDate"
                                   class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Hora *</label>
                            <input type="time" 
                                   x-model="appointmentTime"
                                   class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Type -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Tipo de Consulta *</label>
                        <select x-model="appointmentType" class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="consultation">Consulta de Rotina</option>
                            <option value="follow_up">Retorno</option>
                            <option value="emergency">Emergência</option>
                        </select>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Observações</label>
                        <textarea rows="3" 
                                  x-model="appointmentNotes"
                                  placeholder="Observações sobre a consulta..."
                                  class="w-full px-3 py-2 text-xs md:text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-4 pt-4">
                        <button @click="closeNewConsultationModal()" class="w-full sm:w-auto px-4 py-2 text-xs md:text-sm border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Cancelar
                        </button>
                        <button @click="handleAppointmentSubmit()" class="w-full sm:w-auto px-4 py-2 text-xs md:text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Agendar Consulta
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Alpine.js já está carregado no bootstrap.js
            console.log('Página de detalhes do paciente carregada');
        </script>
    @endpush
</x-app-layout>
