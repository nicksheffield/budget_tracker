<div class="container">
	<div class="main">

		<?=Form::open('', 'post', 'class="add"')?>

			<h2>Add spending</h2>

			<?php if(Error::has('add_form')): ?>
				<p class="error"><i class="fa fa-warning"></i><?=Error::get('add_form')?></p>
			<?php endif; ?>

			<div class="row form-group">
				<?=Form::label('category', 'Category')?>
				<?=Form::select('category', $categories, 0, 'class="form-control"')?>
			</div>
			
			<div class="row form-group">
				<?=Form::label('price', 'Price')?>
				<?=Form::number('price', false, 'step="0.01" class="form-control"')?>
			</div>

			<div class="row form-group">
				<?=Form::label('description', 'Description (optional)')?>
				<?=Form::textarea('description', false, 'class="form-control"')?>
			</div>

			<button type="submit" class="btn btn-default submit"><i class="fa fa-plus"></i>Save</button>

		<?=Form::close()?>

	</div>
</div>