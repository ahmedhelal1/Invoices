<x-mail::message>
    #Hello!
    تم اضافه فاتوره جديده

    <x-mail::button :url="''">
        عرض الفاتوره
    </x-mail::button>
    شكرا لاستخدامك برنامج الفواتير



    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
