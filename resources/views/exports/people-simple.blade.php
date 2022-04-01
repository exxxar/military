<table>
    <thead>
    <tr>
        <th style="width:150px;">Фамилия</th>
        <th style="width:150px;">Имя</th>
        <th style="width:150px;">Отчество</th>

        <th style="width:150px;">Номера телефонов</th>

        <th style="width:150px;">Город</th>
        <th style="width:150px;">Район</th>
        <th style="width:150px;">Адрес</th>

        <th style="width:150px;">Описание</th>

        <th style="width:150px;">В поиске с</th>


    </tr>

    </thead>
    <tbody>
    @foreach($peoples as $people)
        <tr>
            <td style="width:150px;">{{ $people->tname ?? "-" }}</td>
            <td style="width:150px;">{{ $people->fname ?? "-"}}</td>
            <td style="width:150px;">{{ $people->sname ?? "-"}}</td>

            <td style="width:150px;">
                <ul>
                    @if(!empty($people->phones))
                        @foreach($people->phones as $phone)
                            <li>{{$phone["phone"]?? "-"}} ({{$phone["description"]?? "-"}})</li>
                        @endforeach
                    @endif
                </ul>
            </td>


            <td style="width:150px;">{{ $people->city?? "-" }}</td>
            <td style="width:150px;">{{ $people->region ?? "-"}}</td>
            <td style="width:150px;">{{ $people->address ?? "-"}}</td>

            <td style="width:150px;">{{ $people->description?? "-" }}</td>


            @if (!is_null($people->searched_from))
                <td style="width:150px;">{{ \Carbon\Carbon::parse($people->searched_from)->toDateTimeString()}}</td>
            @else
                <td style="width:150px;">не указано</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>

