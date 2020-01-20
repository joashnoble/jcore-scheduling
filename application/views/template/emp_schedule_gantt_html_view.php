<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style type="text/css">
	    table { page-break-inside:auto }
	    tr    { page-break-inside:avoid; page-break-after:auto }
	    thead { display:table-header-group }
	    tfoot { display:table-footer-group }
	    table.tbl_sched_gantt tbody > tr:hover {
	    	cursor: pointer;
	    	background: #FFFFCC;
        }	    	    
	</style>
</head>
<body>

	<table width="100%" style="border-collapse: collapse;padding: 20px;" cellpadding="5" cellspacing="5" class="tbl_sched_gantt">
		<thead>
			<tr>
				<th style="font-size: 9pt;font-family: calibri!important;border: 1px solid #C8C8C8!important;background: #F8F8F8!important;text-align: center!important;" width="5%"><center>#</center></th>
				<th style="font-size: 9pt;font-family: calibri!important;border: 1px solid #C8C8C8!important;background: #F8F8F8!important;padding-left: 10px!important;text-align: left!important;" width="5%">Day</th>

				<th style="font-size: 9pt;font-family: calibri!important;border: 1px solid #C8C8C8!important;background: #F8F8F8!important;padding-left: 10px!important;text-align: left!important;" width="10%">Date</th>

				<?php for ($i=0; $i <= 23; $i++) { ?>
					<th style="font-size: 9pt!important;font-family: calibri!important;border: 1px solid #C8C8C8!important;background: #F8F8F8!important;color: #585858!important;padding: 8px;line-height : 10px!important;" width="3%">
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
								else{ echo $i; }?><br>
							<span style="font-size: 7pt;"><?php if ($i <= 11){ echo 'AM'; } else if($i == 12){ echo 'NN'; } else if($i <= 23){ echo 'PM'; }?></span>
						</center>
					</th>
				<?php } ?>			

			</tr>
		</thead>
		<tbody>
		<?php 
			$a = 1;
			if(count($schedules) > 0){ 

			foreach($schedules as $sched){ 


			?> 
			<tr>
				<td style="border: 1px solid #C8C8C8!important;font-size: 10pt!important;font-family: calibri!important;padding-left: 10px!important;padding-right: 10px!important;background: #F8F8F8;">
					<center>
						<?php echo $a; ?>
					</center>
				</td>
				<td style="border: 1px solid #C8C8C8!important;font-size: 10pt!important;font-family: calibri!important;padding-left: 10px!important;padding-right: 10px!important;background: #F8F8F8;">
					
							
					<div style="height: 40px;position: relative;  ">
						<div style="margin: 0;position: absolute;top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);<?php if($sched->is_day_off == 1){?> color: red;<?php }else if($sched->ref_day_type_id > 1){?> color: green;<?php }?>"><?php echo $sched->day; ?></div>
					</div>

					</td>

				<td style="border: 1px solid #C8C8C8!important;font-size: 10pt!important;font-family: calibri!important;padding-left: 10px!important;padding-right: 10px!important;background: #F8F8F8;box-shadow: 5px 0 5px -5px #333; <?php if($sched->is_day_off == 1){?> color: red;<?php }else if($sched->ref_day_type_id > 1){?> color: green;<?php }?>"><?php echo date("m/d/Y", strtotime($sched->date)); ?> 

					<?php if($sched->is_day_off == 1){?>
						<label class="label label-danger">Day Off</label>
					<?php }else if($sched->ref_day_type_id > 1){?>
						<label class="label label-success"><?php echo $sched->daytype; ?></label>
					<?php }?>

				</td>

					<?php 

					//if($sched->is_day_off == 1){?>

<!-- 							<td colspan="24" style="border: 1px solid #C8C8C8; background: #E5FFE5;">
									<center><b style="font-size: 8pt;color: #27ae60;">DAY OFF</b></center>
							</td> -->
					<?php 
					// }else{
					for ($i=0; $i <= 23; $i++) { 
						?>

						<td style="font-size: 5pt!important;font-family: calibri!important;border-bottom: 1px solid #C8C8C8;">
							
							<div class="<?php
									  if($i == 0){ echo $sched->zero_hidden; } 
									  else if($i == 1){ echo $sched->one_hidden; }
									  else if($i == 2){ echo $sched->two_hidden; }
									  else if($i == 3){ echo $sched->three_hidden; }
									  else if($i == 4){ echo $sched->four_hidden; }
									  else if($i == 5){ echo $sched->five_hidden; }
									  else if($i == 6){ echo $sched->six_hidden; }
									  else if($i == 7){ echo $sched->seven_hidden; }
									  else if($i == 8){ echo $sched->eight_hidden; }
									  else if($i == 9){ echo $sched->nine_hidden; }
									  else if($i == 10){ echo $sched->ten_hidden; }
									  else if($i == 11){ echo $sched->eleven_hidden; }
									  else if($i == 12){ echo $sched->twelve_hidden; }
									  else if($i == 13){ echo $sched->thirteen_hidden; }
									  else if($i == 14){ echo $sched->fourteen_hidden; }
									  else if($i == 15){ echo $sched->fifteen_hidden; }
									  else if($i == 16){ echo $sched->sixteen_hidden; }
									  else if($i == 17){ echo $sched->seventeen_hidden; }
									  else if($i == 18){ echo $sched->eighteen_hidden; }
									  else if($i == 19){ echo $sched->nineteen_hidden; }
									  else if($i == 20){ echo $sched->twenty_hidden; }
									  else if($i == 21){ echo $sched->twentyone_hidden; }
									  else if($i == 22){ echo $sched->twentytwo_hidden; }
									  else if($i == 23){ echo $sched->twentythree_hidden; }?>"

									  style="background: <?php
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

									  padding-top: 7px;
									  width: 100%;height: 20px;color: white;" <?php if($sched->is_day_off == 0 ){?> data-toggle="popover" data-trigger="focus" data-container="body" data-rel="popover" title="<center><strong style='color: black!important;'><?php echo $sched->full_name; ?></strong></center>" data-placement="top" 

							data-content="<center><img src='<?php echo $this->config->item('base_urlmain'); ?>/<?php echo $sched->image_name; ?>' alt='<?php echo $sched->full_name; ?>' style='border-radius:50%;' width=50% height=50%><center><br> <b style='color: black;'><?php echo date('F d, Y', strtotime($sched->date)); ?></b> <br> <span style='color: #27ae60;font-weight: 500;'><?php echo $sched->shift; ?></span> <br> <?php echo $sched->schedule_template_timein.' - '.$sched->schedule_template_timeout; ?>
							"


							 tabindex="0" <?php } ?>>
									<center>
									</center>
								</div>

						</td>
				<?php }//}?>

			</tr>
		<?php $a++;}}else{?>

			<tr>
				<td colspan="27" style="border: 1px solid #C8C8C8!important;font-size: 9pt!important;font-family: calibri!important;padding-left: 10px!important;padding-right: 10px!important;padding: 20px!important;">
					<center>No Schedule Found</center>
				</td>
			</tr>

		<?php } ?>
		</tbody>
	</table>
</body>
</html>