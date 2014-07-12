<div class="container"  ng-hide="stage!='add'" ng-cloak>
	<div class="main">

		<div class="add">
			<h2>Add spending</h2>

			<p class="message" ng-class="{show: message.show, error: message.type=='error', success: message.type=='success'}" ng-click="hide_message()">{{message.text}}</p>

			<div class="row form-group">
				<label for="category">Category</label>
				<select id="category" name="category" class="form-control" ng-model="new_category">
					<option ng-repeat="category in categories" ng-cloak ng-value="category.id">{{category.name}}</option>
				</select>
			</div>
			
			<div class="row form-group">
				<label for="price">Price</label>
				<input type="number" id="price" name="price" step="0.01" class="form-control" ng-model="new_price">
			</div>

			<div class="row form-group">
				<label for="description">Description (optional)</label>
				<textarea name="description" id="description" class="form-control" ng-model="new_description"></textarea>
			</div>

			<button class="btn btn-default submit" ng-click="add()">
				<i class="fa fa-plus"></i>Save
			</button>
		</div>

	</div>
</div>