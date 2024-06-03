<template>
    <div>
      <h3>Editor de Documentos</h3>
      <quill-editor
        v-model="documentContent"
        :options="editorOptions"
      ></quill-editor>
      <div>
        <button @click="downloadEncaminhamentos" class="download-button">Encaminhamentos</button>
      </div>
      <div>
        <button @click="downloadAtestadoMedico" class="download-button">Atestado Médico</button>
      </div>
    </div>
  </template>

  <script>
  import encaminhamentosPdf from '@/Pages/document/encaminhamentos.pdf';
  import atestadoMedicoPdf from '@/Pages/document/atestado_medico.pdf';
  import { QuillEditor } from 'vue-quill-editor';
  import 'quill/dist/quill.core.css';
  import 'quill/dist/quill.snow.css';
  import 'quill/dist/quill.bubble.css';

  export default {
    components: {
      QuillEditor
    },
    data() {
      return {
        documentContent: '<p>Este é o template do documento. Modifique como desejar.</p>',
        editorOptions: {
          theme: 'snow'
        }
      };
    },
    methods: {
      downloadEncaminhamentos() {
        const element = document.createElement('a');
        element.href = encaminhamentosPdf;
        element.download = 'encaminhamentos.pdf';
        document.body.appendChild(element);
        element.click();
        document.body.removeChild(element);
      },
      downloadAtestadoMedico() {
        const element = document.createElement('a');
        element.href = atestadoMedicoPdf;
        element.download = 'atestado_medico.pdf';
        document.body.appendChild(element);
        element.click();
        document.body.removeChild(element);
      }
    }
  };
  </script>

  <style scoped>
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
