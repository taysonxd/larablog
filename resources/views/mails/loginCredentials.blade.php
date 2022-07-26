@component('mail::message')
# Estas son tus credenciales para acceder a {{ env('APP_NAME') }}

Utiliza las siguientes credenciales para acceder a tu cuenta en {{ env('APP_NAME') }}

@component('mail::table')
	| Nombre de usuario | Contraseña   |
	|:------------------|:-------------|
	| {{ $user->email }}|{{ $password}}|
@endcomponent

@component('mail::button', [ 'url' => url('login') ])
Login
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
