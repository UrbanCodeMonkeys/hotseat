<!doctype html>
<html ng-app="hotseat">
<head>
	<link rel="stylesheet" href="/assets/css/style.css">
	<link rel="stylesheet" href="/assets/css/responsive.css">

    <script src="/components/angular/angular.js"></script>
    <script src="/components/angular-route/angular-route.js"></script>
    <script src="/components/angular-ui-router/release/angular-ui-router.js"></script>

    <script src="/assets/js/app/app.js"></script>
    <script src="/assets/js/app/week/controller.js"></script>
</head>
<body>
	<header>
        <div class="container">
            <div class="col12">
    		  Hotseat
            </div>
        </div>
	</header>
    <div ui-view></div>
</body>
</html>