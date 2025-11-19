***COCTELEANDO***

***Cocteleando es una aplicacion web que está pensada para unir una comunidad de Bartenders/Barmaids donde podrán:***
***- Aprender de recetas de cócteles clasicos que tiene la aplicación.***
***- Aprender de recetas de cócteles que otros colegas hayan creado y quieran compartir para que tú la puedas usar.***
***- Regristrar tambíen tus creaciones que quieras compartir con la comunidad para que puedan ser realizados al rededor del mundo.***

  **Funcionalidades:**
  
  Autenticacion con Laravel Breeze
    - Registro
    - Login
    - Restablecimiento de contraseña vía mail personalizado
  Gestíon de Cócteles:
    - Vistas personalizadas mediante componentes Blade
    - CRUD completo (siempre y cuando sean cócteles creados por tí)
    - Podrás ordenarlos alfabéticamente, los tuyos primero o los tuyos despues
  Gestión de ingredientes:
    - En una unica vista personalizada podrás realizar el:
    - CRUD completo (siempre y cuando sean creados por tí y no estén usandose en cocteles(ni tuyos ni de un colega)


  **Tecnologias utilizadas:**
  - PHP 8+
  - Laravel 11
  - Blade components
  - HTML / Tailwind CSS
  - My SQL
  - Laravel Breeze
  - Mailtrap (para pruebas de correo)

    
 **REQUISITOS:**
 Deberás tener instalado:
   - PHP 8.2+
   - Composer
   - MySQL / MariaDB
   - Node.js + npm
   - Git
 

 **INSTALACIÓN:**

  1. Clona el repositorio:
       git clone https://github.com/Cristhian-valenci/Sprint4.git
       cd Sprint4

  2. Instala dependencias:
       composer install
       npm install
       npm run dev

  3. Genera el archivo .env
      cp .env.example .env

  4. Configura la base de datos en tu archivo .env
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=cocteleando
      DB_USERNAME=root
      DB_PASSWORD=

  5. Configurar Mailtrap (Opcional)
      MAIL_MAILER=smtp
      MAIL_HOST=sandbox.smtp.mailtrap.io
      MAIL_PORT=2525
      MAIL_USERNAME=354f892f46cc34
      MAIL_PASSWORD=eca5b443f62c50
      MAIL_ENCRYPTION=null
      MAIL_FROM_ADDRESS="no-reply@cocteleando.com"
      MAIL_FROM_NAME="Cocteleando"

 6. Puedes cambiar los mensajes de la web a castellano (Opcional)
      APP_LOCALE=es

 7. Genera la clave de la app
      php artisan key:generate

 8. Ejecuta migraciones y seeders
      php artisan migrate --seed

 9. Inicia el servidor backend
      php artisan serve

 10. Inicia el servidor Vite (Frontend)
      npm run dev

 **Finalmente ya puedes acceder a la aplicacion!**
      http://localhost:8000



**AUTOR:**
Cristhian Valenci
email: cristhianvalenci22@gmail.com
GitHub: https://github.com/Cristhian-Valenci

    
