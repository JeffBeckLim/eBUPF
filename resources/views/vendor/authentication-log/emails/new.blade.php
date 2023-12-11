@component('mail::message')
# Hello!

Your eBUPF account logged in from a new browser.

> **Account:** {{ $account->email }}<br>
> **Time:** {{ $time->toCookieString() }}<br>
> **IP Address:** {{ $ipAddress }}<br>
> **Browser Used:** {{ $browserName }}<br>
> **Device Used:** {{ $platformName }}<br>

If this was you, you can ignore this alert. If you suspect any suspicious activity on your account, please change your password.

Regards,<br>eBUPF Team
@endcomponent
