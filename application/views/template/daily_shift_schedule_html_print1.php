<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style type="text/css">
	    table { page-break-inside:auto }
	    tr    { page-break-inside:avoid; page-break-after:auto }
	    thead { display:table-header-group }
	    tfoot { display:table-footer-group }
	    table.tbl_daily_shift tbody > tr:hover {
	    	cursor: pointer;
	    	background: #FFFFCC;
        }
	</style>
</head>
<body>
<div class="tbl-responsive">
	<table width="100%" style="border-collapse: collapse;padding: 20px;color: black;" cellpadding="5" cellspacing="5" class="tbl_daily_shift">
		
		<thead>
			<tr>
				<th style="font-size: 9pt;font-family: calibri!important;border: 1px solid gray!important;text-align: center!important;" width="1%"><center>#</center></th>
				<th style="font-size: 9pt;font-family: calibri!important;border: 1px solid gray!important;padding-left: 10px!important;text-align: left!important;" width="10%">Employee</th>

							<?php 

							$i = 0;

							if (count($shifts) > 0){
						

							foreach($shifts as $shift){

							?>
							
							<th style="font-size: 9pt!important;font-family: calibri!important;border: 1px solid gray!important;width: 1000px!important;">
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
					<td colspan="<?php echo $total_columns; ?>" style="border: 1px solid #C8C8C8!important;font-size: 10pt!important;font-family: calibri!important;padding-left: 10px!important;padding-right: 10px!important;background: lightgray;-webkit-box-shadow: 0px 2px 5px 0px rgba(148,148,148,1);
-moz-box-shadow: 0px 2px 5px 0px rgba(148,148,148,1);
box-shadow: 0px 2px 5px 0px rgba(148,148,148,1);">
							
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


						<img src="<?php echo $this->config->item('base_urlmain'); ?>/<?php echo $sched->image_name; ?>" style="width: 50px;height: 50px;border-radius: 50%;">

					</center>
				</td>
				<td style="border: 1px solid #C8C8C8!important;font-size: 10pt!important;font-family: calibri!important;padding-left: 10px!important;padding-right: 10px!important;background: #F8F8F8;border-top: 1px solid black;box-shadow: 5px 0 5px -5px #333;"><?php echo $sched->full_name; ?></td>

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
</body>
</html>