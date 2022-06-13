<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h2>Bitrix-api MVC template</h2>
    <p>Апи на Bitrix</p>

    <h2>Установка</h2>
<p>Расположить исходный код в любой части сайта. Настроить роуты по пути Config/route.php
    Если распологать в другой части проекта, отличной от корневой директории, прописать правила в urlwrite</p>
<pre>
    array (
'CONDITION' => '#^/api/#',
'RULE' => '',
'ID' => '',
'PATH' => '/api/app.php',
'SORT' => 100,
),
</pre>
</body>
</html>