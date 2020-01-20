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
</style>

<div style="margin: 20px; ">
	<div style="font-size: 11pt;">
		<?php include 'template_header.php';?>

		<strong>
			Employee Break Report <br />
			Date: <?php echo date('F j, Y', strtotime($schedule_date)); ?>
		</strong>
	</div>
<hr>
<br />
	<table id="tbl_break">
		<thead class="thead-inverse">
			<tr>
				<th style="width:20%;">Employee</th>
				<th style="width:15%;">Break Time</th>
				<th style="width:20%;">Break Out</th>
				<th style="width:20%;">Break In</th>
				<th style="width:15%;">Late (Mins)</th>
			</tr>
		</thead>
<?php

	if (count($employee_id) > 0){
	 foreach($employee_id as $row){
	 	echo "<tr>";
	 	echo "<td style='font-weight:bold;border-bottom:2px solid black;'>".$row->full_name."</td>";
	 	echo "<td colspan='5' style='border-bottom:2px solid black;'></td>";

		// DATE_FORMAT(employee_break.break_out,"%H:%i:%s") AS break_out, DATE_FORMAT(employee_break.break_in,"%H:%i:%s") AS break_in

	 		$this->db->where('employee_list.employee_id', $row->employee_id);
	 		$this->db->where('schedule_employee.date', $schedule_date);
		 	$this->db->select('employee_break.*,CONCAT(employee_list.first_name," ",employee_list.middle_name," ",employee_list.last_name) AS full_name, employee_list.ecode, ');
			$this->db->from('employee_break');
			$this->db->join('schedule_employee', 'schedule_employee.schedule_employee_id = employee_break.schedule_employee_id');
			$this->db->join('employee_list','employee_list.employee_id = schedule_employee.employee_id');
			$this->db->order_by("full_name", "asc");
			$query = $this->db->get();

				if($query->num_rows() != 0){
					foreach($query->result() as $row){
						echo "<tr>";
						echo "<td></td>";
						echo "<td>".$row->break_time."</td>";
						echo "<td>".$row->break_out."</td>";
						echo "<td>".$row->break_in."</td>";
						echo "<td>".$row->break_late."</td>";
						echo "</tr>";
					}
				}
				else{
						echo "<tr><td></td><td></td><td>No Result</td></tr>";
				}

			echo "</tr>";
	 	}
	 }else{
	 	echo "<tr>";
	 	echo "<td colspan='7'><center>No Data Available</center></td>";
	 	echo "</tr>";
	 }
?>
</table>