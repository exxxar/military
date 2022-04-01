<h1>Уникальный идентификатор заявки {{$people->uuid}}</h1>
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

    @isset($people->tname)
    <tr>
        <td>Фамилия</td>
        <td>{{ $people->tname ?? "-" }}</td>
    </tr>
    @endisset

    @isset($people->fname)
    <tr>
        <td>Имя</td>
        <td>{{ $people->fname ?? "-" }}</td>
    </tr>
    @endisset

    @isset($people->sname)
    <tr>
        <td>Отчество</td>
        <td>{{ $people->sname ?? "-" }}</td>
    </tr>
    @endisset

    @isset($people->birth)
    <tr>
        <td>Дата рождения</td>
        <td>{{ $people->birth ?? "-"}}</td>
    </tr>
    @endisset

    @isset($people->age_from)
    <tr>
        <td>Возраст от</td>
        <td>{{ $people->age_from ?? "-"}}</td>
    </tr>

    <tr>
        <td>Возраст до</td>
        <td>{{ $people->age_to ?? "-"}}</td>
    </tr>
    @endisset


    @if(!empty($people->phones))
    <tr>
        <td>Контактная информация</td>
        <td>
            <ul>

                    @foreach($people->phones as $phone)
                        <li>{{$phone["phone"]?? "-"}} ({{$phone["description"]?? "-"}})</li>
                    @endforeach

            </ul>
        </td>
    </tr>
    @endif

{{--    @isset($people->sex)
    <tr>
        <td>Пол</td>
        <td>{{ $people->sex ? "Женщина":"Мужчина" }}</td>
    </tr>
    @endisset--}}

    @isset($people->city)
    <tr>
        <td>Город</td>
        <td>{{ $people->city?? "-" }}</td>
    </tr>
    @endisset

    @isset($people->region)
    <tr>
        <td>Район</td>
        <td>{{ $people->region ?? "-"}}</td>
    </tr>
    @endisset

    @isset($people->address)
    <tr>
        <td>Адрес</td>
        <td>{{ $people->address ?? "-"}}</td>
    </tr>
    @endisset

    @isset($people->story)
    <tr>
        <td>История человека</td>
        <td>{{ $people->story ?? "-"}}</td>
    </tr>
    @endisset

    @isset($people->description)
    <tr>
        <td>Описание</td>
        <td>{{ $people->description?? "-" }}</td>
    </tr>
    @endisset


    @if ($people->type==1)

        @isset($people->phoenix_num)
        <tr>
            <td>Номер феникс</td>
            <td>{{ $people->phoenix_num?? "-" }}</td>
        </tr>
        @endisset

        @isset($people->email)
        <tr>
            <td>Почта</td>
            <td>{{ $people->email?? "-" }}</td>
        </tr>
        @endisset

        @isset($people->passport)
        <tr>
            <td>Паспортные данные</td>
            <td>{{ $people->passport?? "-" }}</td>
        </tr>
        @endisset

        @isset($people->evacuation_place)
        <tr>
            <td>Место эвакуации</td>
            <td>{{ $people->evacuation_place?? "-" }}</td>
        </tr>
        @endisset
    @endif

    </tbody>
</table>
<hr>
