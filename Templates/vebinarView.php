<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .error {
            background-color: #c82333;
            color: white;
            padding: 15px 25px;
        }

        .vebinar__item {
            padding: 20px 30px;
        }
    </style>
</head>
<body>
<?php if (isset($arResult['ERROR'])): ?>
    <div class="error"><?php echo $arResult['MSG']; ?></div>
<?php else: ?>
    <div class="vebinar">
        <?php foreach ($arResult as $item): ?>
            <div class="vebinar__item">
                <span>Название: <?php echo $item['NAME'] ?></span><br>
                <span>Категория:<?php echo $item['VEBINAR_THEME_NAME'] ?></span><br>
                <span>Дата проведения:<?php echo $item['PROP_DATE_VALUE'] ?></span>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
</body>
</html>
