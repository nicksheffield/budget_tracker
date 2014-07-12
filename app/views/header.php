<!DOCTYPE html>
<html lang="en">
<head>
	<title>Budget Tracker</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700|Roboto:400,700,100">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://cdn.nmbrft.com/budget/style.css">
	<link rel="stylesheet" href="/assets/css/nv.d3.css">
</head>
<body ng-app="app" ng-controller="budgetCtrl">

	<header class="navbar navbar-static-top">
		<div class="container">
			<span class="navbar-brand">Budget Tracker</span>

			<ul>
				<li ng-click="stage='add'" ng-class="{active: stage=='add'}"><i class="fa fa-plus"></i></li>
				<li ng-click="stage='list'" ng-class="{active: stage=='list'}"><i class="fa fa-list"></i></li>
			</ul>
		</div>
	</header>

		