#!/bin/bash

echo "🚀 Iniciando a configuração do projeto Laravel..."

# Atualiza os pacotes do sistema
sudo apt update && sudo apt upgrade -y

# Instala dependências do Laravel
echo "📦 Instalando dependências do Laravel..."
composer install
npm install && npm run build

# Copia o arquivo .env de exemplo e gera a chave
if [ ! -f .env ]; then
    cp .env.example .env
    echo "🔑 Arquivo .env criado."
fi

# Define permissões
echo "🔧 Ajustando permissões..."
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# Gera a chave do Laravel
php artisan key:generate

# Execulta Migrate DB
php artisan migrate

# Configuração do Apache
echo "🌐 Configurando o Apache..."
APACHE_CONF="/etc/apache2/sites-available/book.conf"
if [ ! -f "$APACHE_CONF" ]; then
    sudo bash -c "cat > $APACHE_CONF" <<EOL
<VirtualHost *:80>
    ServerAdmin admin@localhost
    DocumentRoot /var/www/book-manager/public
    ServerName book-api.local

    <Directory /var/www/book-manager/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOL
    echo "✅ Arquivo book.conf criado."
fi

# Ativa o site no Apache e reinicia o serviço
sudo a2ensite book.conf
sudo systemctl restart apache2
sudo systemctl enable apache2

echo "✅ Configuração concluída! 🚀"
