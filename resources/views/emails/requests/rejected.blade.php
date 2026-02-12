@component('mail::message')
# Bonjour {{ $name }},

Nous vous informons que votre demande ({{ $type }}) a été **refusée**.

**Message reçu :**
{{ $messageText }}

Merci de votre compréhension.

Cordialement,
**L’équipe Admin**
@endcomponent

<script>
    document.querySelector('.message').style.opacity = '1';
</script>
