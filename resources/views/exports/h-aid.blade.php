<table>
    <thead>
    <tr>
        <th>#</th>
        <th style="width:150px;">Фамилия</th>
        <th style="width:150px;">Имя</th>
        <th style="width:150px;">Отчество</th>
        <th style="width:150px;">Ф.И.О.</th>
        <th style="width:150px;">Серия и номер паспорта</th>
        <th style="width:150px;">Дата выдачи паспорта</th>
        <th style="width:150px;">Доп. информация</th>
        <th style="width:150px;">Дата выдачи гум.помощи</th>
        <th style="width:150px;">Тип гум. помощи</th>
        <th style="width:150px;">Кол-во выдано</th>
        <th style="width:150px;">Кол-во детей</th>
        <th style="width:150px;">Дата добавления информации</th>
    </tr>

    </thead>
    <tbody>
    @foreach($aids as $aid)
        <tr>
            <td>{{ $aid->id }}</td>
            <td style="width:150px;">{{ $aid->t_name??"-" }}</td>
            <td style="width:150px;">{{ $aid->f_name??"-" }}</td>
            <td style="width:150px;">{{ $aid->s_name??"-" }}</td>
            <td style="width:150px;">{{ $aid->full_name ?? "-" }}</td>
            <td style="width:150px;">{{ $aid->passport ?? "-"}}</td>
            <td style="width:150px;">{{ $aid->passport_issue_at ?? "-"}}</td>
            <td style="width:150px;">{{ $aid->description ?? "-"}}</td>
            <td style="width:150px;">{{ \Carbon\Carbon::parse($aid->issue_at)->toDateTimeString()}}</td>
            <td style="width:150px;">
                @if(!empty($aid->types))
                    @foreach($aid->types as $type)
                        <p>{{$type}}</p>
                    @endforeach
                @endif
            </td>
            <td style="width:150px;">{{ $aid->count ?? "1"}}</td>
            <td style="width:150px;">
                @if (!empty($aid->child))
                    <p>{{ count($aid->child)}}</p>
                @else
                    <p>Нет детей</p>
                @endif
            </td>
            <td style="width:150px;">{{ \Carbon\Carbon::parse($aid->created_at)->toDateTimeString()}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

