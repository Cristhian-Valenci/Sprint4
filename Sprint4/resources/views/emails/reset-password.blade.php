<x-mail::message>
# Hola {{ $user->name }} 🍸

Hemos recibido una solicitud para **restablecer la contraseña** de tu cuenta en **Cocteleando**.

Si realmente fuiste tú, puedes continuar haciendo clic en el siguiente botón 👇

<x-mail::button :url="$url" color="primary">
Restablecer contraseña
</x-mail::button>

---

### ⏳ Este enlace es válido durante 60 minutos.

Si **no solicitaste** este cambio, puedes ignorar este mensaje sin problema.  
Tu cuenta seguirá siendo segura.

<br>

Gracias por ser parte de **Cocteleando**,  
tu comunidad de Bartenders y Barmaids.

🍸 **El equipo de Cocteleando**

<x-slot:subcopy>
Si tienes problemas para hacer clic en el botón, copia y pega la siguiente URL en tu navegador:

**{{ $url }}**
</x-slot:subcopy>
</x-mail::message>
