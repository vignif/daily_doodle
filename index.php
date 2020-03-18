<!DOCTYPE html>
<!-- TODO
insert minimum amount of time needed for meeting
block double submit of same form
-->
<html>
<head>
	<?php
	include('include/functions.php');
	include('include/match.php');

	?>
	<title>Daily Doodle</title>

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
	<style type="text/css">
	.container {
		margin-top: 40px;
	}
	.btn-primary {
		width: 100%;
	}
	</style>

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

</head>
<body>
	<div class="container">

		<?php
		if (isset($insert) && $debug==true){
			?>
			<div class="panel panel-danger">
				<div class="panel-heading">Form Response</div>
				<div class="panel-body">
					Form response <br>
					<?php
					print_response();
					?><br>
				</div>
			</div>
		<?php } ?>

		<?if (isset($sizeExceeded)){ ?>
		<div class="panel panel-body panel-danger">
				Filesize exceeded<br>
		</div>
	<?}?>

		<div class="panel panel-primary">
			<h4 style="text-align:center;" > <b>< Daily Doodle ></b> </h4>
			<div class="panel-heading">  Schedule an Appointment</div>
			<div class="panel-body">
				<p>The first entry is going to select the date, the others just have to select the time </p>
				Now:
				<p id="date"></p>

			</div>
			<form class="" action="index.php" method="post">

				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Name</label>
								<input type="text" class="form-control" name="name" id="name">
							</div>
						</div>
						<div class='col-md-6'>
							<div class="form-group">
								<label class="control-label">Date </label>
									<?if(isset($date0)){
										?>
										<input class="form-control" type="date" name="date" value=<?echo $date0;?> disabled>
										<input hidden type="date" name="date" value=<?echo $date0;?>>

										<?
									}else{?>
									<input class="form-control" type="date" name="date" value=<?echo date("Y-m-d");?>>
									<?}?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Email</label>
								<input type="email" class="form-control" name="email" id="email" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">From</label>
									<select class="form-control" name="from"><?php echo get_times('10:00'); ?></select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="control-label">To</label>
									<select class="form-control" name="to"><?php echo get_times('14:00'); ?></select>
							</div>
						</div>
					</div>

	 				<input hidden value="<?php $rand=rand();$_SESSION['rand']=$rand; echo $rand; ?>" name="randcheck" />
					<input type="submit" class="btn btn-primary" value="Submit" name="insert">
				</div>
			</form>
		</div>

			<div class="panel panel-primary">
				<div class="panel-heading">Current Database</div>
				<div class="panel-body">
					Here is the list of the current entry in the file <b> <?print $file->filename;?></b>, number of entries: <?print $file->size();?>
					<p id="showData"></p>
					<table class="table">
						<tbody>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Date</th>
								<th>From</th>
								<th>To</th>
								<th>Del</th>
							</tr>
							<?php
							$i = 0;
							foreach ($data_arr->data as $key => $value) : ?>
							<tr>
								<td hidden><? echo $i; ?> </td>
								<td> <?php echo $value["name"]; ?> </td>
								<td> <?php echo $value["email"]; ?> </td>
								<td> <?php echo date("d/m/Y", strtotime($value["date"]));?> </td>
								<td> <?php echo $value["from"]; ?> </td>
								<td> <?php echo $value["to"]; ?> </td>
								<td><form class="" action="index.php" method="post"><input type="submit" name="delete" value="<?echo $key?>"/>
								<input hidden name="randcheck" id="randcheck" value="<?php echo microtime(); ?>" />
								</form></td>
								<!--	<td><input type="button" value="x" onclick="var id = deleteRow(this)"/></td> -->
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
<form class="" action="index.php" method="post">
				<button type="button" class="btn btn-secondary" onClick="window.location.href=window.location.href">Reset</button>

					<input type="submit" class="btn btn-secondary" name="delAll" value="Clear all entries">
				</form>

			</div>
		</div>


		<div class="panel panel-primary">
			<div class="panel-heading">Available solutions</div>
			<div class="panel-body">
				<?	if ($solutionExist) {?>
					<table class="table">
						<tbody>
							<tr>
								<th>Date</th>
								<th>From</th>
								<th>To</th>
							</tr>
							<tr>
								<td><?echo date("d/m/Y", strtotime($date0));?></td>
								<td><?echo $fromMax;?></td>
								<td><?echo $toMin;?></td>
							</tr>
						</table>
						<?}else{?>
							<p>No possible match</p>
							<?}?>
						</div>
			</div>

			<footer >
			<p class="panel panel-footer" style="color:grey; float:right; font-style:italic";>
				The sourcecode of this project can be found in github <a href="https://github.com/vignif/daily_doodle">daily_doodle</a>
			</p>
			</footer>
			</div>

		</body>
	<script type='text/javascript' src='include/script.js'></script>
	</html>
