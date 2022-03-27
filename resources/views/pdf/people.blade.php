<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Документ списка заявок</title>
</head>
<body>
@if(count($peoples)>0)
    @foreach($peoples as $people)
        @include("pdf.fragments.person",["people"=>$people])
    @endforeach
@else
    <p>Ошибка генерции PDF-документа</p>
@endif
</body>
</html>
