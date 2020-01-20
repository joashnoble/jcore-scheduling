
<style type="text/css">
	table td, table th{
		padding: 7px!important;
		font-size: 9pt!important;
	}

	table td{
		border-bottom: 1px solid lightgray!important;
	}

</style>
<div>
	<form class="summary_transfer">
	<div style="font-size: 11pt;">
	<?php include 'template_header.php';?>
		<strong>
			Daily Time Record (Summary) <br />
			Period Covered : <?php if(count($period)!=0){
				echo $period[0]->payperiod;
				echo "<input type='hidden' value='".$period[0]->pay_period_id."' name='pay_period_id'>";
			}
			else{
				echo "n/a";
			}

			?>
		</strong>
		<hr><br />
	</div>

			<?php
					$count=1;
					if(count($scheddtrsummary)!=0){
			?>
					<table class="table table-striped" style="width:100%;padding: 20px!important;" cellspacing="5" cellpadding="5">
						<thead class="thead-inverse" style="text-align:left;">
							<tr>
								<th>#</th>
								<th>Ecode</th>
								<th style="width: 150px!important;">Name</th>
								<th><center>Total (Hours)</center></th>
								<th><center>Total Late <br/> (Minutes)</center></th>
								<th><center>Total Undertime <br/> (Minutes)</center></th>
								<th><center>Total Excess Break <br/> (Minutes)</center></th>
								<th>Regular Day</th>
								<th>Regular Sunday</th>
								<th>Rest Day</th>
								<th>Regular Holiday</th>
								<th>Special Holiday</th>
								<th>Sunday Reg. Holiday</th>
								<th>Sunday Spe. Holiday</th>
								<th>Regular O.t</th>
								<th>Sunday O.t</th>
								<th>Regular Hol. O.t</th>
								<th>Spe Hol. O.t</th>
								<th>Sunday Reg. Hol. O.t</th>
								<th>Sunday Spe. Hol. O.t</th>
								<th>Regular NSD</th>
								<th>Regular Sun. NSD</th>
								<th>Regular Hol. NSD</th>
								<th>Special Hol. NSD</th>
								<th>Sunday Regular Hol. NSD</th>
								<th>Sunday Special Hol. NSD</th>
							</tr>
						</thead>
						<tbody>
			<?php
								foreach($scheddtrsummary as $result){
											echo "<tr>";
											echo "<td><input type='hidden' value='".$result->employee_id."' name='employee_id[]'>".$count."</td>";
											echo "<td>".$result->ecode."</td>";
											echo "<td style='width: 150px!important;'>".$result->fullname."</td>";
											echo "<td><input type='hidden' value='".$result->newhour."' name='newhour[]'><center>".number_format($result->newhour,2)."</center></td>";

											echo "<td><input type='hidden' value='".$result->timelate."' name='minutes_late[]'><center>".number_format($result->timelate,2)."</center></td>";

											echo "<td><input type='hidden' value='".$result->timeundertime."' name='minutes_undertime[]'><center>".number_format($result->timeundertime,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->excess_break."' name='minutes_excess_break[]'><center>".number_format($result->excess_break,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->regular_day."' name='reg[]'><center>".number_format($result->regular_day,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->regular_sunday."' name='sun[]'><center>".number_format($result->regular_sunday,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->day_off."' name='day_off[]'><center>".number_format($result->day_off,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->regular_holiday."' name='reg_hol[]'><center>".number_format($result->regular_holiday,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->special_holiday."' name='spe_hol[]'><center>".number_format($result->special_holiday,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->sunday_regular_holiday."' name='sun_reg_hol[]'><center>".number_format($result->sunday_regular_holiday,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->sunday_special_holiday."' name='sun_spe_hol[]'><center>".number_format($result->sunday_special_holiday,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->regular_ot."' name='ot_reg[]'><center>".number_format($result->regular_ot,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->sunday_ot."' name='ot_sun[]'><center>".number_format($result->sunday_ot,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->regular_hol_ot."' name='ot_reg_reg_hol[]'><center>".number_format($result->regular_hol_ot,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->special_hol_ot."' name='ot_reg_spe_hol[]'><center>".number_format($result->special_hol_ot,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->sunday_regular_hol_ot."' name='ot_sun_reg_hol[]'><center>".number_format($result->sunday_regular_hol_ot,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->sunday_special_hol_ot."' name='ot_sun_spe_hol[]'><center>".number_format($result->sunday_special_hol_ot,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->regular_nsd."' name='nsd_reg[]'><center>".number_format($result->regular_nsd,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->regular_sunday_nsd."' name='nsd_sun[]'><center>".number_format($result->regular_sunday_nsd,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->regular_hol_nsd."' name='nsd_reg_reg_hol[]'><center>".number_format($result->regular_hol_nsd,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->special_hol_nsd."' name='nsd_reg_spe_hol[]'><center>".number_format($result->special_hol_nsd,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->sunday_regular_hol_nsd."' name='nsd_sun_reg_hol[]'><center>".number_format($result->sunday_regular_hol_nsd,2)."</center></td>";
											echo "<td><input type='hidden' value='".$result->sunday_special_hol_nsd."' name='nsd_sun_spe_hol[]'><center>".number_format($result->sunday_special_hol_nsd,2)."</center></td>";
											echo "</tr>";
										$count++;

 					 			}

							}
							else{
								echo "<center><h3>No Data</h3></center>";
							}

			?>
</tbody>
</table>
	</form>
</div>
