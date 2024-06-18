<template>
    <div class="new-page">
      <div :class="['sidebar', { hidden: isSidebarHidden }]">
        <div class="logo-container">
          <div class="logo">Instituto <span class="psi">Psi</span></div>
        </div>
        <div class="user-info">
          <font-awesome-icon class="user-icon" icon="user-circle" />
          <p>Bem-vindo, {{ user }}</p>
        </div>
        <nav class="nav-menu">
          <ul>
            <li @click="selectSection('Pacientes')" :class="{ active: selectedSection === 'Pacientes' }">Pacientes de Hoje</li>
            <li @click="selectSection('Documentos')" :class="{ active: selectedSection === 'Documentos' }">Documentos</li>
            <li @click="selectSection('Fichas')" :class="{ active: selectedSection === 'Fichas' }">Fichas</li>
            <li @click="selectSection('Notificacoes')" :class="{ active: selectedSection === 'Notificacoes' }">Notificações</li>
            <li @click="logout">Sair</li>
          </ul>
        </nav>
      </div>

      <div class="main-content">
        <button @click="toggleSidebar" class="toggle-button">
          <font-awesome-icon :icon="[isSidebarHidden ? 'arrow-right' : 'arrow-left']" />
        </button>

        <div v-if="selectedSection === 'Fichas'">
          <h2 class="section-title">Pacientes</h2>
          <ul class="patients-list">
            <li v-for="patient in allPatients" :key="patient.id" class="patient-item">
              <div class="info">
                <p class="appointment-time">{{ patient.name }}</p>
              </div>
              <button @click="showPatientRecord(patient,patient.id,patient.id)" class="record-button">Ficha</button>
            </li>
          </ul>
          <div v-if="showForms" class="patient-record">
            <h3>Ficha do Paciente</h3>
             <div class="form-row">
              <label>Nome Completo: {{ currUserData.name }}</label>
              <!-- <p></p> -->
              <label>Email: {{ currUserData.email }}</label>
              <!-- <p></p> -->
            </div>
            <div class="form-row">
              <label>CPF:</label>
              <p>{{ currUserData.cpf }}</p>
              <label>Telefone:</label>
              <p>{{ currUserData.telefone }}</p>
            </div>
            <div class="form-row">
              <label>Data de Nascimento:</label>
              <p>{{ currUserData.dob }}</p>
              <label>CEP:</label>
              <p>{{ currUserData.cep }}</p>
            </div>
            <div class="form-row">
              <label>Logradouro:</label>
              <p>{{ currUserData.logradouro }}</p>
              <label>Complemento:</label>
              <p>{{ currUserData.complemento }}</p>
            </div>
            <div class="form-row">
              <label>Bairro:</label>
              <p>{{ currUserData.bairro }}</p>
              <label>Cidade:</label>
              <p>{{ currUserData.localidade }}</p>
            </div>
            <div class="form-row">
              <label>UF:</label>
              <p>{{ currUserData.uf }}</p>
            </div>

            <h3>Informações de Sessão</h3>
            <div class="session-info">
            <div class="form-row" v-for="field in sessionFields" :key="field.key">
                <label>{{ field.label }}:</label>
                <p>{{ sessionData[field.key] }}</p> <!-- Dados exibidos em texto estático -->
            </div>

              <h3>Histórico da Queixa</h3>
              <div class="form-row" v-for="field in complaintHistoryFields" :key="field.key">
                <label>{{ field.label }}</label>
                <p>{{sessionData[field.key]}}</p>
              </div>
              <h3>Infância</h3>
              <div class="form-row" v-for="field in childhoodFields" :key="field.key">
                <label>{{ field.label }}</label>
                <p>{{sessionData[field.key]}}</p>
              </div>
              <!-- Adolescência -->
              <h3>Adolescência</h3>
              <div class="session-info">
                <div class="form-row">
                  <label>Experiências afetivas marcantes</label>
                  <p>{{ sessionData.affectionate_experiences }}</p>
                </div>
                <div class="form-row">
                  <label>Experiências sexuais marcantes</label>
                  <p>{{sessionData.sexual_experiences}}</p>
                </div>
                <div class="form-row">
                  <label>Independência / Primeiros empregos</label>
                  <p>{{sessionData.first_jobs}}</p>
                </div>
                <div class="form-row">
                  <label>Círculos de amizade</label>
                  <p>{{sessionData.friendship_circles}}</p>
                </div>
              </div>

              <!-- Vida Adulta -->
              <h3>Vida Adulta</h3>
                <div class="session-info">
                <div class="form-row">
                    <label>Relacionamentos com parceiro:</label>
                    <p>{{ sessionData.partner_relationships }}</p>
                </div>
                <div class="form-row">
                    <label>Vida sexual atual:</label>
                    <p>{{ sessionData.current_sex_life }}</p>
                </div>
                <div class="form-row">
                    <label>Situação financeira:</label>
                    <p>{{ sessionData.financial_situation }}</p>
                </div>
                <div class="form-row">
                    <label>Abortos espontâneos/provocados:</label>
                    <p>{{ sessionData.abortions }}</p>
                </div>
                <div class="form-row">
                    <label>Apoio social disponível:</label>
                    <p>{{ sessionData.social_support }}</p>
                </div>
                <div class="form-row">
                    <label>Outros transtornos atuais (sono, alimentação, tiques, etc.):</label>
                    <p>{{ sessionData.current_disorders }}</p>
                </div>
                <div class="form-row">
                    <label>Principais lazeres:</label>
                    <p>{{ sessionData.main_leisure_activities }}</p>
                </div>
                <div class="form-row">
                    <label>Vida social:</label>
                    <p>{{ sessionData.social_life }}</p>
                </div>
                </div>

              <!-- Observações -->
              <h3>Observações</h3>
                <div class="session-info">
                <div class="form-row">
                    <label>Observação geral:</label>
                    <p>{{ sessionData.general_observation }}</p>
                </div>
                <div class="form-row">
                    <label>Linguagem não verbal do paciente:</label>
                    <p>{{ sessionData.non_verbal_language }}</p>
                </div>
                </div>

                <h3>Atendimentos Prestados</h3>
                <div class="session-info">
                <div class="form-row">
                    <label>Profissional:</label>
                    <p>{{ sessionData.professional }}</p>
                </div>
                <div class="form-row">
                    <label>Encaminhamentos feitos:</label>
                    <p>{{ sessionData.referrals_made }}</p>
                </div>
                <div class="form-row">
                    <label>Terapêutica utilizada (prescrição de exercícios, leituras, relacionamento, etc.):</label>
                    <p>{{ sessionData.therapeutics_used }}</p>
                </div>
                </div>

            </div>
        </div>
        </div>
        <!-- Adicionando a seção de notificações -->
        <div v-if="selectedSection === 'Notificacoes'">
            <h2 class="section-title">Notificações</h2>
            <ul class="notification-list">
              <li v-for="notification in notifications" :key="notification.id" :class="{ unread: !notification.read }">
                {{ notification.message }} {{ notification.consulta }}
                <button @click="markNotificationAsRead(notification.id)">Marcar como lida</button>
              </li>
            </ul>
        </div>
        <div v-if="selectedSection === 'Pacientes'">
          <h2 class="section-title">Pacientes de hoje</h2>
          <ul class="patients-list">
            <li v-for="patient in patients" :key="patient.id" class="patient-item">
              <div v-if=" patient.done === 0 "class="info">
                <p class="appointment-time">{{ patient.patientName }} {{ patient.time }}</p>
              </div>
              <button @click="showPatientRecord(patient,patient.patient,patient.id)" class="record-button">Ficha</button>
            </li>
          </ul>

          <div v-if="showForms" class="patient-record">
            <h3>Ficha do Paciente</h3>
             <div class="form-row">
              <label>Nome Completo: {{ currUserData.name }}</label>
              <!-- <p></p> -->
              <label>Email: {{ currUserData.email }}</label>
              <!-- <p></p> -->
            </div>
            <div class="form-row">
              <label>CPF:</label>
              <p>{{ currUserData.cpf }}</p>
              <label>Telefone:</label>
              <p>{{ currUserData.telefone }}</p>
            </div>
            <div class="form-row">
              <label>Data de Nascimento:</label>
              <p>{{ currUserData.dob }}</p>
              <label>CEP:</label>
              <p>{{ currUserData.cep }}</p>
            </div>
            <div class="form-row">
              <label>Logradouro:</label>
              <p>{{ currUserData.logradouro }}</p>
              <label>Complemento:</label>
              <p>{{ currUserData.complemento }}</p>
            </div>
            <div class="form-row">
              <label>Bairro:</label>
              <p>{{ currUserData.bairro }}</p>
              <label>Cidade:</label>
              <p>{{ currUserData.localidade }}</p>
            </div>
            <div class="form-row">
              <label>UF:</label>
              <p>{{ currUserData.uf }}</p>
            </div>

            <h3>Informações de Sessão</h3>
            <div class="session-info">
              <div class="form-row" v-for="field in sessionFields" :key="field.key">
                <label>{{ field.label }}</label>
                <textarea v-model="sessionData[field.key]" rows="2" maxlength="500"></textarea>
              </div>
              <h3>Histórico da Queixa</h3>
              <div class="form-row" v-for="field in complaintHistoryFields" :key="field.key">
                <label>{{ field.label }}</label>
                <textarea v-model="sessionData[field.key]" rows="2" maxlength="500"></textarea>
              </div>
              <h3>Infância</h3>
              <div class="form-row" v-for="field in childhoodFields" :key="field.key">
                <label>{{ field.label }}</label>
                <textarea v-model="sessionData[field.key]" rows="2" maxlength="500"></textarea>
              </div>
              <!-- Adolescência -->
              <h3>Adolescência</h3>
              <div class="session-info">
                <div class="form-row">
                  <label>Experiências afetivas marcantes</label>
                  <textarea v-model="sessionData.affectionate_experiences" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Experiências sexuais marcantes</label>
                  <textarea v-model="sessionData.sexual_experiences" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Independência / Primeiros empregos</label>
                  <textarea v-model="sessionData.first_jobs" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Círculos de amizade</label>
                  <textarea v-model="sessionData.friendship_circles" rows="2" maxlength="500"></textarea>
                </div>
              </div>

              <!-- Vida Adulta -->
              <h3>Vida Adulta</h3>
              <div class="session-info">
                <div class="form-row">
                  <label>Relacionamentos com parceiro</label>
                  <textarea v-model="sessionData.partner_relationships" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Vida sexual atual</label>
                  <textarea v-model="sessionData.current_sex_life" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Situação financeira</label>
                  <textarea v-model="sessionData.financial_situation" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Abortos espontâneos/provocados</label>
                  <textarea v-model="sessionData.abortions" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Apoio social disponível</label>
                  <textarea v-model="sessionData.social_support" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Outros transtornos atuais (sono, alimentação, tiques, etc.)</label>
                  <textarea v-model="sessionData.current_disorders" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Principais lazeres</label>
                  <textarea v-model="sessionData.main_leisure_activities" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Vida social</label>
                  <textarea v-model="sessionData.social_life" rows="2" maxlength="500"></textarea>
                </div>
              </div>

              <!-- Observações -->
              <h3>Observações</h3>
              <div class="session-info">
                <div class="form-row">
                  <label>Observação geral</label>
                  <textarea v-model="sessionData.general_observation" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Linguagem não verbal do paciente</label>
                  <textarea v-model="sessionData.non_verbal_language" rows="2" maxlength="500"></textarea>
                </div>
              </div>

              <!-- Atendimentos Prestados -->
              <h3>Atendimentos Prestados</h3>
              <div class="session-info">
                <div class="form-row">
                  <label>Profissional</label>
                  <textarea v-model="sessionData.professional" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Encaminhamentos feitos</label>
                  <textarea v-model="sessionData.referrals_made" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Terapêutica utilizada (prescrição de exercícios, leituras, relacionamento, etc.)</label>
                  <textarea v-model="sessionData.therapeutics_used" rows="2" maxlength="500"></textarea>
                </div>
              </div>

              <button @click="submitRecord" class="save-button">Salvar sessão</button>
            </div>
          </div>
        </div>

        <div v-if="selectedSection === 'Documentos'">
            <h2 class="section-title">Documentos</h2>
            <p>Aqui você pode visualizar e gerenciar seus documentos.</p>
            <DocumentEditor />
        </div>

        </div>
      </div>
  </template>

  <script>
  import { ref } from 'vue';
  import axios from 'axios';
  import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
  import { library } from '@fortawesome/fontawesome-svg-core';
  import { faUserCircle, faArrowLeft, faArrowRight } from '@fortawesome/free-solid-svg-icons';
  import DocumentEditor from '../Components/DocumentEditor.vue';


  library.add(faUserCircle, faArrowLeft, faArrowRight);

  export default {
    props: {
      user: String,
      userid: [Number, String]
    },
    data() {
      return {
        appointments: []
      };
    },
    methods:{
        logout() {
            this.$inertia.post('/logout');
        },
        async fetchNotifications() {
            try {
                const response = await axios.get(`/api/notifications/${this.userid}`);
                this.notifications = response.data;
                console.log(response.data);

            } catch (error) {
                console.error('Erro ao buscar notificações:',error);
            }
        },
      async fetchUserData() {
          try {
              const response = await axios.get(`/api/usuarios/${this.selectedPatient}`); // Ajuste a URL conforme a rota correta
            //   console.log(response.data);
              this.currUserData = response.data;
            //   console.log(this.selectedPatient)
            //   console.log(this.currUserData)
          } catch (error) {
              console.error('Erro ao recuperar os dados:', error);
          }
      }
      ,
      async fetchThisUserData(id) {
          try {
              const response = await axios.get(`/api/usuarios/${id}`); // Ajuste a URL conforme a rota correta
            //   console.log(response.data);
            const dados = response.data;
            const nome = dados.name;
            return nome;
          } catch (error) {
              console.error('Erro ao recuperar os dados:', error);
              return '';
          }
      }
      ,
      async fetchUserRecord () {
        try {
            const response = await axios.get(`/api/records/${this.selectedPatient}`)
            console.log(response.data);
            this.sessionData = response.data;
        } catch (error) {
            console.error('Erro ao recuperar dados de ficha do usuário:', error);
        }
      }
      ,
        async submitRecord() {
        try // REFAZER
        {
          console.log(`/api/records/${this.selectedPatient}`);
          console.log('dados:',this.sessionData);
          const response = await axios.put(`/api/records/${this.selectedPatient}`, this.sessionData);
          console.log(response.data);
          this.setObservations();
          this.showForms = '';
          alert('Ficha salva com sucesso');
        } catch (error) {
          console.log('Erro ao salvar a ficha da consulta:', error);
        }
      }
      ,
      async markNotificationAsRead(id) {
        try {
                const response = await axios.post(`/api/notifications/${id}`);
                console.log(response.data);
                this.fetchNotifications(); // nao testei aqui
            } catch (error) {
                console.error('Erro ao marcar notificação:',error);
            }
      }
      ,
      async fetchAppointments() {
        try {
            // console.log(`/api/appointments/today/${this.userid}`);
            const response = await axios.get(`/api/appointments/today/${this.userid}`);
            this.consultations = response.data;
            // console.log(this.consultations);

            // Filtrar consultas do médico específico
            const medicConsultations = this.consultations.filter(consultation => consultation.medic == this.userid);

            // Criar uma lista de promessas para cada consulta, para buscar o nome do paciente
            const patientNamesPromises = medicConsultations.map(async consultation => {
                const patientName = await this.fetchThisUserData(consultation.patient);
                consultation.time = this.extractTime(consultation.time);
                return { ...consultation, patientName };  // Adicionar o nome do paciente ao objeto da consulta
            });

            // Resolver todas as promessas para obter a lista final de pacientes com os nomes
            this.patients = await Promise.all(patientNamesPromises);
            console.log(this.patients);

        } catch (error) {
            console.error('Erro ao recuperar as consultas:', error);
        }
    }
    ,
    extractTime(dateTime) {
    // O parâmetro dateTime é uma string no formato "yyyy-mm-dd hh-mm"
    // Esta função irá dividir essa string pelo espaço e retornar a parte do tempo
    const timePart = dateTime.split(' ')[1]; // Divide a string pelo espaço e pega o segundo elemento
    const timeComponents = timePart.split(':'); // Divide a parte do tempo por '-'
    return `${timeComponents[0]}:${timeComponents[1]}`;
    }
    ,
    async setObservations() {
        try {
            // console.log('profissional da consulta: ',this.sessionData.professional);
            // console.log('referrals da consulta: ',this.sessionData.referrals_made);
            // console.log('therapeutics da consulta: ',this.sessionData.therapeutics_used);
            this.currAppointment.professional = this.sessionData.professional;
            this.currAppointment.referrals_made = this.sessionData.referrals_made;
            this.currAppointment.therapeutics_used = this.sessionData.therapeutics_used;
            const response = await axios.put(`/api/appointments/update/${this.currAppointmentId}`, this.currAppointment);
            console.log(response.data);
        } catch (error) {
            console.error('Erro ao configurar observações da consulta:', error);
        }
    }
    ,
    async fetchUsers() {
        try {
            const response = await axios.get('/api/users');
            this.allPatients = response.data;
            console.log(this.allPatients);
        } catch (error) {
            console.log('Erro ao coletar os dados dos usuários na ficha:', error);
        }
    }
    ,

    showPatientRecord (appointment,patient, id) {
        if (this.showForms) {
            this.showForms = '';
        } else {
        this.showForms = 'sim';
        this.currAppointment = appointment;
        this.selectedPatient = patient;
        this.currAppointmentId = id;
        this.fetchUserData();
        this.fetchUserRecord();
        }
      }
    },

    mounted() {
      this.fetchNotifications();
      this.fetchAppointments();
      this.fetchUsers();
      this.timer = setInterval(this.fetchNotifications, 10000);
    },
    beforeUnmount() {
        if (this.timer) {
            clearInterval(this.timer);
        }
    },
    components: {
      FontAwesomeIcon,
      DocumentEditor
    },
    setup() {
      const professionalName = ref('Dr. João Silva');
      const currUserData = ref([]);
      const showForms = ref();
      const currAppointment = ref();
      const currAppointmentId = ref('');
      const isSidebarHidden = ref(false);
      const selectedSection = ref('Pacientes');
      const notifications = ref([]);
      const sessionData = ref({});
      const allPatients = ref([]);

      const sessionFields = ref([
        { key: 'profession', label: 'Profissão' },
        { key: 'marital_status', label: 'Est. Civil' },
        { key: 'spouse_name', label: 'Cônjuge (nome)' },
        { key: 'spouse_age', label: 'Cônjuge (idade)' },
        { key: 'spouse_profession', label: 'Cônjuge (profissão)' },
        { key: 'spouse_education', label: 'Cônjuge (escolaridade)' },
        { key: 'main_complaint', label: 'Queixa principal' },
        { key: 'previous_therapy', label: 'Fez terapia anteriormente? (citar qual e quando)' },
        { key: 'patient_expectations', label: 'Expectativas e objetivos do paciente' },
        { key: 'presented_symptoms', label: 'Sintomas apresentados' },
        { key: 'physical_diseases', label: 'Doenças físicas' },
        { key: 'psychosocial_stressors', label: 'Estressores psicossociais' },
        { key: 'global_functioning', label: 'Funcionamento global' },
        { key: 'psychological_conceptualization', label: 'Conceituação Psicológica do caso' },
        { key: 'previous_psychiatric_disorders', label: 'Transtornos psiquiátricos anteriores' },
        { key: 'family_psychiatric_disorders', label: 'Transtornos psiquiátricos familiares' },
        { key: 'significant_diseases', label: 'Doenças importantes que teve' },
        { key: 'current_medication', label: 'Medicação que está tomando' },
        { key: 'alternative_medication', label: 'Medicação alternativa (chás, composto, etc)' },
        { key: 'test_application', label: 'Aplicação de testes? se sim quando e resultado' },
      ]);

      const complaintHistoryFields = ref([
        { key: 'complaint_start', label: 'Quando se iniciou' },
        { key: 'traumatic_events', label: 'Eventos traumáticos de vida' },
        { key: 'crisis_factors', label: 'Eventos/fatores que precipitam ou agravam crises' },
        { key: 'drug_use', label: 'Uso de drogas?' },
        { key: 'suicide_attempt', label: 'Tentativa de suicídio?' },
        { key: 'therapeutic_focus', label: 'Focos de intervenção psicoterápica' },
      ]);

      const childhoodFields = ref([
        { key: 'pregnancy', label: 'Gravidez (planejada ou não)' },
        { key: 'childbirth', label: 'Parto, intercorrências obstétricas' },
        { key: 'breastfeeding', label: 'Amamentação' },
        { key: 'hygiene_training', label: 'Treinamento de Higiene' },
        { key: 'childhood_stressors', label: 'Estressores na infância, crises' },
        { key: 'childhood_disorders', label: 'Outros transtornos infantis (sono, alimentação, psicomotor, gagueira, tiques, sonambulismo, aprendizagem)' },
        { key: 'other_comments', label: 'Outros comentários' }
      ]);

      const patients = ref([]);

      const selectedPatient = ref(null);

      const toggleSidebar = () => {
        isSidebarHidden.value = !isSidebarHidden.value;
      };

      const selectSection = (section) => {
        selectedSection.value = section;
        showForms.value = null;
        selectedPatient.value = null; // Clear selected patient when switching sections
      };

      const saveSession = () => {
        console.log('Session data saved:', sessionData.value);

        // Save sessionData to a database or store it as needed
      };

      return {
        currAppointmentId,
        professionalName,
        isSidebarHidden,
        toggleSidebar,
        patients,
        selectedPatient,
        // showPatientRecord,
        selectedSection,
        selectSection,
        sessionData,
        sessionFields,
        saveSession,
        complaintHistoryFields,
        childhoodFields,
        currUserData,
        notifications,
        currAppointment,
        showForms,
        allPatients
      };
    }
  }
  </script>

  <style>
  body {
    font-family: 'Nunito', sans-serif;
    margin: 0;
    background-color: #f8fafc;
    color: #636b6f;
    font-weight: 100;
  }

  .new-page {
    display: flex;
  }

  .sidebar {
    width: 250px;
    background-color: #474a59;
    color: white;
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    transition: transform 0.3s ease;
  }

  .sidebar.hidden {
    transform: translateX(-100%);
  }

  .logo-container {
    text-align: left;
    margin-bottom: 30px;
    margin-top: 20px;
  }

  .logo-container .logo {
    font-size: 24px;
    font-weight: bold;
    margin-top: -3px;
  }

  .logo-container .psi {
    color: #89ffdb;
  }

  .user-info {
    text-align: center;
    margin-bottom: 30px;
  }

  .user-icon {
    font-size: 40px;
    margin-bottom: 10px;
  }

  .nav-menu ul {
    list-style: none;
    padding: 0;
  }

  .nav-menu ul li {
    padding: 10px 0;
    cursor: pointer;
  }

  .nav-menu ul li.active {
    font-weight: bold;
  }

  .nav-menu ul li:hover {
    text-decoration: underline;
  }

  .main-content {
    margin-left: 250px;
    padding: 20px;
    width: 100%;
    transition: margin-left 0.3s ease;
  }

  .main-content .toggle-button {
    position: absolute;
    top: 20px;
    left: 20px;
    border: none;
    background: none;
    cursor: pointer;
  }

  .main-content .toggle-button:focus {
    outline: none;
  }

  .main-content .section-title {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
  }

  .patients-list {
    list-style: none;
    padding: 0;
  }

  .patient-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
  }

  .circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #474a59;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-right: 15px;
  }

  .info {
    flex-grow: 1;
  }

  .record-button {
    padding: 8px 12px;
    background-color: #474a59;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .record-button:hover {
    background-color: #333640;
  }

  .patient-record {
    margin-top: 40px;
  }

  .patient-record h3 {
    margin-bottom: 20px;
  }

  .patient-record .form-row {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-bottom: 15px;
    width: 100%;
  }

  .patient-record .form-row label {
    margin-bottom: 5px;
    width: 100%;
  }

  .patient-record .form-row textarea {
    width: 100%;
    padding: 8px;
    background-color: #f8f8f8;
    border: 1px solid #ccc;
    border-radius: 5px;
    resize: vertical;
  }

  .save-button {
    padding: 10px 15px;
    background-color: #474a59;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 20px;
  }

  .save-button:hover {
    background-color: #333640;
  }
  .download-button {
    margin-top: 20px;
    padding: 10px 15px;
    background-color: #474a59;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .download-button:hover {
    background-color: #333640;
  }
  </style>
