### Bitrix-api MVC template
Апи на Bitrix

### Установка
Расположить исходный код в любой части сайта. Настроить роуты по пути Config/route.php
Добавить в urlwrite правило вида
```
array (
'CONDITION' => '#^/api/#',
'RULE' => '',
'ID' => '',
'PATH' => '/api/app.php',
'SORT' => 100,
),
```