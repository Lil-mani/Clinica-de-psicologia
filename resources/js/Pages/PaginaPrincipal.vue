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
        <p>Muitas pessoas que buscam ajuda estão enfrentando desafios emocionais, como ansiedade, depressão, estresse, esgotamento profissional ou conflitos internos que impactam diretamente suas vidas diárias. Se você se identifica com essas situações, saiba que não está sozinho.</p>
        <p>Como especialistas em diversas abordagens psicológicas, incluindo a Terapia Cognitivo-Comportamental (TCC), estamos aqui para ajudar você a cuidar do seu bem-estar emocional. Nosso objetivo é ensinar você a lidar melhor com seus pensamentos e emoções, promovendo comportamentos mais saudáveis em sua vida.</p>
        <p>Com intervenções adaptadas às suas necessidades, vamos explorar juntos caminhos para uma vida mais equilibrada e significativa. A mudança é possível, e estamos aqui para auxiliar você em cada etapa do processo.</p>
        <p>Muitos dos nossos clientes expressam frustração ao tentar lidar com suas emoções, levando a uma sensação de impotência e desesperança. Entendemos o quão desafiador pode ser enfrentar esses problemas sozinho e o quanto isso pode afetar todos os aspectos da sua vida.</p>
        <p>Para ajudar você nessa etapa de enfrentamento, nossas sessões utilizam abordagens baseadas em evidências, como a Terapia Cognitivo-Comportamental (TCC), conhecida por sua eficácia comprovada. Focada em resultados duradouros, essa abordagem oferece uma jornada personalizada e adaptada às suas necessidades específicas, rumo a uma transformação significativa no enfrentamento de desafios emocionais.</p>
        <p>Trabalharemos juntos para identificar padrões de pensamentos negativos, explorar emoções profundas e comportamentos associados às suas dificuldades, e desenvolver habilidades práticas para enfrentar os desafios do dia a dia. A Terapia Cognitivo-Comportamental proporciona uma compreensão profunda dos seus pensamentos e emoções, além de oferecer ferramentas concretas para criar mudanças duradouras.</p>
        <p>Não adie mais a sua busca por bem-estar. Entre em contato conosco agora para dar o primeiro passo em direção a uma transformação positiva.</p>
        <p>Queremos ajudar você a construir uma vida mais leve e mais feliz.</p>
      </div>

      <div v-if="currentSection === 'depoimentos'" class="section">
    <h2>Depoimentos</h2>
    <div class="testimonial-container">
        <div class="testimonial">
            <p>"A qualidade do serviço oferecido foi excepcional! Estou muito satisfeito com o resultado final e recomendo a todos que buscam profissionalismo e eficiência."</p>
            <cite>— João Martins, Cliente</cite>
        </div>
        <div class="testimonial">
            <p>"Fiquei impressionada com a atenção aos detalhes e o atendimento personalizado. A equipe foi super atenciosa e resolveu todas as minhas dúvidas com paciência e dedicação."</p>
            <cite>— Maria Silva, Cliente</cite>
        </div>
        <div class="testimonial">
            <p>"Excelente trabalho! O projeto foi entregue antes do prazo e superou todas as minhas expectativas. Sem dúvida, uma das melhores experiências que já tive!"</p>
            <cite>— Lucas Pereira, Cliente</cite>
        </div>
    </div>
    <p>Depoimentos dos clientes...</p>
</div>


      <div v-if="currentSection === 'servicos'" class="section">
        <h2>Serviços</h2>
        <p>No Instituto Psi, oferecemos uma variedade de serviços psicológicos para atender às necessidades de nossos clientes. Cada serviço é projetado para proporcionar suporte emocional e desenvolver estratégias práticas para a resolução de problemas. Nossos serviços incluem:</p>
        <ul>
          <li><strong>Psicoterapia Individual:</strong> Atendimento personalizado para adultos e adolescentes que buscam apoio para lidar com questões emocionais e comportamentais.</li>
          <li><strong>Psicoterapia de Casal:</strong> Terapia voltada para casais que desejam melhorar a comunicação, resolver conflitos e fortalecer o relacionamento.</li>
          <li><strong>Psicoterapia Familiar:</strong> Intervenção terapêutica que envolve todos os membros da família para resolver problemas relacionais e melhorar a dinâmica familiar.</li>
          <li><strong>Atendimento Psicológico Infantil:</strong> Apoio especializado para crianças enfrentando dificuldades emocionais, comportamentais ou de desenvolvimento.</li>
          <li><strong>Aconselhamento para Adolescentes:</strong> Suporte para jovens lidarem com os desafios típicos da adolescência, incluindo questões escolares, sociais e emocionais.</li>
          <li><strong>Orientação Profissional e de Carreira:</strong> Ajuda para identificar habilidades, interesses e objetivos de carreira, facilitando decisões profissionais bem informadas.</li>
          <li><strong>Avaliação Psicológica:</strong> Realização de testes e avaliações para diagnóstico de condições psicológicas e elaboração de planos de tratamento adequados.</li>
          <li><strong>Grupos Terapêuticos:</strong> Sessões em grupo que oferecem suporte mútuo e troca de experiências entre pessoas com desafios semelhantes.</li>
        </ul>
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
            <input type="text" v-model="formData.name" placeholder="Nome" id="name" />
            <input type="text" v-model="formData.surname" placeholder="Sobrenome" id="surname" />
          </div>
          <div class="form-row">
            <input type="email" v-model="formData.email" placeholder="Email" id="email" />
          </div>
          <div class="form-row">
            <textarea v-model="formData.message" placeholder="Mensagem" id="message"></textarea>
          </div>
          <button type="submit">Enviar</button>
        </form>
      </div>
    </div>

    <footer class="footer">
      <div class="footer-content">
        <div class="footer-logo">
          <div class="logo">Instituto <span class="psi">Psi</span></div>
        </div>
        <div class="footer-contact">
          <h3>Contatos</h3>
          <p>Telefone: (11) 1234-5678</p>
          <p>Email: contato@institutopsi.com</p>
          <p>Endereço: Rua Exemplo, 123</p>
        </div>
        <div class="footer-social">
          <h3>Siga-nos</h3>
          <div class="social-icons">
            <font-awesome-icon class="icon" icon="instagram" />
            <font-awesome-icon class="icon" icon="facebook" />
            <font-awesome-icon class="icon" icon="twitter" />
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';
export default {
  data() {
    return {
      currentSection: 'sobre-nos', // Seção padrão
      formData: {
        name: '',
        surname: '',
        email: '',
        message: ''
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
      this.sendMail();
      axios.post('/api/contacts', this.formData)
        .then(response => {
          alert('Mensagem enviada com sucesso!');
          // Limpar o formulário após o envio
          this.formData = { name: '', surname: '', email: '', message: '' };
        })
        .catch(error => {
          console.error('Erro ao enviar mensagem:', error);
          alert('Erro ao enviar a mensagem, tente novamente.');
        });

    },
    async sendMail() {
        try {
            const response = axios.put('/api/mail', this.formData);
        } catch (error) {
            console.error('Erro ao mandar email:',error);
        }
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
  font-weight: 300;
}
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #35424a;
  padding: 15px 30px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  position: fixed;
  width: 100%;
  top: 0;
  z-index: 1000;
}
.logo {
  font-size: 24px;
  color: #fff;
  font-weight: bold;
}
.logo .psi {
  color: #77c9d4;
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
  color: #fff;
  text-decoration: none;
  transition: color 0.3s;
}
.navbar ul li a:hover {
  color: #77c9d4;
}
.navbar .login-button {
  background-color: #77c9d4;
  color: #fff;
  padding: 8px 15px;
  border-radius: 5px;
  text-decoration: none;
  transition: background-color 0.3s;
}
.navbar .login-button:hover {
  background-color: #76e4c1;
}
.content {
  padding-top: 100px; /* Ajuste conforme necessário */
  min-height: calc(100vh - 100px - 120px); /* Altura mínima para garantir que o footer fique no final da página */
}
.section {
  padding: 60px 30px;
}
.section h2 {
  font-size: 36px;
  margin-bottom: 20px;
  color: #35424a;
}
.section p {
  font-size: 18px;
  line-height: 1.6;
  margin-bottom: 20px;
}
.section ul {
  list-style-type: none;
  padding: 0;
}
.section ul li {
  font-size: 18px;
  line-height: 1.6;
  margin-bottom: 10px;
}
.section ul li strong {
  color: #35424a;
}
.contato {
  background-color: #e3e3e3;
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
  margin-right: 10px;
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
  background-color: #35424a;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}
button:hover {
  background-color: #47657a;
}
.footer {
  background-color: #35424a;
  color: #fff;
  padding: 20px 20px;
  text-align: center;
  width: 100%;
  position: relative;
  bottom: 0;
}
.footer-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 1200px;
  margin: 0 auto;
  flex-wrap: wrap;
}
.footer-logo .logo {
  font-size: 24px;
  font-weight: bold;
}
.footer-logo .logo .psi {
  color: #77c9d4;
}
.footer-contact, .footer-social {
  text-align: left;
}
.footer-contact h3, .footer-social h3 {
  font-size: 18px;
  margin-bottom: 10px;
}
.footer-contact p, .footer-social .social-icons .icon {
  margin-bottom: 5px;
}
.footer-social .social-icons {
  display: flex;
  justify-content: flex-start;
}
.footer-social .social-icons .icon {
  margin-right: 15px;
  font-size: 24px;
  transition: color 0.3s;
}
.footer-social .social-icons .icon:hover {
  color: #77c9d4;
}
</style>
