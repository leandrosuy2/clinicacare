/**
 * Patient Details Manager - Alpine.js Component
 * Gerencia o estado e funcionalidades da página de detalhes do paciente
 */
function patientDetailsManager(patientId = 1) {
    return {
        // Estado dos modais
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
        patientId: patientId,
        
        // Funções das abas
        showTab(tabName) {
            this.activeTab = tabName;
        },
        
        // Funções dos modais
        openEditPatientModal() {
            this.showEditPatientModal = true;
            document.body.style.overflow = 'hidden';
        },
        
        closeEditPatientModal() {
            this.showEditPatientModal = false;
            document.body.style.overflow = 'auto';
        },
        
        openNewConsultationModal() {
            this.showNewConsultationModal = true;
            document.body.style.overflow = 'hidden';
            
            // Definir data e hora padrão
            const now = new Date();
            this.appointmentDate = now.toISOString().split('T')[0];
            this.appointmentTime = '09:00';
        },
        
        closeNewConsultationModal() {
            this.showNewConsultationModal = false;
            document.body.style.overflow = 'auto';
            this.resetAppointmentForm();
        },
        
        openPhotoUploadModal(type) {
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
        },
        
        // Inicialização
        init() {
            // Fechar modais com Escape
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    this.closeEditPatientModal();
                    this.closeNewConsultationModal();
                    this.closePhotoUploadModal();
                }
            });
        }
    }
}

// Exportar para uso global
window.patientDetailsManager = patientDetailsManager;
