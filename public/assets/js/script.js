// JQUERY

$(function(){

	var $window = $(window),
		$stickyEl = $('.search'),
		elTop = $stickyEl.offset().top;

	$window.scroll(function() {
		$('body').toggleClass('sticky', $window.scrollTop() > 100);
	});


})

// ANGULAR

var app = angular.module('app', ['ngAnimate', 'nvd3ChartDirectives', 'angularMoment'])

app.controller('budgetCtrl', function ($scope, $http, $filter, transformRequestAsFormPost ) {

	$http.defaults.headers.post = 'application/x-www-form-urlencoded; charset=utf-8';

	$scope.months = new Array(
		'January', 'February', 'March', 'April', 'May', 'June', 
		'July', 'August', 'September', 'October', 'November', 'December');


	$scope.items = [];
	$scope.categories = [];
	$scope.sdata = [];
	$scope.stage = localStorage.stage || 'add';
	$scope.showDateFilter = false;
	$scope.month = $scope.months[new Date().getMonth()];
	$scope.year = new Date().getFullYear();

	$scope.new_category = 0;
	$scope.new_price = '';
	$scope.new_description = '';

	$scope.message = {
		type: null,
		message: '',
		show: false
	}

	$scope.$watch('searchText', function(){
		$scope.sdata = $scope.simplify($scope.items);
	})


	$scope.load_items = function(){

		$http.get('/items/get_date/'+$scope.month+'-'+$scope.year).
			success(function(data, status, headers, config) {
				for(var i=0; i<data.length; i++){
					data[i].price = parseFloat(data[i].price).toFixed(2)
					var date = data[i].date;
					data[i].date = $filter('amDateFormat')(date, 'MMMM D YYYY, h:mm a')
					data[i].day  = $filter('amDateFormat')(date, 'MMMM D')
				}

				$scope.items = data;
				$scope.sdata = $scope.simplify(data);
			}).
			error(function(data, status, headers, config) {
				// log error
			});
	}

	$scope.load_categories = function(){
		
		$http.get('/categories/get_all').
			success(function(data, status, headers, config) {
				$scope.categories = data;
			}).
			error(function(data, status, headers, config) {
				// log error
			});
	
	}

	$scope.delete = function(id){
		if(confirm('Are you sure you want to delete that item?')){
			var req = $http({
				method: 'post',
				url: 'items/delete',
				transformRequest: transformRequestAsFormPost,
				data: {
					id: id
				}
			})

			req.success(function(data){
				//console.log(data);

				if(data.success){
					for(var i=0; i<$scope.items.length; i++){
						if($scope.items[i].id == id){
							$scope.items.splice(i, 1);
							break;
						}
					}

					$scope.sdata = $scope.simplify($scope.items);
				}
			})
		}
	}

	$scope.add = function(){
		var req = $http({
			method: 'post',
			url: 'items/save',
			transformRequest: transformRequestAsFormPost,
			data: {
				category_id: $scope.new_category,
				price: $scope.new_price,
				description: $scope.new_description
			}
		})

		req.success(function(data){
			//console.log(data);

			if(data.success){

				for(var i=0; i<$scope.categories.length; i++){
					if($scope.categories[i].id == data.item.category_id){
						data.item.name = $scope.categories[i].name;
						break;
					}
				}

				var date = data.item.date;
				data.item.date = $filter('amDateFormat')(date, 'MMMM D YYYY, h:mm a')
				data.item.day  = $filter('amDateFormat')(date, 'MMMM D')

				$scope.items.push(data.item);
				$scope.sdata = $scope.simplify($scope.items);

				$scope.new_category    = 0;
				$scope.new_price       = '';
				$scope.new_description = '';

				$scope.message.text = 'Item added';
				$scope.message.show = true;
				$scope.message.type = 'success';
			}else{
				$scope.message.text = data.error;
				$scope.message.show = true;
				$scope.message.type = 'error';
			}
		})
	}

	$scope.load_items();
	$scope.load_categories();

	$scope.change_stage = function(stage){
		$scope.stage = stage;
		localStorage.stage = stage;
	}

	$scope.narrow = function(text){
		$scope.searchText = text;
	}

	$scope.hide_message = function(){
		$scope.message.show = false;
	}

	$scope.toggle = function(index){
		$scope[index] =! $scope[index];
	}

	$scope.total = function(items){
		var sum = 0;
		items = $filter('filter')(items, $scope.searchText);

		for(var i=-1; ++i < items.length;){
			sum += parseFloat(items[i].price)
		}

		return isNaN(sum) ? 0 : sum.toFixed(2);
	}

	var colorArray = ['#2ecc71', '#3498db', '#e74c3c', '#f1c40f', '#e67e22', '#9b59b6', '#34495e', '#95a5a6', '#1abc9c', '#00ffaa', '#edaf12', '#f6096c'];
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





app.factory(
    "transformRequestAsFormPost",
    function() {

        // I prepare the request data for the form post.
        function transformRequest( data, getHeaders ) {

            var headers = getHeaders();

            headers[ "Content-type" ] = "application/x-www-form-urlencoded; charset=utf-8";

            return( serializeData( data ) );

        }


        // Return the factory value.
        return( transformRequest );


        // ---
        // PRVIATE METHODS.
        // ---


        // I serialize the given Object into a key-value pair string. This
        // method expects an object and will default to the toString() method.
        // --
        // NOTE: This is an atered version of the jQuery.param() method which
        // will serialize a data collection for Form posting.
        // --
        // https://github.com/jquery/jquery/blob/master/src/serialize.js#L45
        function serializeData( data ) {

            // If this is not an object, defer to native stringification.
            if ( ! angular.isObject( data ) ) {

                return( ( data == null ) ? "" : data.toString() );

            }

            var buffer = [];

            // Serialize each key in the object.
            for ( var name in data ) {

                if ( ! data.hasOwnProperty( name ) ) {

                    continue;

                }

                var value = data[ name ];

                buffer.push(
                    encodeURIComponent( name ) +
                    "=" +
                    encodeURIComponent( ( value == null ) ? "" : value )
                );

            }

            // Serialize the buffer and clean it up for transportation.
            var source = buffer
                .join( "&" )
                .replace( /%20/g, "+" )
            ;

            return( source );

        }

    }
);