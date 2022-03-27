<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Документ заявки</title>
</head>
<body>

@if(!is_null($people))
    @include("pdf.fragments.person",["people"=>$people])
@else
    <p>Ошибка генерции PDF-документа</p>
@endif
</body>
</html>
