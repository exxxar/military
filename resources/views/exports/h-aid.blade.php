<table>
    <thead>
    <tr>
        <th>#</th>
        <th style="width:150px;">Индекс заявки</th>
        <th style="width:150px;">Ф.И.О.</th>
        <th style="width:150px;">Серия и номер паспорта</th>
        <th style="width:150px;">Доп. информация</th>
        <th style="width:150px;">Дата выдачи</th>
        <th style="width:150px;">Дата добавления информации</th>
    </tr>

    </thead>
    <tbody>
    @foreach($aids as $aid)
        <tr>
            <td>{{ $aid->id }}</td>
            <td style="width:150px;">{{ $aid->index??"-" }}</td>
            <td style="width:150px;">{{ $aid->full_name ?? "-" }}</td>
            <td style="width:150px;">{{ $aid->passport ?? "-"}}</td>
            <td style="width:150px;">{{ $aid->description ?? "-"}}</td>
            <td style="width:150px;">{{ \Carbon\Carbon::parse($aid->issue_at)->toDateTimeString()}}</td>
            <td style="width:150px;">{{ \Carbon\Carbon::parse($aid->created_at)->toDateTimeString()}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

