<!DOCTYPE html>
<html>
<head>
	<?php
	if(isset($_GET['page']) && !is_null($_GET['page']) && !is_numeric($_GET['page']) && !empty($_GET['page'])) {
		$page = rtrim(ltrim($_GET['page']));
	}
	else {
		header("location:index.php?page=PastHour");
	}
	?>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Earthquake - <?php echo $page; ?></title>
	<link rel="stylesheet" type="text/css" href="assets/layout.css">
	<link rel="stylesheet" type="text/css" href="assets/lib/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/lib/bootstrap/css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="assets/lib/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="assets/lib/datatable/datatables.min.css"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<?php
require_once('system/json.php');
$json = new Json();
?>

<body>
	<script src="assets/lib/datatable/datatables.min.js"></script>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="logo float-left">
					<img src="assets/img/icon1.png" width="100" class="img-fluid" title="Earthquake Data" alt="Earthquake Data" />
				</div>
				<div class="heading float-left">
					<h1>Earthquake</h1>
					<h2>Earthquake Detail | developed by <a href="https://amirshnll.ir" class="text-dark" title="Amir Shokri">Amir Shokri</a></h2>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="buttun">
					<a href="index.php?page=PastHour" title="PastHour" class="btn <?php if($page=="PastHour") echo 'btn-danger'; else echo 'btn-primary'; ?> ">PastHour</a>
					<a href="index.php?page=PastDay" title="PastDay" class="btn  <?php if($page=="PastDay") echo 'btn-danger'; else echo 'btn-primary'; ?> ">PastDay</a>
					<a href="index.php?page=Past7Days" title="Past7Days" class="btn  <?php if($page=="Past7Days") echo 'btn-danger'; else echo 'btn-primary'; ?> ">Past7Days</a>
					<a href="index.php?page=Past30Days" title="Past30Days" class="btn  <?php if($page=="Past30Days") echo 'btn-danger'; else echo 'btn-primary'; ?> ">Past30Days</a>
				</div>
			</div>
		</div>

		<?php
		switch ($page) {
			case $page == 'PastHour': {
				$PastHour	=	$json->getPastHour();
				?>
				<div class="row">
					<div class="col-md-12">
						<h4 class="display-4">PastHour</h4>
						<p><strong>updated time:</strong> <?php echo date ("F d Y H:i:s.", $json->jsonUpdatedTime['PastHour']); ?> <a href="update.php" class="btn btn-success" title="Update Data">Update Data</a></p>
						<table id="tablePastHour" class="display table table-striped table-responsive-sm" style="width:100%">
							<thead>
								<tr class="font-weight-bold">
									<td width="10%">#</td>
									<td width="20%">ID</td>
									<td width="50%">Properties</td>
									<td width="20%">Geometry</td>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 0;
								$counter = 1;
								if($PastHour!==false && is_array($PastHour)) {
									foreach ($PastHour['features'] as $key => $value) {
										if($counter<20)
											$counter++;
										else
											break;
										$i++;
										echo "<tr>","<td>",$i,"</td>","<td>",$value['id'],"</td>","<td>";
										foreach ($value['properties'] as $keys => $values) {
											echo "<strong>",$keys," : </strong>",$values,"<br />";
										}
										echo "</td>","<td>";
										foreach ($value['geometry'] as $keys => $values) {
											if(is_array($values)) {
												echo "<strong>",$keys," : </strong><br />";
												for ($j=0; $j < (int)count($values); $j++) {
													echo "* ",$values[$j],"<br />";
												}
											}
											else
												echo "<strong>",$keys," : </strong>",$values,"<br />";
										}
										echo "</td>","</tr>";
									}
								}
								$PastHour = $i;
								?>
							</tr>
						</tbody>
						<tfoot>
							<tr class="font-weight-bold">
								<td width="10%">#</td>
								<td width="20%">ID</td>
								<td width="50%">Properties</td>
								<td width="20%">Geometry</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			<?php
		}
		break;
		case $page == 'PastDay': {
			$PastDay	=	$json->getPastDay();
			?>
			<div class="row">
				<div class="col-md-12">
					<h4 class="display-4">PastDay</h4>
					<p><strong>updated time:</strong> <?php echo date ("F d Y H:i:s.", $json->jsonUpdatedTime['PastDay']); ?> <a href="update.php" class="btn btn-success" title="Update Data">Update Data</a></p>
					<table id="tablePastDay" class="display table table-striped table-responsive-sm" style="width:100%">
						<thead>
							<tr class="font-weight-bold">
								<td width="10%">#</td>
								<td width="20%">ID</td>
								<td width="50%">Properties</td>
								<td width="20%">Geometry</td>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 0;
							$counter = 1;
							if($PastDay!==false && is_array($PastDay)) {
								foreach ($PastDay['features'] as $key => $value) {
									if($counter<30)
										$counter++;
									else
										break;
									$i++;
									echo "<tr>","<td>",$i,"</td>","<td>",$value['id'],"</td>","<td>";
									foreach ($value['properties'] as $keys => $values) {
										echo "<strong>",$keys," : </strong>",$values,"<br />";
									}
									echo "</td>","<td>";
									foreach ($value['geometry'] as $keys => $values) {
										if(is_array($values)) {
											echo "<strong>",$keys," : </strong><br />";
											for ($j=0; $j < (int)count($values); $j++) {
												echo "* ",$values[$j],"<br />";
											}
										}
										else
											echo "<strong>",$keys," : </strong>",$values,"<br />";
									}
									echo "</td>","</tr>";
								}
							}
							$PastDay = $i;
							?>
						</tr>
					</tbody>
					<tfoot>
						<tr class="font-weight-bold">
							<td width="10%">#</td>
							<td width="20%">ID</td>
							<td width="50%">Properties</td>
							<td width="20%">Geometry</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<?php
	} break;
	case $page == 'Past7Days': {
		$Past7Days	=	$json->getPast7Days();
		?>
		<div class="row">
			<div class="col-md-12">
				<h4 class="display-4">Past7Days</h4>
				<p><strong>updated time:</strong> <?php echo date ("F d Y H:i:s.", $json->jsonUpdatedTime['Past7Days']); ?> <a href="update.php" class="btn btn-success" title="Update Data">Update Data</a></p>
				<table id="tablePast7Days" class="display table table-striped table-responsive-sm" style="width:100%">
					<thead>
						<tr class="font-weight-bold">
							<td width="10%">#</td>
							<td width="20%">ID</td>
							<td width="50%">Properties</td>
							<td width="20%">Geometry</td>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 0;
						$counter = 1;
						if($Past7Days!==false && is_array($Past7Days)) {
							foreach ($Past7Days['features'] as $key => $value) {
								if($counter<40)
									$counter++;
								else
									break;
								$i++;
								echo "<tr>","<td>",$i,"</td>","<td>",$value['id'],"</td>","<td>";
								foreach ($value['properties'] as $keys => $values) {
									echo "<strong>",$keys," : </strong>",$values,"<br />";
								}
								echo "</td>","<td>";
								foreach ($value['geometry'] as $keys => $values) {
									if(is_array($values)) {
										echo "<strong>",$keys," : </strong><br />";
										for ($j=0; $j < (int)count($values); $j++) {
											echo "* ",$values[$j],"<br />";
										}
									}
									else
										echo "<strong>",$keys," : </strong>",$values,"<br />";
								}
								echo "</td>","</tr>";
							}
						}
						$Past7Days = $i;
						?>
					</tr>
				</tbody>
				<tfoot>
					<tr class="font-weight-bold">
						<td width="10%">#</td>
						<td width="20%">ID</td>
						<td width="50%">Properties</td>
						<td width="20%">Geometry</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<?php
} break;
case $page == 'Past30Days': {
	$Past30Days	=	$json->getPast30Days();
	?>
	<div class="row">
		<div class="col-md-12">
			<h4 class="display-4">Past30Days</h4>
			<p><strong>updated time:</strong> <?php echo date ("F d Y H:i:s.", $json->jsonUpdatedTime['Past30Days']); ?> <a href="update.php" class="btn btn-success" title="Update Data">Update Data</a></p>
			<table id="tablePast30Days" class="display table table-striped table-responsive-sm" style="width:100%">
				<thead>
					<tr class="font-weight-bold">
						<td width="10%">#</td>
						<td width="20%">ID</td>
						<td width="50%">Properties</td>
						<td width="20%">Geometry</td>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 0;
					$counter = 1;
					if($Past30Days!==false && is_array($Past30Days)) {
						foreach ($Past30Days['features'] as $key => $value) {
							if($counter<50)
								$counter++;
							else
								break;
							$i++;
							echo "<tr>","<td>",$i,"</td>","<td>",$value['id'],"</td>","<td>";
							foreach ($value['properties'] as $keys => $values) {
								echo "<strong>",$keys," : </strong>",$values,"<br />";
							}
							echo "</td>","<td>";
							foreach ($value['geometry'] as $keys => $values) {
								if(is_array($values)) {
									echo "<strong>",$keys," : </strong><br />";
									for ($j=0; $j < (int)count($values); $j++) {
										echo "* ",$values[$j],"<br />";
									}
								}
								else
									echo "<strong>",$keys," : </strong>",$values,"<br />";
							}
							echo "</td>","</tr>";
						}
					}
					$Past30Days = $i;
					?>
				</tr>
			</tbody>
			<tfoot>
				<tr class="font-weight-bold">
					<td width="10%">#</td>
					<td width="20%">ID</td>
					<td width="50%">Properties</td>
					<td width="20%">Geometry</td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
<?php
} break;

default:
header("location:index.php?page=PastHour");
break;
}
?>

<br /><br />
<div class="detail">
	<div class="detail-heading">
		<div class="float-left">
			<img src="assets/img/icon2.png" width="50" class="img-fluid" title="Earthquake" alt="Earthquake" />
		</div>
		<div class="float-left">
			<h4>Earthquake...?!</h4>
		</div>
		<div class="clearfix"></div>
	</div>
	<p>An earthquake (also known as a quake, tremor or temblor) is the shaking of the surface of the Earth resulting from a sudden release of energy in the Earth's lithosphere that creates seismic waves. Earthquakes can range in size from those that are so weak that they cannot be felt to those violent enough to propel objects and people into the air, and wreak destruction across entire cities. The seismicity, or seismic activity, of an area is the frequency, type, and size of earthquakes experienced over a period of time. The word tremor is also used for non-earthquake seismic rumbling.</p>
	<p>At the Earth's surface, earthquakes manifest themselves by shaking and displacing or disrupting the ground. When the epicenter of a large earthquake is located offshore, the seabed may be displaced sufficiently to cause a tsunami. Earthquakes can also trigger landslides and occasionally, volcanic activity.</p>
	<p>In its most general sense, the word earthquake is used to describe any seismic event—whether natural or caused by humans—that generates seismic waves. Earthquakes are caused mostly by rupture of geological faults but also by other events such as volcanic activity, landslides, mine blasts, and nuclear tests. An earthquake's point of initial rupture is called its hypocenter or focus. The epicenter is the point at ground level directly above the hypocenter.</p>
	<p><a href="https://en.wikipedia.org/wiki/Earthquake" class="float-right btn btn-dark" rel="nofollow" title="Read More">Read More</a></p>
	<div class="clearfix"></div>
</div>
<br /><br />

<p class="copyright"><img src="assets/img/icon3.png" width="100" class="img-fluid" title="Earthquake" alt="Earthquake" /><br /><br />&copy; 2020; All right Reserved. | <strong><a href="https://amirshnll.ir" class="text-dark" title="Amir Shokri">Amir Shokri</a></strong></p>
</div>

<script>
	$(document).ready( function () {
		$('#tablePastHour').DataTable({});
	} );
	$(document).ready( function () {
		$('#tablePastDay').DataTable({});
	} );
	$(document).ready( function () {
		$('#tablePast7Days').DataTable({});
	} );
	$(document).ready( function () {
		$('#tablePast30Days').DataTable({});
	} );
</script>
<script src="assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>