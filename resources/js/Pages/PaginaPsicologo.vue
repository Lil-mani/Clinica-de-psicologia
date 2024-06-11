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
            <li @click="selectSection('Pacientes')" :class="{ active: selectedSection === 'Pacientes' }">Pacientes</li>
            <li @click="selectSection('Documentos')" :class="{ active: selectedSection === 'Documentos' }">Documentos</li>
            <li @click="logout">Sair</li>
          </ul>
        </nav>
      </div>

      <div class="main-content">
        <button @click="toggleSidebar" class="toggle-button">
          <font-awesome-icon :icon="[isSidebarHidden ? 'arrow-right' : 'arrow-left']" />
        </button>

        <div v-if="selectedSection === 'Pacientes'">
          <h2 class="section-title">Pacientes</h2>
          <ul class="patients-list">
            <li v-for="patient in patients" :key="patient.id" class="patient-item">
              <div v-if=" patient.done === 0 "class="info">
                <p class="name">{{ patient.patient }}</p>
                <p class="appointment-time">{{ patient.time }}</p>
              </div>
              <button @click="showPatientRecord(patient.patient)" class="record-button">Ficha</button>
            </li>
          </ul>

          <div v-if="selectedPatient" class="patient-record">
            <!---<h3>Ficha do Paciente</h3>
             <div class="form-row">
              <label>Nome Completo:</label>
              <p>{{ selectedPatient.name }}</p>
              <label>Email:</label>
              <p>{{ selectedPatient.email }}</p>
            </div>
            <div class="form-row">
              <label>CPF:</label>
              <p>{{ selectedPatient.cpf }}</p>
              <label>Telefone:</label>
              <p>{{ selectedPatient.phone }}</p>
            </div>
            <div class="form-row">
              <label>Data de Nascimento:</label>
              <p>{{ selectedPatient.birthdate }}</p>
              <label>CEP:</label>
              <p>{{ selectedPatient.cep }}</p>
            </div>
            <div class="form-row">
              <label>Logradouro:</label>
              <p>{{ selectedPatient.street }}</p>
              <label>Complemento:</label>
              <p>{{ selectedPatient.complement }}</p>
            </div>
            <div class="form-row">
              <label>Bairro:</label>
              <p>{{ selectedPatient.neighborhood }}</p>
              <label>Cidade:</label>
              <p>{{ selectedPatient.city }}</p>
            </div>
            <div class="form-row">
              <label>UF:</label>
              <p>{{ selectedPatient.state }}</p>
            </div> -->

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
                  <textarea v-model="sessionData.affectionateExperiences" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Experiências sexuais marcantes</label>
                  <textarea v-model="sessionData.sexualExperiences" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Independência / Primeiros empregos</label>
                  <textarea v-model="sessionData.firstJobs" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Círculos de amizade</label>
                  <textarea v-model="sessionData.friendshipCircles" rows="2" maxlength="500"></textarea>
                </div>
              </div>

              <!-- Vida Adulta -->
              <h3>Vida Adulta</h3>
              <div class="session-info">
                <div class="form-row">
                  <label>Relacionamentos com parceiro</label>
                  <textarea v-model="sessionData.partnerRelationships" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Vida sexual atual</label>
                  <textarea v-model="sessionData.currentSexLife" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Situação financeira</label>
                  <textarea v-model="sessionData.financialSituation" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Abortos espontâneos/provocados</label>
                  <textarea v-model="sessionData.abortions" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Apoio social disponível</label>
                  <textarea v-model="sessionData.socialSupport" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Outros transtornos atuais (sono, alimentação, tiques, etc.)</label>
                  <textarea v-model="sessionData.currentDisorders" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Principais lazeres</label>
                  <textarea v-model="sessionData.mainLeisureActivities" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Vida social</label>
                  <textarea v-model="sessionData.socialLife" rows="2" maxlength="500"></textarea>
                </div>
              </div>

              <!-- Observações -->
              <h3>Observações</h3>
              <div class="session-info">
                <div class="form-row">
                  <label>Observação geral</label>
                  <textarea v-model="sessionData.generalObservation" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Linguagem não verbal do paciente</label>
                  <textarea v-model="sessionData.nonVerbalLanguage" rows="2" maxlength="500"></textarea>
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
                  <textarea v-model="sessionData.referralsMade" rows="2" maxlength="500"></textarea>
                </div>
                <div class="form-row">
                  <label>Terapêutica utilizada (prescrição de exercícios, leituras, relacionamento, etc.)</label>
                  <textarea v-model="sessionData.therapeuticsUsed" rows="2" maxlength="500"></textarea>
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
        fetchAppointments() {
          console.log(`/appointments`);
          axios.get(`/appointments`)
            .then(response => {
              this.appointments = response.data;
            })
            .catch(error => {
              console.error('Erro ao buscar consultas:', error);
            });
      },
      async fetchUserData() {
          try {
              const response = await axios.get('/api/usuario'); // Ajuste a URL conforme a rota correta
              console.log(response.data);
              this.currUserData = response.data.filter(dado => dado.nome == this.selectedPatient);
              console.log(this.selectedPatient)
              console.log(this.currUserData)
          } catch (error) {
              console.error('Erro ao recuperar os dados:', error);
          }
      }
      ,
      async submitRecord() {
        try
        {
        this.sessionData.email = '';
        this.sessionData.name = this.selectedPatient;
          const response = await axios.post('/api/records', this.sessionData);
          console.log(response.value)
        } catch (error) {
          console.log(error);
        }
      }
      ,
      async fetchAppointments() {
      try {
        const response = await axios.get('/api/appointments');
        this.consultations = response.data;
        console.log(this.consultations);
        this.patients = this.consultations.filter(consultation => {
          return consultation.medic == this.userid;
        });
        console.log(this.patients);
      } catch (error) {
        console.error('Erro ao recuperar as consultas:', error);
      }
    },
    showPatientRecord (patient) {
        this.selectedPatient = patient;
        this.fetchUserData();
      }
    },

    mounted() {
      this.fetchAppointments();
    },
    components: {
      FontAwesomeIcon,
      DocumentEditor
    },
    setup() {
      const professionalName = ref('Dr. João Silva');
      const currUserData = ref([]);
      const isSidebarHidden = ref(false);
      const selectedSection = ref('Pacientes');
      const sessionData = ref({
      profession: '',
      maritalStatus: '',
      spouseName: '',
      spouseAge: '',
      spouseProfession: '',
      spouseEducation: '',
      mainComplaint: '',
      previousTherapy: '',
      patientExpectations: '',
      presentedSymptoms: '',
      physicalDiseases: '',
      psychosocialStressors: '',
      globalFunctioning: '',
      psychologicalConceptualization: '',
      previousPsychiatricDisorders: '',
      familyPsychiatricDisorders: '',
      significantDiseases: '',
      currentMedication: '',
      alternativeMedication: '',
      testApplication: '',
      complaintStart: '',
      traumaticEvents: '',
      crisisFactors: '',
      drugUse: '',
      suicideAttempt: '',
      therapeuticFocus: '',
      pregnancy: '',
      childbirth: '',
      breastfeeding: '',
      hygieneTraining: '',
      childhoodStressors: '',
      childhoodDisorders: '',
      otherComments: '',
      affectionateExperiences: '',
      sexualExperiences: '',
      firstJobs: '',
      friendshipCircles: '',
      partnerRelationships: '',
      currentSexLife: '',
      financialSituation: '',
      abortions: '',
      socialSupport: '',
      currentDisorders: '',
      mainLeisureActivities: '',
      socialLife: '',
      generalObservation: '',
      nonVerbalLanguage: '',
      professional: '',
      referralsMade: '',
      therapeuticsUsed: ''
    });

      const sessionFields = ref([
        { key: 'profession', label: 'Profissão' },
        { key: 'maritalStatus', label: 'Est. Civil' },
        { key: 'spouseName', label: 'Cônjuge (nome)' },
        { key: 'spouseAge', label: 'Cônjuge (idade)' },
        { key: 'spouseProfession', label: 'Cônjuge (profissão)' },
        { key: 'spouseEducation', label: 'Cônjuge (escolaridade)' },
        { key: 'mainComplaint', label: 'Queixa principal' },
        { key: 'previousTherapy', label: 'Fez terapia anteriormente? (citar qual e quando)' },
        { key: 'patientExpectations', label: 'Expectativas e objetivos do paciente' },
        { key: 'presentedSymptoms', label: 'Sintomas apresentados' },
        { key: 'physicalDiseases', label: 'Doenças físicas' },
        { key: 'psychosocialStressors', label: 'Estressores psicossociais' },
        { key: 'globalFunctioning', label: 'Funcionamento global' },
        { key: 'psychologicalConceptualization', label: 'Conceituação Psicológica do caso' },
        { key: 'previousPsychiatricDisorders', label: 'Transtornos psiquiátricos anteriores' },
        { key: 'familyPsychiatricDisorders', label: 'Transtornos psiquiátricos familiares' },
        { key: 'significantDiseases', label: 'Doenças importantes que teve' },
        { key: 'currentMedication', label: 'Medicação que está tomando' },
        { key: 'alternativeMedication', label: 'Medicação alternativa (chás, composto, etc)' },
        { key: 'testApplication', label: 'Aplicação de testes? se sim quando e resultado' },
      ]);

      const complaintHistoryFields = ref([
        { key: 'complaintStart', label: 'Quando se iniciou' },
        { key: 'traumaticEvents', label: 'Eventos traumáticos de vida' },
        { key: 'crisisFactors', label: 'Eventos/fatores que precipitam ou agravam crises' },
        { key: 'drugUse', label: 'Uso de drogas?' },
        { key: 'suicideAttempt', label: 'Tentativa de suicídio?' },
        { key: 'therapeuticFocus', label: 'Focos de intervenção psicoterápica' },
      ]);

      const childhoodFields = ref([
        { key: 'pregnancy', label: 'Gravidez (planejada ou não)' },
        { key: 'childbirth', label: 'Parto, intercorrências obstétricas' },
        { key: 'breastfeeding', label: 'Amamentação' },
        { key: 'hygieneTraining', label: 'Treinamento de Higiene' },
        { key: 'childhoodStressors', label: 'Estressores na infância, crises' },
        { key: 'childhoodDisorders', label: 'Outros transtornos infantis (sono, alimentação, psicomotor, gagueira, tiques, sonambulismo, aprendizagem)' },
        { key: 'otherComments', label: 'Outros comentários' }
      ]);

      const patients = ref([
        {
          id: 1, name: 'Ana Silva', email: 'ana@example.com', cpf: '123.456.789-00', phone: '123456789', birthdate: '01/01/1980',
          cep: '12345-678', street: 'Rua A, 123', complement: 'Apto 1', neighborhood: 'Bairro A', city: 'Cidade A', state: 'Estado A',
          appointmentTime: '09:00', initial: 'A'
        },
        {
          id: 2, name: 'Bruno Souza', email: 'bruno@example.com', cpf: '987.654.321-00', phone: '987654321', birthdate: '02/02/1985',
          cep: '87654-321', street: 'Rua B, 456', complement: 'Casa 2', neighborhood: 'Bairro B', city: 'Cidade B', state: 'Estado B',
          appointmentTime: '10:30', initial: 'B'
        },
        {
          id: 3, name: 'Carla Pereira', email: 'carla@example.com', cpf: '456.123.789-00', phone: '456123789', birthdate: '03/03/1990',
          cep: '56789-123', street: 'Rua C, 789', complement: 'Apto 3', neighborhood: 'Bairro C', city: 'Cidade C', state: 'Estado C',
          appointmentTime: '11:00', initial: 'C'
        },
        {
          id: 4, name: 'Daniela Almeida', email: 'daniela@example.com', cpf: '321.654.987-00', phone: '321654987', birthdate: '04/04/1995',
          cep: '43210-987', street: 'Rua D, 101', complement: 'Casa 4', neighborhood: 'Bairro D', city: 'Cidade D', state: 'Estado D',
          appointmentTime: '13:30', initial: 'D'
        },
        {
          id: 5, name: 'Eduardo Santos', email: 'eduardo@example.com', cpf: '654.987.321-00', phone: '654987321', birthdate: '05/05/1980',
          cep: '21098-765', street: 'Rua E, 202', complement: 'Apto 5', neighborhood: 'Bairro E', city: 'Cidade E', state: 'Estado E',
          appointmentTime: '15:00', initial: 'E'
        },
        {
          id: 6, name: 'Fernanda Lima', email: 'fernanda@example.com', cpf: '789.321.654-00', phone: '789321654', birthdate: '06/06/1995',
          cep: '10987-654', street: 'Rua F, 303', complement: 'Casa 6', neighborhood: 'Bairro F', city: 'Cidade F', state: 'Estado F',
          appointmentTime: '16:30', initial: 'F'
        }
      ]);

      const selectedPatient = ref(null);

      const toggleSidebar = () => {
        isSidebarHidden.value = !isSidebarHidden.value;
      };

      const selectSection = (section) => {
        selectedSection.value = section;
        selectedPatient.value = null; // Clear selected patient when switching sections
      };

      const saveSession = () => {
        console.log('Session data saved:', sessionData.value);

        // Save sessionData to a database or store it as needed
      };

      return {
        professionalName,
        isSidebarHidden,
        toggleSidebar,
        patients,
        selectedPatient,
        //showPatientRecord,
        selectedSection,
        selectSection,
        sessionData,
        sessionFields,
        saveSession,
        complaintHistoryFields,
        childhoodFields
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
