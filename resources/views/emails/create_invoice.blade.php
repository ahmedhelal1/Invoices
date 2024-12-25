@component('mail::message')
    # مرحباً!

    تم إضافة فاتورة جديدة بنجاح.

    شكراً لاستخدامك برنامج الفواتير.

    @component('mail::button', ['url' => route('invoicesDetails', ['id' => $invoice_id])])
        عرض الفاتورة
    @endcomponent

    شكراً لك على التعامل معنا،
    {{ config('app.name') }}
@endcomponent
