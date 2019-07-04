<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>
    <link rel="stylesheet" href={{asset(url('css/jquery-confirm.min.css'))}}/>
    <link rel="stylesheet" href={{asset(url('css/font-awesome.min.css'))}}/>

    <style>
        input.ng-invalid {
            background-color: lightblue;
        }
    </style>

</head>
<body>

{{--<div ng-app="">--}}
{{--<p>Name: <input type="text" ng-model="name"></p>--}}
{{--<p ng-bind="name"></p>--}}
{{--</div>--}}
<form ng-app="app" name="myForm">
    Email:
    <input type="email" name="myAddress" ng-model="text">
    <span ng-show="myForm.myAddress.$error.email">Not a valid e-mail address.</span>
    {{--[[myForm.myAddress.$valid]]--}}
    {{--[[myForm.myAddress.$dirty]]--}}
    {{--[[myForm.myAddress.$touched]]--}}

    <div ng-init="names=['Jani','Hege','Kai']">
        <input style="background-color:[[myCol]]" ng-model="myCol" value="[[myCol]]">
        <input ng-model="f">
        <input ng-model="s">

        <p>Total in dollar: [[ f * s ]]</p>
        <p ng-bind="f * s"></p>

        <p w3-Test-Directive></p>
        <ul>
            <li ng-repeat="x in names">
                [[ x ]]
            </li>
        </ul>


    </div>
</form>

<script src="{{asset(url('js/jquery.min.js'))}}"></script>
<script src="{{asset(url('js/barcode/jquery-barcode.js'))}}"></script>
<script src='{{asset(url('js/jquery-confirm.min.js'))}}'></script>
{{--    <script src='{{asset(url('js/print/jquery.PrintArea.js'))}}'></script>--}}
<script src='{{asset(url('js/angular.min.js'))}}'></script>
{{--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>--}}

<script>
    var app = angular.module("app", []);

    app.config(function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    });
    app.controller('myCtrl', function ($scope) {
        $scope.firstName = 1;
        $scope.lastName = 2;
        $scope.sum = $scope.firstName + $scope.lastName;
    });
    app.directive("w3TestDirective", function () {
        return {
            template: "I was made in a directive constructor!"
        };
    });
</script>
</body>
</html>
