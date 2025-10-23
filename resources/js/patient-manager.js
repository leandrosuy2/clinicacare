/**
 * Patient Manager - Alpine.js Component
 * Gerencia o estado e funcionalidades da página de pacientes
 */
function patientManager() {
    return {
        // Estado dos modais
        showNewPatientModal: false,
        showEditPatientModal: false,
        showDeletePatientModal: false,
        
        // Estado da busca e filtros
        searchTerm: '',
        deleteMessage: 'Tem certeza que deseja excluir este paciente? Esta ação não pode ser desfeita.',
        patientToDelete: null,
        
        // Funções dos modais
        openNewPatientModal() {
            this.showNewPatientModal = true;
            document.body.style.overflow = 'hidden';
        },
        
        closeNewPatientModal() {
            this.showNewPatientModal = false;
            document.body.style.overflow = 'auto';
            // Limpar formulário
            const form = document.querySelector('#newPatientModal form');
            if (form) form.reset();
        },
        
        openEditPatientModal(patientId = null) {
            this.showEditPatientModal = true;
            document.body.style.overflow = 'hidden';
            
            if (patientId) {
                this.loadPatientData(patientId);
            }
        },
        
        closeEditPatientModal() {
            this.showEditPatientModal = false;
            document.body.style.overflow = 'auto';
        },
        
        openDeletePatientModal(patientId = null, patientName = '') {
            this.showDeletePatientModal = true;
            document.body.style.overflow = 'hidden';
            
            if (patientName) {
                this.deleteMessage = `Tem certeza que deseja excluir o paciente "${patientName}"? Esta ação não pode ser desfeita.`;
            }
            
            this.patientToDelete = patientId;
        },
        
        closeDeletePatientModal() {
            this.showDeletePatientModal = false;
            document.body.style.overflow = 'auto';
            this.deleteMessage = 'Tem certeza que deseja excluir este paciente? Esta ação não pode ser desfeita.';
        },
        
        confirmDeletePatient() {
            console.log('Deleting patient:', this.patientToDelete);
            
            this.showNotification('Paciente excluído com sucesso!', 'success');
            this.closeDeletePatientModal();
            
            setTimeout(() => {
                location.reload();
            }, 1000);
        },
        
        // Funções de formulário
        handleNewPatientSubmit(event) {
            event.preventDefault();
            
            const formData = new FormData(event.target);
            const patientData = Object.fromEntries(formData);
            
            console.log('New patient data:', patientData);
            
            this.showNotification('Paciente criado com sucesso!', 'success');
            this.closeNewPatientModal();
            
            setTimeout(() => {
                location.reload();
            }, 1000);
        },
        
        handleEditPatientSubmit(event) {
            event.preventDefault();
            
            const formData = new FormData(event.target);
            const patientData = Object.fromEntries(formData);
            
            console.log('Updated patient data:', patientData);
            
            this.showNotification('Paciente atualizado com sucesso!', 'success');
            this.closeEditPatientModal();
            
            setTimeout(() => {
                location.reload();
            }, 1000);
        },
        
        loadPatientData(patientId) {
            console.log('Loading patient data for ID:', patientId);
        },
        
        // Função de filtro
        filterPatients() {
            // Esta função será chamada automaticamente pelo Alpine.js quando searchTerm mudar
            // Os cards já estão usando x-show="isPatientVisible()" que será avaliado automaticamente
        },
        
        isPatientVisible(patientId, patientName, patientAge) {
            if (!this.searchTerm) return true;
            
            const searchLower = this.searchTerm.toLowerCase();
            return patientName.toLowerCase().includes(searchLower) || 
                   patientAge.toLowerCase().includes(searchLower);
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
        
        // Fechar modais com Escape
        init() {
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    this.closeNewPatientModal();
                    this.closeEditPatientModal();
                    this.closeDeletePatientModal();
                }
            });
        }
    }
}

// Exportar para uso global
window.patientManager = patientManager;
