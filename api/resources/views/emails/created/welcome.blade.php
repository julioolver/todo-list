@component('mail::message')
# Boas Vindas

Seja muito bem vindo a nossa plataforma 🙂

@component('mail::button', ['url' => config('app.url')])
Acessar o Site
@endcomponent

Obrigado,
{{ config('app.name') }}
@endcomponent