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
</head>
<body>
	<div class="container">
		<h1>Upload ASB CSV file</h1>

		<?=Form::open_upload('csv/upload')?>
			<div class="form-group">
				<?=Form::label('file', 'File')?>
				<?=Form::File()?>
			</div>

			<div class="form-group">
				<?=Form::label('text', 'Or copy paste')?>
				<?=Form::textarea('text', false, 'class="form-control csv"')?>
			</div>

			<div class="form-group">
				<?=Form::submit('Upload', 'class="btn btn-default"')?>
			</div>
		<?=Form::close()?>

	</div>
</body>
</html>