<template>
    <div class="new-page">
      <div :class="['sidebar', { hidden: isSidebarHidden }]">
        <div class="logo-container">
          <div class="logo">Instituto <span class="psi">Psi</span></div>
        </div>
        <div class="user-info">
          <font-awesome-icon class="user-icon" icon="user-circle" />
          <p>Bem-vindo, {{ professionalName }}</p>
        </div>
        <nav class="nav-menu">
          <ul>
            <li @click="selectSection('Documentos')" :class="{ active: selectedSection === 'Documentos' }">Contatos</li>
            <li @click="logout">Sair</li>
          </ul>
        </nav>
      </div>

      <div class="main-content">
        <button @click="toggleSidebar" class="toggle-button">
          <font-awesome-icon :icon="[isSidebarHidden ? 'arrow-right' : 'arrow-left']" />
        </button>

        <div v-if="selectedSection === 'Contatos'">
            <h2 class="section-title">Contatos</h2>
            <p>Aqui você pode visualizar e gerenciar os contatos.</p>
            <DocumentEditor />
          </div>
        </div>
      </div>
  </template>

  <script>
  import { ref } from 'vue';
  import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
  import { library } from '@fortawesome/fontawesome-svg-core';
  import { faUserCircle, faArrowLeft, faArrowRight } from '@fortawesome/free-solid-svg-icons';
  import DocumentEditor from '../Components/DocumentEditor.vue';


  library.add(faUserCircle, faArrowLeft, faArrowRight);

  export default {
    methods:{
        logout() {
            this.$inertia.post('/logout');
        }
    },
    components: {
      FontAwesomeIcon,
      DocumentEditor
    },
    setup() {
      const professionalName = ref('Dr. João Silva');
      const isSidebarHidden = ref(false);
      const selectedSection = ref('Contatos');

      
      const toggleSidebar = () => {
        isSidebarHidden.value = !isSidebarHidden.value;
      };

      const showPatientRecord = (patient) => {
        selectedPatient.value = { ...patient };
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
        showPatientRecord,
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
