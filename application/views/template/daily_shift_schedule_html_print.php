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
			Daily Shift Schedule<br/>
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
			Daily Shift Schedule<br/>
			<?php echo date("F d, Y", strtotime($date)); ?>
		</div>
		<br />
	<?php }?>	
<div class="tbl-responsive">
	<table width="100%" style="border-collapse: collapse;padding: 20px;color: black;border: 1px solid #C8C8C8;" cellpadding="5" cellspacing="5" class="tbl_daily_shift">
		
		<thead>
			<tr>
				<th style="font-size: 9pt;font-family: calibri!important;border: 1px solid gray!important;text-align: center!important;" width="1%"><center>#</center></th>
				<th style="font-size: 9pt;font-family: calibri!important;border: 1px solid gray!important;padding-left: 10px!important;text-align: left!important;" width="10%">Employee</th>

							<?php 

							$i = 0;

							if (count($shifts) > 0){
						

							foreach($shifts as $shift){

							?>
							
							<th style="font-size: 9pt!important;font-family: calibri!important;border: 1px solid gray!important;">
								<center>
									<?php echo $shift->shift; ?><br>
									<span style="font-weight: normal!important;"><?php echo $shift->schedule_template_timein.' - '.$shift->schedule_template_timeout; ?></span>
								</center>
							</th>	

							<?php 

							$i++;

							}}else{?>


							<th style="font-size: 9pt!important;font-family: calibri!important;border: 1px solid gray!important;background: #FFF!important;" width="5%">
								<center>
									No Shift Found
								</center>
							</th>	
							<?php
							}

							?>

			</tr>
		</thead>
		<tbody>
		<?php 
			$a = 1;
			$total_columns = 2+$i;
			if(count($schedules) > 0){


			foreach($departments as $dept){ 


			?>

				<tr>
					<td colspan="<?php echo $total_columns; ?>" style="border: 1px solid #C8C8C8!important;font-size: 10pt!important;font-family: calibri!important;padding-left: 10px!important;padding-right: 10px!important;background: lightgray;">
							
						<b style="color: black;"><?php echo $dept->department; ?></b>

					</td>
				</tr>

			<?php 

			foreach($schedules as $sched){ 

				if ($dept->ref_department_id == $sched->ref_department_id){


			?> 
			<tr>
				<td style="border: 1px solid #C8C8C8!important;font-size: 10pt!important;font-family: calibri!important;padding-left: 10px!important;padding-right: 10px!important;background: #F8F8F8;border-top: 1px solid black;">
					<center>

						<?php echo $a; ?>

					</center>
				</td>
				<td style="border: 1px solid #C8C8C8!important;font-size: 10pt!important;font-family: calibri!important;padding-left: 10px!important;padding-right: 10px!important;background: #F8F8F8;border-top: 1px solid black;"><?php echo $sched->full_name; ?></td>

					<?php 

					$i = 0;

					if (count($shifts) > 0){
				

					foreach($shifts as $shift){


						if ($shift->sched_refshift_id == $sched->sched_refshift_id){

					?>
					
							<td style="font-size: 8pt!important;font-family: calibri!important;border-left: 1px solid #C8C8C8!important;border-right: 1px solid #C8C8C8!important;padding: 5px;" width="5%">
								<div style="background: #27ae60;width: 100%;height: 15px;color: white;-webkit-box-shadow: 0px 0px 5px 0px rgba(148,148,148,1);
							-moz-box-shadow: 0px 0px 5px 0px rgba(148,148,148,1);
							box-shadow: 0px 0px 5px 0px rgba(148,148,148,1);">
									<center>
										<span style="font-weight: normal!important;"><?php echo $shift->schedule_template_timein.' - '.$shift->schedule_template_timeout; ?></span>
									</center>
								</div>
							</td>

					<?php 

					}else{?>

						<td style="font-size: 9pt!important;font-family: calibri!important;border-left: 1px solid #C8C8C8!important;border-right: 1px solid #C8C8C8!important;padding: 5px;" width="5%">
						</td>
					<?php }
					$i++;}}else{?>


					<th style="font-size: 9pt!important;font-family: calibri!important;border: 1px solid gray!important;" width="5%">
						<center>
							No Shift Found
						</center>
					</th>	
					<?php
					}

					?>



			</tr>
		<?php $a++;}}}}else{?>

			<tr>
				<td colspan="<?php if (count($shifts) > 0){ echo $total_columns; }else{ echo '3';} ?>" style="border: 1px solid #C8C8C8!important;font-size: 15pt!important;font-family: calibri!important;padding-left: 10px!important;padding-right: 10px!important;padding: 20px!important;">
					<center>No Schedule Found</center>
				</td>
			</tr>

		<?php } ?>
		</tbody>
	</table>
</div>


<script type="text/javascript">
	
window.onload = function () {
    window.print();
}

</script>


</body>
</html>