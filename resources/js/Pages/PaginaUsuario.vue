<template>
    <div class="usuario-page">
      <div class="sidebar">
        <div class="logo-container">
          <div class="logo">Instituto <span class="psi">Psi</span></div>
        </div>
        <div class="user-info">
          <font-awesome-icon class="user-icon" icon="user-circle" />
          <p>Bem-vindo, {{ user }}</p>
        </div>
        <ul>
          <li><a @click.prevent="currentSection = 'historico'" href="#">Histórico de Consultas</a></li>
          <li><a @click.prevent="currentSection = 'novo-agendamento'" href="#">Novo Agendamento</a></li>
          <li><a @click.prevent="currentSection = 'consultas'" href="#">Consultas</a></li>
          <li><a @click.prevent="logout" href="#">Sair</a></li>
        </ul>
      </div>
  
      <div class="main-content">
        <div v-if="currentSection === 'historico'" class="section">
          <h2>Histórico de Consultas</h2>
          <p>Aqui é possível ver suas sessões antigas!</p>
          <table class="historico-table">
            <thead>
              <tr>
                <th>Profissional</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Anotações de Sessão</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="historico in paginatedHistorico" :key="historico.id">
                <td>{{ historico.professional }}</td>
                <td>{{ historico.date }}</td>
                <td>{{ historico.time }}</td>
                <td><button @click="viewNotes(historico.notes)">Ver Anotações</button></td>
              </tr>
            </tbody>
          </table>
          <div class="pagination">
            <button @click="prevHistoricoPage" :disabled="historicoPage === 1">Anterior</button>
            <span>Página {{ historicoPage }} de {{ totalHistoricoPages }}</span>
            <button @click="nextHistoricoPage" :disabled="historicoPage === totalHistoricoPages">Próxima</button>
          </div>
        </div>
  
        <div v-if="currentSection === 'novo-agendamento'" class="section">
          <h2>Novo Agendamento</h2>
          <input type="text" v-model="searchQuery" placeholder="Pesquisar profissional" class="search-bar" />
          <ul class="professionals-list">
            <li v-for="professional in paginatedProfessionals" :key="professional.id" class="professional-item">
              <div class="info">
                <p class="name">{{ professional.name }}</p>
              </div>
              <!-- Adicionando manipulador de eventos ao clicar em um profissional -->
              <button @click="showPopup(professional)" class="agendamento-button">Agendamento</button>
            </li>
          </ul>
          <div class="pagination">
            <button @click="prevPage" :disabled="currentPage === 1">Anterior</button>
            <span>Página {{ currentPage }} de {{ totalPages }}</span>
            <button @click="nextPage" :disabled="currentPage === totalPages">Próxima</button>
          </div>
        </div>
  
        <div v-if="currentSection === 'consultas'" class="section">
          <!-- Conteúdo das Consultas -->
        </div>
      </div>
  
      <!-- Pop-up -->
      <div v-if="popupVisible" class="popup">
        <div class="popup-header">
          <div class="popup-header-left">
            <div class="popup-header-text">
              <h3>{{ selectedProfessional.name }}</h3>
            </div>
          </div>
          <button @click="hidePopup" class="close-button">Fechar</button>
        </div>
        <div class="popup-content">
          <h2>Data de Agendamento</h2>
          <input type="date" class="date-picker" v-model="appointment.date"/>
          <h3>Horário da Consulta</h3>
          <div class="horarios">
            <button class="horario-button" v-for="horario in horarios" :key="horario" @click="selectTime(horario)">{{ horario }}</button>
          </div>
          <button class="confirmar-button" @click="confirmAppointment">Confirmar</button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { ref, computed } from 'vue';
  import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
  import { library } from '@fortawesome/fontawesome-svg-core';
  import { faUserCircle } from '@fortawesome/free-solid-svg-icons';
  import axios from 'axios';
  
  library.add(faUserCircle);
  
  export default {
    props: {user: String
      // names: {
      //   id
      // }
    },
    mounted() {
      // console.log('User authenticated:',this.user);
    },
    components: {
      FontAwesomeIcon
    },
    methods: {
      logout() {
        this.$inertia.post('/logout');
      },
      async fetchProfessionals() {
        try
        {
          const response = await axios.get('/api/psychologists');
          this.professionals = response.data;
          console.log(response.data); 
      } catch (error) {
        console.error(error);
      }
      
    }
    },
    mounted() {
      this.fetchProfessionals()
    },  
    setup() {
      const currentSection = ref('historico');
      const horarios = ref(['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00']);
      const searchQuery = ref('');
      const currentPage = ref(1);
      const historicoPage = ref(1);
      const itemsPerPage = 5;
      const historicoItemsPerPage = 5;
      const appointment = ref({
        date: '',
        time: '',
        doctorId : 1
      });
  
      const professionals = ref([]);
  
      const historico = ref([
        { id: 1, professional: 'Ana Silva', date: '2023-01-15', time: '08:00', notes: 'Anotações da sessão 1' },
        { id: 2, professional: 'Bruno Costa', date: '2023-02-10', time: '09:30', notes: 'Anotações da sessão 2' },
        { id: 3, professional: 'Carla Mendes', date: '2023-03-05', time: '11:00', notes: 'Anotações da sessão 3' },
        { id: 4, professional: 'Daniela Rocha', date: '2023-04-12', time: '08:00', notes: 'Anotações da sessão 4' },
        { id: 5, professional: 'Eduardo Santos', date: '2023-05-20', time: '09:30', notes: 'Anotações da sessão 5' },
        { id: 6, professional: 'Fernanda Lima', date: '2023-06-18', time: '11:00', notes: 'Anotações da sessão 6' },
        { id: 7, professional: 'Gustavo Teixeira', date: '2023-07-25', time: '08:00', notes: 'Anotações da sessão 7' },
        { id: 8, professional: 'Helena Alves', date: '2023-08-30', time: '09:30', notes: 'Anotações da sessão 8' },
      ]);
  
      const filteredProfessionals = computed(() => {
        if (!searchQuery.value) {
          return professionals.value;
        }
        return professionals.value.filter(professional =>
          professional.name.toLowerCase().includes(searchQuery.value.toLowerCase())
        );
      });
  
      const totalPages = computed(() => {
        return Math.ceil(filteredProfessionals.value.length / itemsPerPage);
      });
  
      const totalHistoricoPages = computed(() => {
        return Math.ceil(historico.value.length / historicoItemsPerPage);
      });
  
      const paginatedProfessionals = computed(() => {
        const start = (currentPage.value - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        console.log(filteredProfessionals.value);
        return filteredProfessionals.value.slice(start, end);
      });
  
      const paginatedHistorico = computed(() => {
        const start = (historicoPage.value - 1) * historicoItemsPerPage;
        const end = start + historicoItemsPerPage;
        return historico.value.slice(start, end);
      });
  
      const prevPage = () => {
        if (currentPage.value > 1) {
          currentPage.value--;
        }
      };
  
      const nextPage = () => {
        if (currentPage.value < totalPages.value) {
          currentPage.value++;
        }
      };
  
      const prevHistoricoPage = () => {
        if (historicoPage.value > 1) {
          historicoPage.value--;
        }
      };
  
      const nextHistoricoPage = () => {
        if (historicoPage.value < totalHistoricoPages.value) {
          historicoPage.value++;
        }
      };
  
      const popupVisible = ref(false);
      const selectedProfessional = ref(null);
  
      const showPopup = (professional) => {
        selectedProfessional.value = professional;
        popupVisible.value = true;
      };
  
      const hidePopup = () => {
        popupVisible.value = false;
      };
  
      const viewNotes = (notes) => {
        alert(notes);
      };
  
  
      return {
        currentSection,
        searchQuery,
        currentPage,
        historicoPage,
        itemsPerPage,
        historicoItemsPerPage,
        professionals,
        historico,
        filteredProfessionals,
        totalPages,
        totalHistoricoPages,
        paginatedProfessionals,
        paginatedHistorico,
        prevPage,
        nextPage,
        prevHistoricoPage,
        nextHistoricoPage,
        popupVisible,
        selectedProfessional,
        showPopup,
        hidePopup,
        viewNotes,
        horarios,
      };
    },
  };
  </script>
  
  <style scoped>
  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
  
  body {
    font-family: 'Roboto', sans-serif;
  }
  
  .usuario-page {
    display: flex;
    min-height: 100vh;
  }
  
  .sidebar {
    background-color: #474a59;
    color: white;
    padding: 20px;
    width: 250px;
    min-height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto;
    padding-top: 30px;
  }
  
  .logo-container .logo {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
  }
  
  .logo-container .psi {
    color: #89ffdb;
  }
  
  .user-info {
    text-align: center;
    margin-bottom: 30px;
  }
  
  .user-info .user-icon {
    font-size: 36px;
    margin-bottom: 10px;
  }
  
  .user-info p {
    margin: 0;
    font-weight: bold;
  }
  
  .sidebar ul {
    list-style: none;
    padding: 0;
  }
  
  .sidebar ul li {
    margin: 20px 0;
  }
  
  .sidebar ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    display: block;
    padding: 10px 0;
  }
  
  .sidebar ul li a:hover {
    background-color: #636b6f;
    border-radius: 5px;
    padding-left: 10px;
  }
  
  .main-content {
    flex-grow: 1;
    padding: 20px;
    margin-left: 250px; /* Espaço para a sidebar */
  }
  
  .search-bar {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
  }
  
  .professionals-list {
    list-style: none;
    padding: 0;
  }
  
  .professional-item {
    display: flex;
    align-items: center;
    background-color: white;
    padding: 15px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }
  
  .professional-item .circle {
    width: 50px;
    height: 50px;
    background-color: #89ffdb;
    color: #474a59;
    font-size: 24px;
    font-weight: bold;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
  }
  
  .professional-item .info {
    flex-grow: 1;
  }
  
  .professional-item .name {
    font-size: 18px;
    font-weight: bold;
    margin: 0;
  }
  
  .professional-item .profession {
    margin: 0;
    color: #666;
  }
  
  .professional-item button {
    background-color: #474a59;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .professional-item button:hover {
    background-color: #333640;
  }
  
  .pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
  }
  
  .pagination button {
    background-color: #474a59;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin: 0 10px;
  }
  
  .pagination button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
  }
  
  .popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    z-index: 1001; /* Valor acima do z-index da navbar */
    border-radius: 10px;
    width: 90%;
    max-width: 400px;
  }
  
  .popup-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }
  
  .popup-header-left {
    display: flex;
    align-items: center;
  }
  
  .popup-icon {
    width: 50px;
    height: 50px;
    background-color: #89ffdb;
    color: #474a59;
    font-size: 24px;
    font-weight: bold;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
  }
  
  .popup-header-text h3 {
    margin: 0;
    font-size: 18px;
    font-weight: bold;
  }
  
  .popup-header-text p {
    margin: 0;
    color: #666;
  }
  
  .close-button {
    background-color: transparent;
    border: none;
    color: #666;
    font-size: 20px;
    cursor: pointer;
  }
  
  .popup-content {
    text-align: center;
    padding: 20px;
  }
  
  .date-picker {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    margin-top: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
  }
  
  .horarios {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    gap: 10px;
  }
  
  .horario-button {
    padding: 10px 20px;
    background-color: #89ffdb;
    color: #474a59;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .horario-button:hover {
    background-color: #74ccbe;
  }
  
  .confirmar-button {
    padding: 10px 20px;
    margin-top: 20px;
    background-color: #474a59;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .confirmar-button:hover {
    background-color: #333640;
  }
  
  .section {
    margin-bottom: 40px;
  }
  
  .section h2 {
    font-size: 36px; /* Aumenta o tamanho do título */
    font-weight: bold; /* Deixa o título em negrito */
    color: #474A59; /* Define a cor do título */
  }
  
  .section p {
    font-size: 18px; /* Aumenta o tamanho do texto abaixo do título */
    color: #474A59; /* Define a cor do texto */
  }
  
  .historico-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }
  
  .historico-table th, .historico-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
  }
  
  .historico-table th {
    background-color: #f2f2f2;
  }
  
  .historico-table td button {
    background-color: transparent;
    border: none;
    color: #007bff;
    text-decoration: underline;
    cursor: pointer;
  }
  
  .historico-table td button:hover {
    color: #0056b3;
  }
  </style>
  