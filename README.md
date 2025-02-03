# 📘 Book Manager - Instalação e Configuração

Este repositório contém um projeto Laravel para gerenciamento de livros, com a possibilidade 
adicionar editar e excluir livros, ao cadastrar e ou editar, o sistema conta com a integração 
da open library, para consultar autor e biografia de forma automatica, a pagina livros lista 
em uma tabela dinamica todos os livros ja cadastrados.
Siga as etapas abaixo para configurar o ambiente corretamente.

---

## 🔧 Requisitos Mínimos

Antes de iniciar a instalação, certifique-se de que seu ambiente atende aos seguintes requisitos:

- **Sistema Operacional:** Ubuntu 22
- **PHP:** 8.3
- **MySQL:** 8
- **Composer** e **Node.js** instalados

---

## 🚀 1. Clonando o Repositório

Antes de começar, certifique-se de que possui **Git** instalado no seu sistema.

Execute o comando abaixo para clonar o repositório:

```bash
 git clone https://github.com/higinofe/book-manager.git
```

Acesse a pasta do projeto:
```bash
 cd book-manager
```

---

## 🛠️ 2. Configuração do Ambiente

1. **Criar o arquivo `.env`**:
   
   O Laravel precisa de um arquivo de configuração `.env`. Copie o modelo padrão:
   
   ```bash
   cp .env.example .env
   ```

2. **Configurar o Banco de Dados**:
   
   No arquivo `.env`, configure as credenciais do banco de dados:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=seu_banco
   DB_USERNAME=seu_usuario
   DB_PASSWORD=sua_senha
   ```

3. **Gerar a chave da aplicação**:
   
   ```bash
   php artisan key:generate
   ```

---

## 📦 3. Executando o Script de Configuração

Antes de continuar, garanta que o script `setup.sh` tem permissão de execução:

```bash
chmod +x setup.sh
```

Agora, execute o script para instalar as dependências e configurar o Apache:

```bash
./setup.sh
```

Caso ocorra algum erro de permissão, tente rodar com `sudo`:

```bash
sudo ./setup.sh
```

---

## 🌍 4. Configuração do Host Local

Para acessar o projeto localmente, adicione a seguinte linha ao arquivo de hosts do seu sistema:

### 🖥️ Windows:
1. Abra o **Bloco de Notas** como administrador.
2. Edite o arquivo `C:\Windows\System32\drivers\etc\hosts`.
3. Adicione a seguinte linha no final:
   ```
   127.0.0.1 book-api.local
   ```
4. Salve o arquivo e feche.

### 🍏 Mac:
1. Abra o terminal e execute:
   ```bash
   sudo nano /etc/hosts
   ```
2. Adicione esta linha ao final:
   ```
   127.0.0.1 book-api.local
   ```
3. Salve o arquivo (`CTRL + X`, `Y`, `ENTER`).
4. Limpe o cache do DNS:
   ```bash
   sudo killall -HUP mDNSResponder
   ```

### 🐧 Linux:
1. Abra o terminal e execute:
   ```bash
   sudo nano /etc/hosts
   ```
2. Adicione esta linha ao final:
   ```
   127.0.0.1 book-api.local
   ```
3. Salve o arquivo (`CTRL + X`, `Y`, `ENTER`).

---

## ✅ 5. Finalizando

Acesse o projeto no navegador:
```
http://book-api.local
```

Caso ocorra algum erro, execute os seguintes comandos para limpar o cache:

```bash
php artisan cache:clear
php artisan config:clear
```

---

🎉 **Pronto! Seu projeto Laravel está configurado e pronto para uso.** 🚀

