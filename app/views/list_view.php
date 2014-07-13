<div class="sidebar panel" ng-hide="stage!='list'" ng-cloak>
		
	<div class="search">
		<div class="input-group">
			<div class="input-group-addon"><i class="fa fa-search"></i></div>
			<input type="search" ng-model="searchText" class="form-control" placeholder="Filter">
			<div class="input-group-addon hover" ng-click="narrow('')"><i class="fa fa-times"></i></div>
		</div>
	</div>

	<div class="chart">
		<!-- http://cmaurer.github.io/angularjs-nvd3-directives/pie.chart.html -->
		<nvd3-pie-chart
			data="sdata"
			id="pie"
			width="260"
			height="260"
			x="xFunction()"
			y="yFunction()"
			showLabels="true"
			labelType="percent"
			tooltips="true"
			color="colorFunction()"
			showLegend="false"
			donut="true"
			donutRatio=".5"
			donutLabelsOutside="true"
			>
			<svg></svg>
		</nvd3-pie-chart>
	</div>

	<p class="total">Total: <span class="money">${{total(items)}}</span></p>
	<ul class="table-mimic light">
		<li class="header">
			<span class="cell" style="width: 75px;">Spent</span>
			<span class="cell">Category</span>
		</li>
		<li ng-repeat="item in sdata" class="">
			<span class="color-bullet" ng-style="{background: colors[$index]}"></span>
			<span class="cell" style="width: 75px;">${{item.price.toFixed(2)}}</span>
			<span class="cell searchText"  ng-click="narrow(item.name)">{{item.name}}</span>
		</li>
	</ul>

</div>

<div class="main" ng-hide="stage!='list'" ng-class="{list_view: stage=='list'}" ng-cloak>

	<div class="filter_box">
		<button class="btn btn-default" ng-click="toggle('showDateFilter')" ng-class="{open: showDateFilter}"><i class="fa fa-calendar"></i></button>

		<div class="filter">
			<div class="form-group">
				<label for="month">Change Month</label>
			</div>

			<div class="form-group">
				<select id="month" ng-model="month" class="form-control" ng-change="load_items()">
					<option ng-repeat="month in months" ng-value="month">{{month}}</option>
				</select>
			</div>

			<div class="form-group">
				<input type="number" id="year" name="year" class="form-control" ng-model="year" ng-change="load_items()">
			</div>
		</div>
	</div>

	<div class="col-lg-6">

		<ul class="date_list">
			<li ng-repeat="date in dates" class="panel">
				<span class="title searchText" ng-click="narrow(date.date)">{{date.date}}</span>
				<ul class="table-mimic light">
					<li ng-repeat="item in items | filter:searchText | filter: date.date" class="animate">
						<span class="cell date">{{item.time}}</span>
						<span class="cell price">${{item.price}}</span>
						<span class="cell category searchText" ng-click="narrow(item.name)">{{item.name}}</span>
						<span class="cell description">{{item.description}}</span>
						<span class="cell buttons"><button class="delete button" ng-click="delete(item.id)"><i class="fa fa-times"></i></button></span>
					</li>
				</ul>
			</li>
		</ul>
	</div>


</div>