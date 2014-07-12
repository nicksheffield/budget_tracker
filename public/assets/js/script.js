// JQUERY

$(function(){

	$(document).on('input', 'form.filter select', function(){
		$('form.filter').submit();
	})


	$(document).on('click', 'form.add .submit', function(){

		$.ajax({
			type: 'post',
			url: '/save',
			dataType: 'json',
			data: {
				category:    $('#category').val(),
				price:       $('#price').val(),
				description: $('#description').val()
			},
			success: function(data){
				$('.error, .success').remove();
				if(data.success){
					$('form.add h2').after('<div class="success"><i class="fa fa-check"></i>Successfully saved</div>');
				}else{
					$('form.add h2').after('<div class="error">'+data.error+'</div>');
				}
			}
		})

		return false;
	})

	$(document).on('click', '.success, .error', function(e){
		$(e.target).remove();
	})

	$(document).on('click', '.filter_box button', function(e){
		var target = $(this);

		if(target.hasClass('open')){
			target.removeClass('open');
		}else{
			target.addClass('open');
		}
	})

})

// ANGULAR

var app = angular.module('app', ['ngAnimate', 'nvd3ChartDirectives'])

app.controller('listCtrl', function ($scope, $http, $filter) {

	$scope.items = [];
	$scope.sdata = [];

	$scope.$watch('searchText', function(){
		$scope.sdata = $scope.simplify($scope.items);
	})


	$scope.load = function(){
		$http.get('/site/json_items/'+jQuery('#month').val()+'/'+jQuery('#year').val()).
			success(function(data, status, headers, config) {
				$scope.items = data;
				$scope.sdata = $scope.simplify(data);
			}).
			error(function(data, status, headers, config) {
				// log error
			});
	}

	$scope.load();

	$scope.narrow = function(text){
		$scope.searchText = text;
	}

	$scope.total = function(items){
		var sum = 0;
		items = $filter('filter')(items, $scope.searchText);

		for(var i=-1; ++i < items.length;){
			sum += parseFloat(items[i].price)
		}

		return isNaN(sum) ? 0 : sum.toFixed(2);
	}

	var colorArray = ['#2ecc71', '#3498db', '#e74c3c', '#f1c40f', '#e67e22', '#9b59b6', '#34495e', '#95a5a6', '#1abc9c'];
	$scope.colorFunction = function() {
		return function(d, i) {
			return colorArray[i];
		};
	}

	$scope.xFunction = function(){
		return function(d) {
			return d.name;
		};
	}

	$scope.yFunction = function(){
		return function(d) {
			return d.price;
		};
	}

	$scope.simplify = function(data){
		var sdata = [];
		data = $filter('filter')(data, $scope.searchText)

		for(var i=0; i < data.length; i++){
			var found = false;

			for(var j=0; j < sdata.length; j++){

				if(data[i].name == sdata[j].name){
					sdata[j].price += parseFloat(data[i].price);
					found = true;
				}
			}

			if(!found){
				sdata.push({
					name: data[i].name,
					price: parseFloat(data[i].price),
				});
			}
		}

		//sdata = _.sortBy(sdata, function(obj){ return -obj.price})

		return sdata;
	}

})