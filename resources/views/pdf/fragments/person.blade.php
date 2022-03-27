<h1>Заявка № {{$people->id}} (Уникальный идентификатор {{$people->uuid}})</h1>
<h4>Тип заявки {{$people->type==0?"Заявка на поиск":"Анкета человека"}}</h4>
<h5>Дата добаваления {{\Carbon\Carbon::parse($people->created_at)->toDateTimeString()}}</h5>
<h5>В поиске с {{ \Carbon\Carbon::parse($people->searched_from)->toDateTimeString()}}</h5>
<table>
    <thead>
    <tr>
        <th style="text-align: left;">Поле</th>
        <th style="text-align: left;">Значение</th>
    </tr>

    </thead>
    <tbody>

    <tr>
        <td>Фамилия</td>
        <td>{{ $people->tname ?? "-" }}</td>
    </tr>

    <tr>
        <td>Имя</td>
        <td>{{ $people->fname ?? "-" }}</td>
    </tr>

    <tr>
        <td>Отчество</td>
        <td>{{ $people->sname ?? "-" }}</td>
    </tr>

    <tr>
        <td>Дата рождения</td>
        <td>{{ $people->birth ?? "-"}}</td>
    </tr>

    <tr>
        <td>Возраст от</td>
        <td>{{ $people->age_from ?? "-"}}</td>
    </tr>

    <tr>
        <td>Возраст до</td>
        <td>{{ $people->age_to ?? "-"}}</td>
    </tr>

    <tr>
        <td>Контактная информация</td>
        <td>
            <ul>
                @if(!empty($people->phones))
                    @foreach($people->phones as $phone)
                        <li>{{$phone["phone"]?? "-"}} ({{$phone["description"]?? "-"}})</li>
                    @endforeach
                @endif
            </ul>
        </td>
    </tr>

    <tr>
        <td>Пол</td>
        <td>{{ $people->sex ? "Женщина":"Мужчина" }}</td>
    </tr>

    <tr>
        <td>Город</td>
        <td>{{ $people->city?? "-" }}</td>
    </tr>

    <tr>
        <td>Район</td>
        <td>{{ $people->region ?? "-"}}</td>
    </tr>

    <tr>
        <td>Адрес</td>
        <td>{{ $people->address ?? "-"}}</td>
    </tr>

    <tr>
        <td>История человека</td>
        <td>{{ $people->story ?? "-"}}</td>
    </tr>

    <tr>
        <td>Описание</td>
        <td>{{ $people->description?? "-" }}</td>
    </tr>

    @if ($people->type==1)

        <tr>
            <td>Номер феникс</td>
            <td>{{ $people->phoenix_num?? "-" }}</td>
        </tr>


        <tr>
            <td>Почта</td>
            <td>{{ $people->email?? "-" }}</td>
        </tr>

        <tr>
            <td>Паспортные данные</td>
            <td>{{ $people->passport?? "-" }}</td>
        </tr>

        <tr>
            <td>Место эвакуации</td>
            <td>{{ $people->evacuation_place?? "-" }}</td>
        </tr>
    @endif

    </tbody>
</table>
<hr>
