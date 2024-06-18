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
            <li @click="selectSection('Novos Contatos')" :class="{ active: selectedSection === 'Novos Contatos' }">Novos Contatos</li>
            <li @click="selectSection('Consultas')" :class="{ active: selectedSection === 'Consultas' }">Consultas</li>
            <li @click="logout">Sair</li>
          </ul>
        </nav>
      </div>

      <div class="main-content">
        <button @click="toggleSidebar" class="toggle-button">
          <font-awesome-icon :icon="[isSidebarHidden ? 'arrow-right' : 'arrow-left']" />
        </button>

        <div v-if="selectedSection === 'Novos Contatos'">
        <h2 class="section-title">Novos Contatos</h2>
        <ul>
            <li v-for="contact in contacts" :key="contact.id" class="contact-item">
                <div class="contact-block">
                    <!-- Conteúdo e botão no mesmo nível usando flexbox -->
                    <div class="contact-content">
                        <p><strong>Nome:</strong> {{ contact.name }} {{ contact.surname }}</p>
                        <p><strong>Email:</strong> {{ contact.email }}</p>
                        <p><strong>Mensagem:</strong> {{ contact.message }}</p>
                    </div>
                    <button @click="showModal(contact)" class="register-btn">Registrar como Usuário</button>
                </div>
            </li>
        </ul>
    </div>

        <div v-if="selectedSection === 'Consultas'" class="section">
          <h2>Consultas de hoje</h2>
          <p>Aqui é possível ver as consultas marcadas para o dia de hoje!</p>
          <table class="historico-table">
            <thead>
              <tr>
                <th>Profissional</th>
                <th>Data</th>
                <th>Notificar</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="consultaHoje in consultas" :key="consultaHoje.id">
                <td>{{ consultaHoje.nome }}</td>
                <td>{{ consultaHoje.time }}</td>
                <td><button @click="notificar(consultaHoje.medic,consultaHoje)">Notificar profissional</button></td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- Modal -->
        <div v-if="modalVisible" class="modal">
    <form @submit.prevent="submit" class="modal-form">
      <!-- Grupo de Informações Pessoais -->
      <fieldset>
        <legend>Informações Pessoais</legend>
        <div class="form-row">
          <div class="form-column">
            <label for="name">Nome:</label>
            <input id="name" type="text" v-model="form.name" placeholder="Seu nome" required />
          </div>
          <div class="form-column">
            <label for="surname">Sobrenome:</label>
            <input id="surname" type="text" v-model="form.surname" placeholder="Seu sobrenome" required />
          </div>
        </div>
        <div class="form-row">
          <div class="form-column">
            <label for="dob">Data de Nascimento:</label>
            <input id="dob" type="date" v-model="form.dob" required />
          </div>
          <div class="form-column">
            <label for="telefone">Telefone:</label>
            <input id="telefone" type="text" v-model="form.telefone" placeholder="(xx) xxxx-xxxx" />
          </div>
        </div>
      </fieldset>

      <!-- Grupo de Endereço -->
      <fieldset>
        <legend>Endereço</legend>
        <div class="form-row">
          <div class="form-column">
            <label for="cep">CEP:</label>
            <input id="cep" type="text" v-model="form.cep" placeholder="00000-000" @blur="fetchAddress" required />
          </div>
          <div class="form-column">
            <label for="logradouro">Logradouro:</label>
            <input id="logradouro" type="text" v-model="form.logradouro" required />
          </div>
        </div>
        <div class="form-row">
          <div class="form-column">
            <label for="bairro">Bairro:</label>
            <input id="bairro" type="text" v-model="form.bairro" required />
          </div>
          <div class="form-column">
            <label for="localidade">Localidade:</label>
            <input id="localidade" type="text" v-model="form.localidade" required />
          </div>
        </div>
        <div class="form-row">
          <div class="form-column">
            <label for="uf">UF:</label>
            <input id="uf" type="text" v-model="form.uf" required />
          </div>
          <div class="form-column">
            <label for="complemento">Complemento:</label>
            <input id="complemento" type="text" v-model="form.complemento" />
          </div>
        </div>
      </fieldset>

      <!-- Grupo de Senha -->
      <fieldset>
        <legend>Credenciais</legend>
        <div class="form-row">
          <div class="form-column">
            <label for="password">Senha:</label>
            <input id="password" type="password" v-model="form.password" placeholder="Crie uma senha" required />
          </div>
          <div class="form-column">
            <label for="password_confirmation">Confirmar Senha:</label>
            <input id="password_confirmation" type="password" v-model="form.password_confirmation" placeholder="Confirme a senha" required />
          </div>
        </div>
      </fieldset>

      <!-- Botões de Ação -->
      <div class="flex items-center justify-between mt-4">
        <button type="button" class="modal-close" @click="modalVisible = false">Fechar</button>
        <button type="submit" class="modal-submit">Registrar</button>
      </div>
    </form>
  </div>
        </div>
      </div>
  </template>

  <script>
  import { ref } from 'vue';
  import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
  import { library } from '@fortawesome/fontawesome-svg-core';
  import { Head, Link, useForm } from '@inertiajs/vue3';
  import { faUserCircle, faArrowLeft, faArrowRight } from '@fortawesome/free-solid-svg-icons';
  import DocumentEditor from '../Components/DocumentEditor.vue';


  library.add(faUserCircle, faArrowLeft, faArrowRight);

  export default {
    props: {
        user: String
    },
    // data() {
    //   return {
    //     form: {
    //       name: '',
    //       email: '',
    //       password: '',
    //       password_confirmation: '',
    //       cpf: '',
    //       telefone: '',
    //       dob: '',
    //       cep: '',
    //       logradouro: '',
    //       complemento: '',
    //       bairro: '',
    //       localidade: '',
    //       uf: '',
    //       role: 'usuario'
    //     }
    //   }
    // },
    methods:{
        logout() {
            this.$inertia.post('/logout');
        },
        async notificar(id,consulta) {
            try {
                console.log(consulta);
                // const response = await axios.post(`/api/notify/${id}`,consulta);
                // alert(response.data.message);
            } catch (error) {
                console.log('Erro ao notificar:',error);
            }
        },
        async getName(id) {
            try {
                const response = await axios.get(`/api/usuarios/nome/${id}`);
                return response.data; // Assumindo que 'data' contém o nome diretamente
            } catch (error) {
                console.error('Erro ao buscar o nome:', error);
                return ''; // Retorna string vazia ou manipula o erro conforme necessário
            }
        },
        showModal(contacto) {
            this.form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        cpf: '',
        telefone: '',
        dob: '',
        cep: '',
        logradouro: '',
        complemento: '',
        bairro: '',
        localidade: '',
        uf: '',
        role: 'usuario'
        });
            this.form.email = contacto.email; // Pré-popular o campo de e-mail, se desejado
            this.form.name = contacto.name;
            this.form.surname = contacto.surname;
            this.contact = contacto.id;
            this.modalVisible = true;
        },
        async fetchAppointments() {
            try {
                const response = await axios.get('/api/appointments/today');
                const consultas = response.data;

                // Adiciona o nome a cada consulta
                const consultasComNomes = await Promise.all(
                    consultas.map(async consulta => {
                        const nome = await this.getName(consulta.medic); // Assumindo que cada consulta tem um 'userId'
                        return { ...consulta, nome }; // Retorna a consulta original com o nome adicionado
                    })
                );

                this.consultas = consultasComNomes;
                console.log(this.consultas);
            } catch (error) {
                console.log('Erro ao adquirir consultas:', error);
            }
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
      const isSidebarHidden = ref(false);
      const selectedSection = ref('Novos Contatos');
      const contacts = ref([]);
      const contact = ref(0);
      const consultas = ref([]);
      const modalVisible = ref(false);
      const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        cpf: '',
        telefone: '',
        dob: '',
        cep: '',
        logradouro: '',
        complemento: '',
        bairro: '',
        localidade: '',
        uf: '',
        role: 'usuario'
        });

      const toggleSidebar = () => {
        isSidebarHidden.value = !isSidebarHidden.value;
      };

      const resetForm = () => {
        form.value = {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            cpf: '',
            telefone: '',
            dob: '',
            cep: '',
            logradouro: '',
            complemento: '',
            bairro: '',
            localidade: '',
            uf: '',
            role: 'usuario'
        };
        };
      const selectSection = (section) => {
        selectedSection.value = section;
        fetchContacts();
      };

      const deleteContact = async () => {
        try {
            // console.log(`/api/contacts/${contact.value}`);
            const response = await axios.post(`/api/contacts/${contact.value}`);
            console.log(response.data);
        } catch (error) {
            console.log(response);
        }
      }

      // api de cep
      const fetchAddress = async () => {
        if (form.cep.length === 8) {
            try {
                const response = await axios.get(`https://viacep.com.br/ws/${form.cep}/json/`);
                if (!response.data.erro) {
                    form.logradouro = response.data.logradouro;
                    form.complemento = response.data.complemento;
                    form.bairro = response.data.bairro;
                    form.localidade = response.data.localidade;
                    form.uf = response.data.uf;
                } else {
                    alert('CEP não encontrado.');
                }
            } catch (error) {
                console.error('Erro ao buscar o CEP:', error);
                alert('Erro ao buscar o CEP.');
            }
        }
    };

      // funcao que pega os novos contatos, retorna um json
      const fetchContacts = async () => {
        try {
            // vai na rota de contatos, coleta os mesmos e atribui para contacts
            const response = await axios.get('/api/contacts');
            contacts.value = response.data;
        } catch (error) {
            console.error('Failed to fetch contacts:', error);
        }
    };
       const sendUserInfo = async () => {
            try {
                const response = await axios.put('/api/mail/userInfo', form);
                console.log(response);
            } catch (error) {
                console.log('Erro ao mandar email com os dados de login para o usuário:',error);
            }
        };
    const submit = () => {
        sendUserInfo();
            form.post(route('register'), {
                onSuccess: () => {
                    resetForm();  // Chama a função de reset após o sucesso na submissão
                    alert('Usuário registrado com sucesso!');
                    deleteContact();
                    fetchContacts();
                },
                onError: () => {
                    alert('Erro ao tentar registrar o usuário.');
                }
            });
        };
      return {
        modalVisible,
        consultas,
        isSidebarHidden,
        fetchAddress,
        fetchContacts,
        toggleSidebar,
        selectedSection,
        selectSection,
        contacts,
        form,
        submit,
        contact,
        resetForm,
        deleteContact,
        sendUserInfo
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

  .contact-item {
    border-bottom: 1px solid #ccc;
    padding: 10px 0;
}

.contact-block {
    background-color: #f9f9f9;
    border: 1px solid #e2e2e2;
    padding: 15px;
    border-radius: 8px;
    margin: 10px;
    display: flex; /* Aplica flexbox */
    align-items: center; /* Alinha verticalmente */
    justify-content: space-between; /* Espaçamento entre conteúdo e botão */
}

.contact-content {
    flex: 1; /* Ocupa todo espaço disponível exceto o necessário para o botão */
}

.register-btn {
    background-color: #474a59 ; /* Cor personalizada para o botão */
    color: #89ffdb; /* Cor do texto no botão para contraste */
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.register-btn:hover {
    background-color: #4e9489; /* Cor mais escura ao passar o mouse */
}

.modal {
  background-color: #474a59;
  color: #fff;
  padding: 20px;
  border-radius: 8px;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: auto;
  max-width: 800px;
  z-index: 1050;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  overflow: auto;
}

.modal-form {
  display: grid;
  grid-gap: 20px;
}

.form-row {
  display: flex;
  justify-content: space-between;
}

.form-column {
  flex: 1;
  margin-right: 10px;
}

.form-column:last-child {
  margin-right: 0;
}

fieldset {
  border: none;
  padding: 0;
}

legend {
  font-size: 1.2em;
  margin-bottom: 10px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="password"],
input[type="email"],
input[type="date"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
  background-color: #fff;
  color: #000; /* Cor do texto preto para garantir legibilidade */
}

.modal-close, .modal-submit {
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.modal-close {
  background-color: #ccc;
  color: #333;
}

.modal-close:hover {
  background-color: #bbb;
}

.modal-submit {
  background-color: #89ffdb;
  color: #333;
}

.modal-submit:hover {
  background-color: #76e4d4;
}
  </style>
