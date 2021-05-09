<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Credenciales de Usuario</title>
</head>
<body>
    <h2>Saludos {{strtoupper($name)}},</h2>
    <p>Se ha creado una cuenta asociada al correo {{$email}} y a la cédula {{$cedula}}, por seguridad recomendamos cambiar la contraseña al iniciar sesión.
        <br/>
       <strong>Nombre de usuario:</strong> {{$username}}
        <br/>
        <strong>Contraseña:</strong> {{$password}}
    </p>
    <h3>Atentamente,<br>
        {{ config('app.name') }}
    </h3>
</body>
</html>