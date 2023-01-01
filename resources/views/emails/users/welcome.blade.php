<x-mail::message>
    # Vítejte v GeniusTV

    Vaše přihlašovací údaje zákaznické zóny jsou

    jméno: {{ $username }}
    heslo: {{ $password }}


    <x-mail::panel>
        <x-mail::button :url="$link" color="success">
            Přihlášení
        </x-mail::button>
    </x-mail::panel>


    Děkuje tým
    {{ config('app.name') }}
</x-mail::message>
