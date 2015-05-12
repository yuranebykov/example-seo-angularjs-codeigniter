<html>
<head>
    <title><?=$title['name']?></title>
    <link rel="stylesheet" href="/assets/css/main.css"/>
</head>
<body>

<div class="content">
    <ul class="navigation">
        <? foreach($pages as $key=>$val): ?>
            <li><a href="/<?=$val->id; ?>"><?=$val->title; ?></a></li>
        <? endforeach; ?>
    </ul>
    <div class="preview">
        <? if(isset($content)) echo $content ?>
    </div>
</div>
</body>
</html>