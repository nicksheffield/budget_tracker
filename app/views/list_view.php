<div class="main" ng-hide="stage!='list'" ng-cloak>

	<div class="banner">
		<div class="container">
			<div class="col-lg-12">
				<div class="search">
		
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-search"></i></div>
						<input type="search" ng-model="searchText" class="form-control" placeholder="Filter">
						<div class="input-group-addon hover" ng-click="narrow('')"><i class="fa fa-times"></i></div>
					</div>
					
				</div>
			</div>

			<div class="col-lg-3 col-md-4">
				<p class="total">Total: ${{total(items)}}</p>
				<ul class="table-mimic dark">
					<li class="header">
						<span class="cell" style="width: 75px;">Spent</span>
						<span class="cell">Category</span>
					</li>
					<li ng-repeat="item in sdata" class="animate">
						<span class="cell" style="width: 75px;">${{item.price.toFixed(2)}}</span>
						<span class="cell"  ng-click="narrow(item.name)">{{item.name}}</span>
					</li>
				</ul>
			</div>

			<!-- http://cmaurer.github.io/angularjs-nvd3-directives/pie.chart.html -->
			<div class="col-lg-9 col-md-8">
				<nvd3-pie-chart
					data="sdata"
					id="pie"
					width="550"
					height="400"
					x="xFunction()"
					y="yFunction()"
					showLabels="true"
					labelType="percent"
					tooltips="true"
					color="colorFunction()"
					showLegend="false"
					donut="true"
					donutRatio=".4"
					donutLabelsOutside="true"
					>
					<svg></svg>
				</nvd3-pie-chart>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="col-lg-12">

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

			<p class="heading">{{month}} {{year}}</p>
		</div>

		<div class="col-lg-12">
			<ul class="table-mimic light list">
				<li class="header">
					<span class="cell" style="width: 160px;">Category</span>
					<span class="cell" style="width: 400px;">Description</span>
					<span class="cell" style="width: 75px;">Price</span>
					<span class="cell" style="width: 160px;">Date</span>
				</li>
				<li ng-repeat="item in items | filter:searchText" class="animate">
					<span class="cell" style="width: 160px;" ng-click="narrow(item.name)">{{item.name}}</span>
					<span class="cell" style="width: 400px;" ng-click="narrow(item.description)">{{item.description}}</span>
					<span class="cell" style="width: 75px;">${{item.price}}</span>
					<span class="cell" style="width: 160px;" ng-click="narrow(item.date.split(' ')[0])">{{item.date}}</span>
					<span class="cell"><button class="delete button" ng-click="delete(item.id)">Delete</button></span>
				</li>
			</ul>

		</div>

	</div>

</div>