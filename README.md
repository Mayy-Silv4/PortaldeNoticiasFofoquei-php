# 💅 Fofoquei

> “Não contamos, só divulgamos.”

O **Fofoquei** é um portal de notícias estilo fofoca desenvolvido em PHP, com sistema de login, cadastro, publicação de notícias, categorias e integração com clima em tempo real. Também possui modo escuro/claro e controle de usuários.

---

## 🚀 Funcionalidades

- 📰 Listagem de notícias por categorias
- 🔐 Sistema de login e cadastro
- 👤 Sistema de usuários (leitor e autor)
- 📝 Autores podem criar, editar e excluir notícias
- 📂 Categorias: Últimas, TV, Celebridades, Eventos, Música, Astrologia e Significados
- 🌤️ Integração com API de clima (OpenWeather)
- 🌙 Modo escuro/claro com salvamento automático
- 📱 Layout responsivo estilo portal de notícias
- 🔎 Visualização individual de notícias

---

## 🖥️ Tecnologias utilizadas

- PHP (Backend)
- MySQL (Banco de dados)
- HTML5
- CSS3 (Grid, Flexbox, animações)
- JavaScript (Fetch API e interações dinâmicas)
- OpenWeather API

---

## 📸 Screenshots

> Adicione suas imagens na pasta `/screenshots`

### 🏠 Página inicial
<img width="1881" height="892" alt="image" src="https://github.com/user-attachments/assets/d7b85f99-f330-45ce-80ce-bc6e9b05a715" />


### 📰 Notícias
<img width="1899" height="878" alt="image" src="https://github.com/user-attachments/assets/1168c908-b0f2-4b18-adb5-83cd34758879" />


### 🔐 Login
<img width="1825" height="858" alt="image" src="https://github.com/user-attachments/assets/57765ec8-71bf-48e9-8651-b20c8c57415a" />


### 📝 Cadastro
<img width="1738" height="834" alt="image" src="https://github.com/user-attachments/assets/da2e2982-d7c7-4d51-a1c5-07f50fa75e48" />

### 🌙 Modo escuro
<img width="1867" height="897" alt="image" src="https://github.com/user-attachments/assets/8d98c706-2669-4ced-b7a4-9df271993fec" />


---

## ⚙️ Como instalar e rodar o projeto

### 1. Clonar o repositório


bash
git clone https://github.com/seuusuario/fofoquei.git

### 2. Criar banco de dados

Crie um banco no MySQL chamado:

fofoquei

Importe o arquivo:

database.sql
### 3. Configurar conexão com banco

Edite:

/classes/Conexao.php

Exemplo:

private $host = "localhost";
private $dbname = "fofoquei";
private $user = "root";
private $pass = "";
4. Rodar o projeto

Use XAMPP ou similar:

http://localhost/fofoquei
🌤️ API de Clima

O projeto utiliza a OpenWeather API:

https://openweathermap.org/api

Configure sua chave no arquivo:

script.js
🔐 Tipos de usuários
Tipo	Permissão
leitor	Apenas visualizar notícias
autor	Criar, editar e excluir notícias
🌙 Modo escuro

O modo escuro:

Pode ser ativado pelo botão 🌙
Salva a preferência no navegador (localStorage)
Aplica automaticamente ao entrar no site


```
📁 Estrutura do projeto
/classes
   Conexao.php
   Noticia.php
   Usuario.php

/img
   imagens das notícias

/screenshots
   home.png
   noticias.png
   login.png
   cadastro.png
   darkmode.png

index.php
login.php
cadastro.php
verNoticia.php
script.js

```

**🚀 Melhorias futuras**

- 🔎 Sistema de busca
- ❤️ Curtidas em notícias
- 💬 Comentários
- 📊 Painel administrativo completo
- 📱 Versão mobile/app

👨‍💻 Autor

Desenvolvido por **Mayara Maciel**
