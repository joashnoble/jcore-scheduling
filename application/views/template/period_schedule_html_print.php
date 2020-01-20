<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style type="text/css">
	    table { page-break-inside:auto }
	    tr    { page-break-inside:avoid; page-break-after:auto; border: 1px solid #C8C8C8; }
	    thead { display:table-header-group }
	    tfoot { display:table-footer-group }
	</style>
</head>
<body>
	<?php 

	if ($type == "print"){

		include 'template_header.php';?>
		<div>
			Employee Period Schedule<br/>
			Period : <?php 
				if(count($period) > 0){
					echo date("M d, Y", strtotime($period[0]->pay_period_start)).' - '.date("M d, Y", strtotime($period[0]->pay_period_end));
				}else{
					echo "N/A";
				}
			?>
		</div>
		<br />
	<?php }else if($type == "pdf"){ ?>

		<table width="100%">
			<tr>
				<td width="15%">
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
			Employee Period Schedule<br/>
			Period : <?php 
				if(count($period) > 0){
					echo date("M d, Y", strtotime($period[0]->pay_period_start)).' - '.date("M d, Y", strtotime($period[0]->pay_period_end));
				}else{
					echo "N/A";
				}
			?>
		</div>
		<br />
	<?php }?>
	<table width="100%" style="border-collapse: collapse;padding: 20px;color: black;border: 1px solid #C8C8C8;" cellpadding="5" cellspacing="5">
		
		<thead>
			<tr>
				<th style="font-size: 9pt;font-family: calibri!important;border: 1px solid gray!important;background: #FFF!important;text-align: center!important;" width="1%"><center>#</center></th>
				<th style="font-size: 9pt;font-family: calibri!important;border: 1px solid gray!important;background: #FFF!important;padding-left: 10px!important;text-align: left!important;" width="10%">Employee</th>

					
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
							
							<th style="font-size: 9pt!important;font-family: calibri!important;border: 1px solid gray!important;background: #FFF!important;" width="5%">
								<center>
									<?php echo $date->format("M d"); ?>
								</center>
							</th>	

							<?php 

							$i++;

							}}else{?>


							<th style="font-size: 9pt!important;font-family: calibri!important;border: 1px solid gray!important;background: #FFF!important;" width="5%">
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
						<?php echo $a; ?>
					</center>
				</td>
				<td style="border: 1px solid #C8C8C8!important;font-size: 10pt!important;font-family: calibri!important;padding-left: 10px!important;padding-right: 10px!important;background: #F8F8F8;border-top: 1px solid black;box-shadow: 5px 0 5px -5px #333;"><?php echo $sched->full_name; ?></td>


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

										<td style="font-size: 9pt!important;font-family: calibri!important;border-left: 1px solid #C8C8C8!important;border-right: 1px solid #C8C8C8!important;background: #fff!important;padding: 5px;" width="5%">
											<!-- <div style="background: red;width: 100%;height: 15px;color: #FFF;">
												<center>Day Off</center>
											</div> -->
										</td>	

									<?php

									}else{ ?>

										<td style="font-size: 9pt!important;font-family: calibri!important;border-left: 1px solid #C8C8C8!important;border-right: 1px solid #C8C8C8!important;background: #fff!important;padding: 5px;" width="5%">
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

<script type="text/javascript">
	
window.onload = function () {
    window.print();
}

</script>	
</body>
</html>