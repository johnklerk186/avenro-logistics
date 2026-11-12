<x-mail::message>
# New Contact Form Submission

**From:** {{ $name }}
**Email:** {{ $email }}
**Phone:** {{ $phone }}
**Service:** {{ $service }}
**Subject:** {{ $subject }}

{{ $messageContent }}

<x-mail::button :url="config('app.url')">
Open Avenro Logistics Admin
</x-mail::button>

Thanks,<br>
{{ config('app.name', 'Avenro Logistics') }}
</x-mail::message>
