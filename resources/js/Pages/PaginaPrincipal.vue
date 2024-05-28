<template>
  <div>
    <div class="navbar">
      <div class="logo">Instituto <span class="psi">Psi</span></div>
      <ul>
        <li><a @click.prevent="currentSection = 'sobre-nos'" href="#">Sobre Nós</a></li>
        <li><a @click.prevent="currentSection = 'depoimentos'" href="#">Depoimentos</a></li>
        <li><a @click.prevent="currentSection = 'servicos'" href="#">Serviços</a></li>
        <li><a @click.prevent="currentSection = 'contato'" href="#">Contato</a></li>
      </ul>
      <a :href="loginUrl" class="login-button">Login</a>
    </div>

    <div class="content">
      <div v-if="currentSection === 'sobre-nos'" class="section">
        <h2>Sobre Nós</h2>
        <p>Informações sobre nós...</p>
      </div>

      <div v-if="currentSection === 'depoimentos'" class="section">
        <h2>Depoimentos</h2>
        <p>Depoimentos dos clientes...</p>
      </div>

      <div v-if="currentSection === 'servicos'" class="section">
        <h2>Serviços</h2>
        <p>Detalhes dos serviços oferecidos...</p>
      </div>

      <div v-if="currentSection === 'contato'" class="section contato">
        <h2>Contato</h2>
        <div class="contact-info">
          <div class="info-item">
            <font-awesome-icon class="icon" icon="map-marker-alt" />
            <span>Endereço: Rua Exemplo, 123</span>
          </div>
          <div class="info-item">
            <font-awesome-icon class="icon" icon="phone" />
            <span>Telefone: (11) 1234-5678</span>
          </div>
          <div class="info-item">
            <font-awesome-icon class="icon" icon="envelope" />
            <span>Email: contato@institutopsi.com</span>
          </div>
          <div class="info-item">
            <font-awesome-icon class="icon" icon="instagram" />
            <span>Instagram: @institutopsi</span>
          </div>
        </div>
        <form @submit.prevent="submitForm" class="contact-form">
          <div class="form-row">
            <input type="text" v-model="formData.nome" placeholder="Nome" id="nome" />
            <input type="text" v-model="formData.sobrenome" placeholder="Sobrenome" id="sobrenome" />
          </div>
          <div class="form-row">
            <input type="email" v-model="formData.email" placeholder="Email" id="email" />
          </div>
          <div class="form-row">
            <textarea v-model="formData.mensagem" placeholder="Mensagem" id="mensagem"></textarea>
          </div>
          <button type="submit">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue';

export default {
  data() {
    return {
      currentSection: 'sobre-nos', // Seção padrão
      formData: {
        nome: '',
        sobrenome: '',
        email: '',
        mensagem: ''
      }
    }
  },
  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
  },
  computed: {
    loginUrl() {
      return this.canLogin ? '/login' : '#';
    },
  },
  methods: {
    submitForm() {
      const formPayload = {
        nome: this.formData.nome,
        sobrenome: this.formData.sobrenome,
        email: this.formData.email,
        mensagem: this.formData.mensagem
      };

      // Enviar a solicitação para o back-end
      fetch('/api/contato', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(formPayload)
      })
      .then(response => response.json())
      .then(data => {
        console.log('Success:', data);
        // Limpar o formulário após o envio
        this.formData.nome = '';
        this.formData.sobrenome = '';
        this.formData.email = '';
        this.formData.mensagem = '';
      })
      .catch((error) => {
        console.error('Error:', error);
      });
    }
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
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #474a59;
  padding: 15px 30px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  position: fixed;
  width: 100%;
  top: 0;
  z-index: 1000;
}
.navbar .logo {
  font-size: 24px;
  font-weight: bold;
  color: white;
}
.navbar .logo .psi {
  color: #89ffdb;
}
.navbar ul {
  list-style: none;
  display: flex;
  margin: 0;
  padding: 0;
}
.navbar ul li {
  margin: 0 15px;
}
.navbar ul li a {
  text-decoration: none;
  color: #ffffff;
  font-weight: 600;
  cursor: pointer;
}
.navbar .login-button {
  padding: 8px 20px;
  background-color: #636b6f;
  color: #ffffff;
  text-decoration: none;
  border-radius: 5px;
  font-weight: 600;
}
.content {
  padding-top: 100px; /* Ajuste conforme necessário */
}
.section {
  padding: 60px 30px;
}
.section h2 {
  font-size: 36px;
  margin-bottom: 20px;
}
.section p {
  font-size: 18px;
  line-height: 1.6;
}
.contato {
  background-color: #cacad4;
  padding: 60px 30px;
  text-align: center;
  border-radius: 10px;
  margin: 50px auto;
  max-width: 800px;
}
.contact-info {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-bottom: 40px;
}
.info-item {
  display: flex;
  align-items: center;
  margin: 10px 0;
}
.info-item .icon {
  margin-right: 3px;
}
.contact-form {
  max-width: 600px;
  margin: 0 auto;
}
.form-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}
.form-row input, .form-row textarea {
  width: 48%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}
.form-row input[type="email"], .form-row textarea {
  width: 100%;
}
textarea {
  height: 100px;
  resize: none;
}
button {
  padding: 10px 20px;
  background-color: #474a59;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
button:hover {
  background-color: #636b6f;
}
</style>
