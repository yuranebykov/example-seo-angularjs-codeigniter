<html ng-app="seoApp">
<head>
    <base href="/">
    <title>Home</title>
    <link rel="stylesheet" href="/assets/css/main.css"/>
    <script>
        var gPages = <?=json_encode($pages)?>
    </script>
    <script src="/assets/js/lib/underscore.min.js"></script>
    <script src="/assets/js/lib/angular/angular.min.js"></script>
    <script src="/assets/js/lib/angular/angular-route.min.js"></script>
    <script src="/assets/js/lib/angular/angular-sanitize.min.js"></script>
    <script src="/assets/js/main.js"></script>
</head>
<body>

<div class="content">
    <ul class="navigation">
        <li ng-repeat="item in pages"><a ng-href="/{{item.id}}" ng-class="{active: item.id == page}">{{item.title}}</a></li>
    </ul>
    <div class="preview">
        <ng-view></ng-view>
    </div>
</div>

<!-- Розробка інструмент -->
<script type='text/javascript' id="__bs_script__">
    document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.2.5.3.js'><\/script>".replace("HOST", location.hostname));
</script>
</body>
</html>