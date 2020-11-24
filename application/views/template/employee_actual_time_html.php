<style>
.tdstlye {
	border-bottom: .5px solid lightgray !important;
	padding-bottom: 5px !important;
	padding-top: 5px !important;
}
</style>
<div style="margin: 20px;">
	<?php include 'template_header.php';?>
	<p style="margin-bottom: 2; font-size: 10pt;"><strong>
		Employee Actual Time In/Out
	</strong></p>
	<div style="font-size: 10pt;">
		<table>
			<tr>
				<td><strong>Employee Name :</strong></td>
				<td style="width: 20px; max-width: 20px;"></td>
				<td><?php echo $emp_info[0]->full_name; ?></td>
			</tr>
			<tr>
				<td><strong>Ecode : </strong></td>
				<td></td>
				<td><?php echo $emp_info[0]->ecode; ?></td>
			</tr>
			<tr>
				<td><strong>Branch:</strong> </td>
				<td></td>
				<td></strong> <?php echo $emp_info[0]->branch; ?></td>
			</tr>
			<tr>
				<td><strong>Department:</strong> </td>
				<td></td>
				<td><?php echo $emp_info[0]->department; ?></td>
			</tr>
			<tr>
				<td><strong>Date Period:</strong> </td>
				<td></td>
				<td><?php echo $period; ?> </td>
			</tr>
		</table>
	</div>
	<hr><br />
		<table class="table" style="width:100%; font-size: 12pt;">
			<thead class="thead-inverse">
				<tr>
					<th>Date</th>
					<th>Day</th>
					<th><center>Shift</center></th>
					<th>Day Type</th>
					<th>Time In</th>
					<th>Time Out</th>
					<th style="text-align: right;width: 9%;">Late <br/>(Mins)</th>
					<th style="text-align: right;width: 9%;">Undertime <br/>(Mins)</th>
				</tr>
			</thead>
			<tbody>
					<?php
					$totallate = 0;
					$totalundertime = 0;
					if (count($emp_sched_report) == 0){?>
						<td colspan="8"><center><strong>No Record(s)</strong></center></td>
					<?php } else foreach($emp_sched_report as $row) {
						if ($row->perlate > 0){
							$totallate += $row->perlate;
						}
						if ($row->perundertime > 0){
							$totalundertime += $row->perundertime;
						}
					?>
				<tr>
					<td class="tdstlye"><?php echo date("m/d/Y",strtotime($row->date)); ?></td>
					<td class="tdstlye"><?php echo $row->day; ?></td>
					<td class="tdstlye"><center><?php echo $row->shift; ?></center></td>
					<td class="tdstlye"><?php echo $row->daytype; ?></td>
					<td class="tdstlye">
						<?php echo ($row->clock_in != "" && $row->clock_in != "0000-00-00 00:00:00") ? date("h:i a", strtotime($row->clock_in)) : '00:00'; ?>
					</td>
					<td class="tdstlye">
						<?php echo ($row->clock_out != "" && $row->clock_out != "0000-00-00 00:00:00") ? date("h:i a", strtotime($row->clock_out)) : '00:00'; ?>
					</td>
					<td class="tdstlye" align="right">
						<?php if ($row->perlate > 0){ echo number_format($row->perlate,2); }else{ echo '0'; }?>
					</td>
					<td class="tdstlye" align="right">
						<?php if ($row->perundertime > 0){ echo number_format($row->perundertime,2); }else{ echo '0'; } ?>
					</td>
				</tr>
			<?php } ?>
			<?php if (count($emp_sched_report) != 0){?>
				<tr>
					<td colspan="5"></td>
					<td style="text-align: right;"><center><strong>Total:</strong> </center></td>
					<td style="font-weight:bold;color:#27ae60 !important;" align="right"><?php echo number_format($totallate,2); ?></td>
					<td style="font-weight:bold;color:#27ae60 !important;" align="right"><?php echo number_format($totalundertime,2); ?></td>
				</tr>
			<?php } ?>
			</tbody>
	</table>
</div>
