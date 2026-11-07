<x-mail::message>
Hello {{$user->name  }}

تم اضافه بوست جديد بواسطه {{ $post->user->name }}
وعنوان البوست هو {{ $post->title }}

<x-mail::button :url="url('/')">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
