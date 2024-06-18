```markdown
# Laravel Template

### Passo a passo
Clone o repositório criado a partir do template, entre na pasta e execute os comandos abaixo:

### Configuração do Laravel

Crie o Arquivo .env
```sh
cp .env.example .env
```

Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME=Laravel
APP_URL=http://localhost:8080

DB_PASSWORD=root
```

Suba os containers do projeto
```sh
docker compose up -d
```

Acesse o container
```sh
docker compose exec app bash
```

Instale as dependências do projeto
```sh
composer install
```

Gere a key do projeto Laravel
```sh
php artisan key:generate
```

Crie as tabelas do banco de dados e dados pre-preenchidos
```sh
php artisan migrate
php artisan db:seed
```

Saia do terminal do Docker
```sh
exit
```

### Configuração do npm
Instale as dependências do npm
```sh
npm install
```

Rode o npm
```sh
npm run dev
```

Acesse o projeto
[http://localhost:8080](http://localhost:8080)

### Configuração do Electron

Crie o diretório do projeto Electron
```sh
mkdir electron
cd electron
```

Inicie o projeto npm
```sh
npm init -y
```

Instale o Electron como dependência de desenvolvimento
```sh
npm install electron --save-dev
```

Crie o arquivo `main.js` e adicione o seguinte código:
```javascript
const { app, BrowserWindow } = require('electron');
const path = require('path');

function createWindow() {
  const mainWindow = new BrowserWindow({
    width: 800,
    height: 600,
    webPreferences: {
      preload: path.join(__dirname, 'preload.js'),
      nodeIntegration: true,
      contextIsolation: false,
    },
  });

  mainWindow.loadURL('http://localhost:8080'); // URL do seu servidor Laravel
}

app.on('ready', createWindow);

app.on('window-all-closed', () => {
  if (process.platform !== 'darwin') {
    app.quit();
  }
});

app.on('activate', () => {
  if (BrowserWindow.getAllWindows().length === 0) {
    createWindow();
  }
});
```

Crie o arquivo `preload.js` (comentado para futura utilização):
```javascript
// const { contextBridge } = require('electron');

// contextBridge.exposeInMainWorld('api', {
//     // Adicione seus métodos aqui
// });
```

Atualize o `package.json` com o script de inicialização do Electron:
```json
// preload.js

// Esse arquivo pode ficar vazio ou ser usado para expor funcionalidades ao renderer process
```

### Inicialização do Electron

Para iniciar o Electron, execute:
```sh
npm run start
```

Acesse o projeto em [http://localhost:8080](http://localhost:8080)
```
link do trello: https://trello.com/b/ctQdbn6l
