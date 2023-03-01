<x-mail::message>
# Introduction

    Ваш пароль: {{ $password }}

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
