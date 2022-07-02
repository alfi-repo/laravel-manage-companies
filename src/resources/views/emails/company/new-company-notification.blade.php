<p>A new company has been registered into the system.<p />
<p>
    Name: {{ $name }} <br />
    Email: {{ $email ?? '(not filled)' }} <br />
    Logo: {{ $logoUrl ?? '(not filled)' }} <br />
    Website: {{ $website ?? '(not filled)' }}
</p>
<p>Timestamp {{ $time?->format('d-m-Y H:i:s') }} UTC</p>
