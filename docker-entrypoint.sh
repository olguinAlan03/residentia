#!/bin/bash
set -e

if [ ! -d "/var/www/html/vendor" ]; then
    echo ">>> Instalando dependencias de Composer..."
    composer install --no-dev --optimize-autoloader --working-dir=/var/www/html
    echo ">>> Composer listo."
fi

exec "$@"
