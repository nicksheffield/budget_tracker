<div class="main" ng-controller="listCtrl">

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
				<ul class="table-mimic dark">
					<li class="header">
						<span class="cell" style="width: 75px;">Spent</span>
						<span class="cell">Category</span>
					</li>
					<li ng-repeat="item in sdata" class="item">
						<span class="cell" style="width: 75px;">${{item.price}}</span>
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
					height="350"
					x="xFunction()"
					y="yFunction()"
					showLabels="true"
					labelType="percent"
					tooltips="true"
					color="colorFunction()"
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
				<button class="btn btn-default"><i class="fa fa-calendar"></i></button>

				<?=Form::open('/list/filter', 'post', 'class="filter"')?>
					<div class="form-group">
						<?=Form::label('month', 'Change Month')?>
					</div>

					<div class="form-group">
						<?=Form::select('month', array(
							'1' => 'January','2' => 'February','3' => 'March','4' => 'April',
							'5' => 'May','6' => 'June','7' => 'July','8' => 'August','9' => 'September',
							'10' => 'October','11' => 'November','12' => 'December',
						), Sticky::get('month',  Date('n')), 'class="form-control"')?>
					</div>

					<div class="form-group">
						<?=Form::number('year', Sticky::get('year', Date('Y')), 'class="form-control"')?>
					</div>

					<div class="form-group">
						<?=Form::submit('Go', 'class="btn btn-default"')?>
					</div>
				<?=Form::close()?>
			</div>

			<p class="heading">Spending between <?=$start_date?> and <?=$end_date?></p>
		</div>

		<div class="col-lg-12">

			<p class="total">Total: ${{total(items)}}</p>

			<ul class="table-mimic light list">
				<li class="header">
					<span class="cell" style="width: 160px;">Category</span>
					<span class="cell" style="width: 400px;">Description</span>
					<span class="cell" style="width: 75px;">Price</span>
					<span class="cell" style="width: 160px;">Date</span>
				</li>
				<li ng-repeat="item in items | filter:searchText" class="item">
					<span class="cell" style="width: 160px;" ng-click="narrow(item.name)">{{item.name}}</span>
					<span class="cell" style="width: 400px;" ng-click="narrow(item.description)">{{item.description}}</span>
					<span class="cell" style="width: 75px;">{{item.price}}</span>
					<span class="cell" style="width: 160px;" ng-click="narrow(item.date.split(' ')[0])">{{item.date}}</span>
					<span class="cell"><a ng-href="/delete/{{item.id}}" class="button">Delete</a></span>
				</li>
			</ul>

		</div>

	</div>

</div>