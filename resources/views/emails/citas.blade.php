@component('mail::message')
# Saludos {{$nombre_completo}},

Te recordamos que tienes una cita @if($medico) con el medico {{$medico}} @endif <br>
a las {{$hora}} el dia {{$fecha}}.

Atentamente, 
{{ config('app.name') }}
@endcomponent
