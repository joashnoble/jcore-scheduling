<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style type="text/css">
	    table { page-break-inside:auto }
	    tr    { page-break-inside:avoid; page-break-after:auto }
	    thead { display:table-header-group }
	    tfoot { display:table-footer-group }
	</style>
</head>
<body>



	<?php 

	if ($type == "print"){

		include 'template_header.php';?>
		<div>
			Daily Manpower Schedule<br/>
			<?php echo date("F d, Y", strtotime($date)); ?>
		</div>
		<br />
	<?php }else if($type == "pdf"){ ?>

		<table width="100%">
			<tr>
				<td width="25%">
					<img src="<?php echo $this->session->main_directory.'/'.$company->image_name;?>" style="width: auto; max-width: auto; height: 60px; max-height: 60px; float: left; margin-top: 5px !important;margin-right: 10px;">	
				</td>
				<td><div style="font-size: 11pt;font-weight: 500;"><?php echo $company->company_name; ?></div>
					<div style="font-size: 8pt;font-weight: 500;margin-top: 0px;"><?php echo $company->address ?></div>
					<div style="font-size: 8pt;font-weight: 500;margin-top: 0px;"><?php echo $company->contact_no ?></div>
					<div style="font-size: 8pt;font-weight: 500;margin-top: 0px;"><?php echo $company->email_address ?></div>
				</td>
			</tr>
		</table>


		<br /><br />
		<div>
			Daily Manpower Schedule<br/>
			<?php echo date("F d, Y", strtotime($date)); ?>
		</div>
		<br />
	<?php }?>

	<table width="100%" style="border-collapse: collapse;padding: 20px;" cellpadding="5" cellspacing="5">
		
		<thead>
			<tr>
					<th colspan="26" style="font-size: 8pt!important;font-family: calibri!important;border: 1px solid #C8C8C8!important;padding: 10px;background: #F8F8F8!important;border-bottom: 1px solid gray!important;">
						<center>
							<?php echo date("F d, Y", strtotime($date)); ?>
						</center>
					</th>
			</tr>
			<tr>
				<th style="font-size: 8pt;font-family: calibri!important;border: 1px solid gray!important;background: #FFF!important;text-align: center!important;" width="5%"><center>#</center></th>
				<th style="font-size: 8pt;font-family: calibri!important;border: 1px solid gray!important;background: #FFF!important;padding-left: 10px!important;text-align: left!important;" width="26%">Employee</th>

				<?php for ($i=0; $i <= 23; $i++) { ?>
					<th style="font-size: 7pt!important;font-family: calibri!important;border: 1px solid gray!important;background: #FFF!important;" width="3%">
						<center>
							<?php if ($i == 0){ echo '12'; }
								else if($i == 13 ){ echo '1'; }
								else if($i == 14 ){ echo '2'; }
								else if($i == 15 ){ echo '3'; }
								else if($i == 16 ){ echo '4'; }
								else if($i == 17 ){ echo '5'; }
								else if($i == 18 ){ echo '6'; }
								else if($i == 19 ){ echo '7'; }
								else if($i == 20 ){ echo '8'; }
								else if($i == 21 ){ echo '9'; }
								else if($i == 22 ){ echo '10'; }
								else if($i == 23 ){ echo '11'; }
								else{ echo $i; }?>
								<br/>
							<?php if ($i <= 11){ echo 'AM'; } else if($i == 12){ echo 'NN'; } else if($i <= 23){ echo 'PM'; }?>
						</center>
					</th>
				<?php } ?>			

			</tr>
		</thead>
		<tbody>
		<?php 
			$a = 1;
			if(count($schedules) > 0){


			foreach($departments as $dept){ ?>

				<tr>
					<td colspan="26" style="border: 1px solid #C8C8C8!important;font-size: 9pt!important;font-family: calibri!important;padding-left: 10px!important;padding-right: 10px!important;">
							
						<b><?php echo $dept->department; ?></b>

					</td>
				</tr>

			<?php 

			foreach($schedules as $sched){ 

				if ($dept->ref_department_id == $sched->ref_department_id){


			?> 
			<tr>
				<td style="border: 1px solid #C8C8C8!important;font-size: 9pt!important;font-family: calibri!important;padding-left: 10px!important;padding-right: 10px!important;">
					<center>
						<?php echo $a; ?>
					</center>
				</td>
				<td style="border: 1px solid #C8C8C8!important;font-size: 9pt!important;font-family: calibri!important;padding-left: 10px!important;padding-right: 10px!important;"><?php echo $sched->full_name; ?></td>

					<?php for ($i=0; $i <= 23; $i++) { 
						?>
						   
						<td style="

							/*border: 1px solid #E8E8E8!important;*/
						border: <?php
									  if($i == 0){ echo $sched->zero_border_px; } 
									  else if($i == 1){ echo $sched->one_border_px; }
									  else if($i == 2){ echo $sched->two_border_px; }
									  else if($i == 3){ echo $sched->three_border_px; }
									  else if($i == 4){ echo $sched->four_border_px; }
									  else if($i == 5){ echo $sched->five_border_px; }
									  else if($i == 6){ echo $sched->six_border_px; }
									  else if($i == 7){ echo $sched->seven_border_px; }
									  else if($i == 8){ echo $sched->eight_border_px; }
									  else if($i == 9){ echo $sched->nine_border_px; }
									  else if($i == 10){ echo $sched->ten_border_px; }
									  else if($i == 11){ echo $sched->eleven_border_px; }
									  else if($i == 12){ echo $sched->twelve_border_px; }
									  else if($i == 13){ echo $sched->thirteen_border_px; }
									  else if($i == 14){ echo $sched->fourteen_border_px; }
									  else if($i == 15){ echo $sched->fifteen_border_px; }
									  else if($i == 16){ echo $sched->sixteen_border_px; }
									  else if($i == 17){ echo $sched->seventeen_border_px; }
									  else if($i == 18){ echo $sched->eighteen_border_px; }
									  else if($i == 19){ echo $sched->nineteen_border_px; }
									  else if($i == 20){ echo $sched->twenty_border_px; }
									  else if($i == 21){ echo $sched->twentyone_border_px; }
									  else if($i == 22){ echo $sched->twentytwo_border_px; }
									  else if($i == 23){ echo $sched->twentythree_border_px; }?>


									  solid <?php
									  if($i == 0){ echo $sched->zero_border; } 
									  else if($i == 1){ echo $sched->one_border; }
									  else if($i == 2){ echo $sched->two_border; }
									  else if($i == 3){ echo $sched->three_border; }
									  else if($i == 4){ echo $sched->four_border; }
									  else if($i == 5){ echo $sched->five_border; }
									  else if($i == 6){ echo $sched->six_border; }
									  else if($i == 7){ echo $sched->seven_border; }
									  else if($i == 8){ echo $sched->eight_border; }
									  else if($i == 9){ echo $sched->nine_border; }
									  else if($i == 10){ echo $sched->ten_border; }
									  else if($i == 11){ echo $sched->eleven_border; }
									  else if($i == 12){ echo $sched->twelve_border; }
									  else if($i == 13){ echo $sched->thirteen_border; }
									  else if($i == 14){ echo $sched->fourteen_border; }
									  else if($i == 15){ echo $sched->fifteen_border; }
									  else if($i == 16){ echo $sched->sixteen_border; }
									  else if($i == 17){ echo $sched->seventeen_border; }
									  else if($i == 18){ echo $sched->eighteen_border; }
									  else if($i == 19){ echo $sched->nineteen_border; }
									  else if($i == 20){ echo $sched->twenty_border; }
									  else if($i == 21){ echo $sched->twentyone_border; }
									  else if($i == 22){ echo $sched->twentytwo_border; }
									  else if($i == 23){ echo $sched->twentythree_border; }?>!important;
							border-bottom: 1px solid #C8C8C8!important;

							background: 
									<?php
									  if($i == 0){ echo $sched->zero; } 
									  else if($i == 1){ echo $sched->one; }
									  else if($i == 2){ echo $sched->two; }
									  else if($i == 3){ echo $sched->three; }
									  else if($i == 4){ echo $sched->four; }
									  else if($i == 5){ echo $sched->five; }
									  else if($i == 6){ echo $sched->six; }
									  else if($i == 7){ echo $sched->seven; }
									  else if($i == 8){ echo $sched->eight; }
									  else if($i == 9){ echo $sched->nine; }
									  else if($i == 10){ echo $sched->ten; }
									  else if($i == 11){ echo $sched->eleven; }
									  else if($i == 12){ echo $sched->twelve; }
									  else if($i == 13){ echo $sched->thirteen; }
									  else if($i == 14){ echo $sched->fourteen; }
									  else if($i == 15){ echo $sched->fifteen; }
									  else if($i == 16){ echo $sched->sixteen; }
									  else if($i == 17){ echo $sched->seventeen; }
									  else if($i == 18){ echo $sched->eighteen; }
									  else if($i == 19){ echo $sched->nineteen; }
									  else if($i == 20){ echo $sched->twenty; }
									  else if($i == 21){ echo $sched->twentyone; }
									  else if($i == 22){ echo $sched->twentytwo; }
									  else if($i == 23){ echo $sched->twentythree; }?>!important;
									  height: 25px!important; 

						">
							
						</td>
				<?php }?>

			</tr>
		<?php $a++;}}}}else{?>

			<tr>
				<td colspan="26" style="border: 1px solid #C8C8C8!important;font-size: 9pt!important;font-family: calibri!important;padding-left: 10px!important;padding-right: 10px!important;padding: 20px!important;">
					<center>No Schedule Found</center>
				</td>
			</tr>

		<?php } ?>
		</tbody>
	</table>

<script type="text/javascript">
	
window.onload = function () {
    window.print();
}

</script>

</body>
</html>