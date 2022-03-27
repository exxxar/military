<table>
    <thead>
    <tr>
        <th>#</th>
        <th style="width:150px;">Уникальный идентификатор заявки</th>
        <th style="width:150px;">Фамилия</th>
        <th style="width:150px;">Имя</th>
        <th style="width:150px;">Отчество</th>
        <th style="width:150px;">Дата рождения</th>
        <th style="width:150px;">Возраст от</th>
        <th style="width:150px;">Возраст до</th>

        <th style="width:150px;">Номера телефонов</th>

        <th style="width:150px;">Пол</th>
        <th style="width:150px;">Город</th>
        <th style="width:150px;">Район</th>
        <th style="width:150px;">Адрес</th>
        <th style="width:150px;">История человека</th>
        <th style="width:150px;">Описание</th>
        <th style="width:150px;">Тип заявки</th>
        <th style="width:150px;">Номер феникса</th>
        <th style="width:150px;">Почта</th>
        <th style="width:150px;">Пасспортные данные</th>
        <th style="width:150px;">Место эвакуации</th>
        <th style="width:150px;">В поиске с</th>


    </tr>

    </thead>
    <tbody>
    @foreach($peoples as $people)
        <tr>
            <td>{{ $people->id }}</td>
            <td style="width:150px;">{{ $people->uuid }}</td>
            <td style="width:150px;">{{ $people->fname ?? "-" }}</td>
            <td style="width:150px;">{{ $people->sname ?? "-"}}</td>
            <td style="width:150px;">{{ $people->tname ?? "-"}}</td>
            <td style="width:150px;">{{ $people->birth ?? "-"}}</td>
            <td style="width:150px;">{{ $people->age_from ?? "-"}}</td>
            <td style="width:150px;">{{ $people->age_to ?? "-"}}</td>
            <td style="width:150px;">
                <ul>
                    @if(!empty($people->phones))
                        @foreach($people->phones as $phone)
                            <li>{{$phone["phone"]?? "-"}} ({{$phone["description"]?? "-"}})</li>
                        @endforeach
                    @endif
                </ul>
            </td>

            <td style="width:150px;">{{ $people->sex ? "Мужчина":"Женщина" }}</td>
            <td style="width:150px;">{{ $people->city?? "-" }}</td>
            <td style="width:150px;">{{ $people->region ?? "-"}}</td>
            <td style="width:150px;">{{ $people->address ?? "-"}}</td>
            <td style="width:150px;">{{ $people->story ?? "-"}}</td>
            <td style="width:150px;">{{ $people->description?? "-" }}</td>
            <td style="width:150px;">{{$people->type==0?"Заявка на поиск":"Анкета человека"}}</td>
            <td style="width:150px;">{{$people->phoenix_num??"-"}}</td>
            <td style="width:150px;">{{$people->email??"-"}}</td>
            <td style="width:150px;">{{$people->passport??"-"}}</td>
            <td style="width:150px;">{{$people->evacuation_place??"-"}}</td>
            @if (!is_null($people->searched_from))
                <td style="width:150px;">{{ \Carbon\Carbon::parse($people->searched_from)->toDateTimeString()}}</td>
            @else
                <td style="width:150px;">не указано</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>

