<style type="text/css">
	#tbl_break{
		width: 100%;
		border-collapse: collapse;
	}

	#tbl_break th, #tbl_break td{
		border: 0px!important;
		padding: 10px;
		font-size: 10pt;
	}

	#tbl_break th{
		border-bottom: 1px solid #CFD8DC!important;
	}

	#tbl_break td{
		border-bottom: 1px solid #F5F5F5!important;
	}	
	.tdstyle {
		border-bottom: .5px solid lightgray !important;
		padding-bottom: 5px !important;
		padding-top: 5px !important;
	}
</style>

<div style="margin: 20px; ">
	<?php include 'template_header.php';?>
	<p style="margin-bottom: 2; font-size: 10pt;">
		<strong>
			Employee Break In/Out
		</strong>
	</p>
	<div style="font-size: 10pt;">
		<table>
			<tr>
				<td style="border: 0px!important;"><strong>Employee Name :</strong></td>
				<td style="width: 20px; max-width: 20px;border: 0px!important;"></td>
				<td style="border: 0px!important;"><?php echo $emp_info[0]->full_name; ?></td>
			</tr>
			<tr>
				<td style="border: 0px!important;"><strong>Ecode : </strong></td>
				<td style="border: 0px!important;"></td>
				<td style="border: 0px!important;"><?php echo $emp_info[0]->ecode; ?></td>
			</tr>
			<tr>
				<td style="border: 0px!important;"><strong>Branch:</strong> </td>
				<td style="border: 0px!important;"></td>
				<td style="border: 0px!important;"></strong> <?php echo $emp_info[0]->branch; ?></td>
			</tr>
			<tr>
				<td style="border: 0px!important;"><strong>Department:</strong> </td>
				<td style="border: 0px!important;"></td>
				<td style="border: 0px!important;"><?php echo $emp_info[0]->department; ?></td>
			</tr>
			<tr> 
				<td style="border: 0px!important;"><strong>Date Period:</strong> </td>
				<td style="border: 0px!important;"></td>
				<td style="border: 0px!important;"><?php echo $period; ?> </td>
			</tr>
		</table>
	</div>
	<hr><br />
	<table id="tbl_break">
		<thead class="thead-inverse">
			<tr>
				<th style="width:15%;">Date</th>
				<th style="width:15%;">Day</th>
				<th style="width:15%;">Shift</th>
				<th style="width:15%;"><center>Break Time</center></th>
				<th style="width:15%;"><center>Break Out</center></th>
				<th style="width:15%;"><center>Break In</center></th>
				<th style="width:15%;"><center>Late (Mins)</center></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$totallate = 0; 
				if(count($emp_break_report) > 0){
				foreach($emp_break_report as $row){

				$totallate += $row->break_late;

				$oTime   = new DateTime($row->break_time);
				$aOutput = array();
				if ($oTime->format('G') > 0) {
				    $aOutput[] = $oTime->format('G') . ' hrs';
				}
				$aOutput[] = $oTime->format('i') . ' min';
				// $aOutput[] = $oTime->format('s') . ' sec';
				$break_time = implode(', ', $aOutput);

				?>

				<tr>
					<td class="tdstyle"><?php echo date("m/d/Y",strtotime($row->date)); ?></td>
					<td class="tdstyle"><?php echo $row->day; ?></td>
					<td class="tdstyle"><?php echo $row->shift; ?></td>
					<td class="tdstyle"><center><?php echo $break_time; ?></center></td>
					<td class="tdstlye"><center><?php echo ($row->break_out != "" && $row->break_out != "0000-00-00 00:00:00") ? date("h:i a", strtotime($row->break_out)) : '00:00'; ?></center></td>
					<td class="tdstlye"><center><?php echo ($row->break_in != "" && $row->break_in != "0000-00-00 00:00:00") ? date("h:i a", strtotime($row->break_in)) : '00:00'; ?></center></td>
					<td class="tdstlye"><center><?php echo $row->break_late; ?></center></td>
				</tr>


			<?php }}else{?>
				<tr>
					<td colspan="7">
						<center>
							No Data Available
						</center>
					</td>
				</tr>
			<?php }?>
			<?php if (count($emp_break_report) != 0){?>
				<tr>
					<td colspan="5"></td>
					<td style="text-align: right;"><center><strong>Total:</strong> </center></td>
					<td style="font-weight:bold;color:#27ae60 !important;"><center><?php echo number_format($totallate,2); ?></center></td>
					<td></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>