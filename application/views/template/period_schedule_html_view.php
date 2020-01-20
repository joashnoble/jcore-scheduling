<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style type="text/css">
	    table { page-break-inside:auto }
	    tr    { page-break-inside:avoid; page-break-after:auto }
	    thead { display:table-header-group }
	    tfoot { display:table-footer-group }
	    table.tbl_daily_schedule tbody > tr:hover {
	    	cursor: pointer;
	    	background: #FFFFCC;
        }	    
	</style>
</head>
<body>

	<table width="100%" style="border-collapse: collapse;padding: 20px;color: black;" cellpadding="5" cellspacing="5" class="tbl_daily_schedule">
		
		<thead>
			<tr>
				<th style="font-size: 9pt;font-family: calibri!important;border: 1px solid #C8C8C8!important;background: #F8F8F8!important;text-align: center!important;color: #585858!important;" width="1%"><center>#</center></th>
				<th style="font-size: 9pt;font-family: calibri!important;border: 1px solid #C8C8C8!important;background: #F8F8F8!important;padding-left: 10px!important;text-align: left!important;color: #585858!important;" width="10%">Employee</th>

					
							<?php 

							$i = 0;

							if (count($period) > 0){
							
							$begin = new DateTime($period[0]->pay_period_start);
							$end = new DateTime($period[0]->pay_period_end);
							$end = $end->modify( '+1 day' ); 

							$interval = new DateInterval('P1D');
							$daterange = new DatePeriod($begin, $interval ,$end);

							foreach($daterange as $date){

							?>
							
							<th style="font-size: 9pt!important;font-family: calibri!important;border: 1px solid #C8C8C8!important;background: #F8F8F8!important;color: #585858!important;padding: 8px;line-height : 10px!important;" width="5%">
								<center>
									<?php echo $date->format("M d"); ?>
								</center>
							</th>	

							<?php 

							$i++;

							}}else{?>


							<th style="font-size: 9pt!important;font-family: calibri!important;border: 1px solid #C8C8C8!important;background: #F8F8F8!important;color: #585858!important;padding: 8px;line-height : 10px!important;" width="5%">
								<center>
									No Date Found
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
				<td style="border: 1px solid #C8C8C8!important;font-size: 10pt!important;font-family: calibri!important;padding-left: 10px!important;padding-right: 10px!important;background: #F8F8F8;border-top: 1px solid black;box-shadow: 5px 0 5px -5px #333;" data-toggle="popover" data-trigger="focus" data-container="body" data-rel="popover" title="<center><strong style='color: black!important;'><?php echo $sched->full_name; ?></strong></center>" data-placement="right" data-content="
					<center>
						<img src='<?php echo $this->config->item('base_urlmain'); ?>/<?php echo $sched->image_name; ?>' alt='<?php echo $sched->full_name; ?>' style='border-radius:50%;' width=50% height=50%>	

						<br><br> <b style='color: black;'>Period: <?php echo $period_title; ?></b>
						Available Schedules : <br />
					</center>

						<div style='background: #F8F8F8;padding: 5px;border-radius: .5em;'>
						<?php 
								if (count($period) > 0){
								
								$begin = new DateTime($period[0]->pay_period_start);
								$end = new DateTime($period[0]->pay_period_end);
								$end = $end->modify( '+1 day' ); 

								$interval = new DateInterval('P1D');
								$daterange = new DatePeriod($begin, $interval ,$end);

								foreach($daterange as $date){

									foreach($date_schedules as $date_sched){

										if ($date_sched->employee_id == $sched->employee_id){

											if($date_sched->date == $date->format("Y-m-d")){

												if ($date_sched->is_day_off == 1){ 

													echo "<label class='label label-danger' style='margin-left: 5px;'><i class='fa fa-calendar' style='font-size: 6pt;'></i> ".$date->format("M d")." </label>";

												}else{ 

													echo "<label class='label label-success' style='margin-left: 5px;'><i class='fa fa-calendar' style='font-size: 6pt;'></i> ".$date->format("M d").'</label>';

												}

											}

										}

									}

								}}
						?>

					</div>

					" tabindex="0">

					<div style="width: 220px;">
						<?php echo $sched->full_name; ?>
					</div>
					</td>


					<?php 

					if (count($period) > 0){
					
					$begin = new DateTime($period[0]->pay_period_start);
					$end = new DateTime($period[0]->pay_period_end);
					$end = $end->modify( '+1 day' ); 

					$interval = new DateInterval('P1D');
					$daterange = new DatePeriod($begin, $interval ,$end);

					foreach($daterange as $date){

						foreach($date_schedules as $date_sched){

							if ($date_sched->employee_id == $sched->employee_id){

								if($date_sched->date == $date->format("Y-m-d")){

									if ($date_sched->is_day_off == 1){ ?>

										<td style="font-size: 9pt!important;font-family: calibri!important;border-bottom: 1px solid #C8C8C8!important;padding-left: 2px;" width="5%">
											<!-- <div style="background: red;width: 100%;height: 15px;color: #FFF;">
												<center>Day Off</center>
											</div> -->
										</td>	

									<?php

									}else{ ?>

										<td style="font-size: 9pt!important;font-family: calibri!important;border-bottom: 1px solid #C8C8C8!important;padding-left: 2px;" width="5%">
											<div style="background: #27ae60;width: 100%;height: 15px;color: white;-webkit-box-shadow: 0px 0px 5px 0px rgba(148,148,148,1);
-moz-box-shadow: 0px 0px 5px 0px rgba(148,148,148,1);
box-shadow: 0px 0px 5px 0px rgba(148,148,148,1);">
												<center><?php echo $date->format("M d"); ?></center>
											</div>
										</td>	

										<?php

									}

								}

							}


						}


					}}else{?>


					<td style="font-size: 9pt!important;font-family: calibri!important;border: 1px solid #C8C8C8!important;background: #FFF!important;" width="5%">
						<center>
							No Date Found
						</center>
					</td>	
					<?php
					}

					?>


			</tr>
		<?php $a++;}}}}else{?>

			<tr>
				<td colspan="<?php if (count($period) > 0){ echo $total_columns; }else{ echo '3';} ?>" style="border: 1px solid #C8C8C8!important;font-size: 15pt!important;font-family: calibri!important;padding-left: 10px!important;padding-right: 10px!important;padding: 20px!important;">
					<center>No Schedule Found</center>
				</td>
			</tr>

		<?php } ?>
		</tbody>
	</table>
</body>
</html>