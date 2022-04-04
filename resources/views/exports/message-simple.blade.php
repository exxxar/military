<table>
    <thead>
    <tr>
        <th style="width:150px;">Ф.И.О.</th>
        <th style="width:150px;">СМС</th>
        <th style="width:150px;">Дата отправки</th>
    </tr>

    </thead>
    <tbody>
    @foreach($messages as $message)
        <tr>
            <td style="width:250px;"><p>{{ $message->full_name ?? "-" }}</p></td>
            <td style="width:650px;"><p>{{ $message->sms ?? "-"}}</p></td>
            <td style="width:130px;">{{ \Carbon\Carbon::parse($message->created_at)->toDateTimeString()}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

