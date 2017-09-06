@component('mail::message')
# Download this file before it expired


@component('mail::button', ['url' => $urlDownload])
Download File
@endcomponent

Thanks,<br>
{{ config('PMPTADL - File Transfer') }}
@endcomponent
