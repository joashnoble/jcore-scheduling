<style type="text/css">
	#tbl_personal_info{
		border-collapse: collapse !important; border: 1px solid #455A64 !important; width: 100% !important;
	}
	#tbl_personal_info td{
		padding: 8px !important;
		border: 1px solid #455A64 !important;
	}
	#tbl_personal_info2{
		border-collapse: collapse !important; border-left: 1px solid #455A64 !important;
		border-right: 1px solid #455A64 !important; border-bottom: 1px solid #455A64 !important; width: 100% !important;
	}
	#tbl_personal_info2 td{
		border-bottom: 1px solid #455A64 !important;
		border-right: 1px solid #455A64 !important;
		padding: 8px !important;
	}
	#tbl_contact_info{
		border-collapse: collapse !important; border: 1px solid black !important; width: 100% !important; margin-top: 10px !important;
	}
	#tbl_contact_info td{
		padding: 8px !important;
		border: 1px solid #455A64 !important;
	}
	#thead-pinfo{
		background: #CFD8DC !important;
		font-weight: bold !important;
	}
	#thead-cinfo{
		background: #CFD8DC !important;
		font-weight: bold !important;
	}
	.th-info{
		background: #ECEFF1 !important;
		border-bottom: 2px solid #78909C !important;
	}
	#img-emp{
		object-fit: fill !important;
		height: 100%;
		width: 100%;
	}
	#img-td{
		width: 100px;
		height: 100px;
	}
</style>
	<div style="">
		<div class="col-md-12">
			<div class="row">
				<div class="div-tables">
					<div style="margin: 20px;">
						<div style="font-size: 11pt;">
							<?php include 'template_header.php';?>
							<strong>
								Personnel 201 Record <br />
							</strong>
						</div>
					<hr>
					<br />
					<table id="tbl_personal_info">
					<tr>
						<td colspan="3" id="thead-pinfo">Personal Information</td>
					</tr>
					<?php foreach($employee as $row){?>
					<tr>
						<td colspan="2"><strong>Name:</strong> <?php echo $row->fullname;?></td>
						<td rowspan="2" width="20%" height="50%" id="img-td">
							<center>
								<img src="/hrispayroll/<?php echo $row->image_name; ?>" id="img-emp">
							</center>
						</td>
					</tr>
					<tr>
						<td colspan="2"><strong>Address:</strong> 
							<?php 
								if ($row->fulladdress == ""){
									echo "N/A";
								}else{
									echo $row->fulladdress;
								}
							?></td>
					</tr>
				</table>

				<table id="tbl_personal_info2">
					<tr>
						<td colspan="2"><strong>Tel # (Mobile):</strong> 
							<?php 
								if ($row->cell_number == "" AND $row->telphone_number ==""){
									echo "N/A";
								}

								if ($row->cell_number > 0){
									echo $row->cell_number;
								}

								if  ($row->telphone_number > 0){
									echo ' / '.$row->telphone_number;
								}else{
									echo $row->telphone_number;
								}
							?>
						</td>
						<td><strong>Birthdate:</strong> 
							<?php 
							if  ($row->birthdate == ""){
								echo "N/A";
							}else{
								echo date('m-d-Y', strtotime($row->birthdate));
							}?>
						</td>
					</tr>
					<tr>
						<td><strong>SSS #: </strong>
							<?php 
							if  ($row->sss == ""){
								echo "N/A";
							}else{
								echo $row->sss;
							}?></td>
						<td><strong>TIN #: </strong>
							<?php 
							if  ($row->tin == ""){
								echo "N/A";
							}else{
								echo $row->tin;
							}?></td>
						<td><strong>Pilhealth:</strong>
							<?php 
							if  ($row->phil_health == ""){
								echo "N/A";
							}else{ 
								echo $row->phil_health;
							}?></td>
					</tr>
					<tr>
						<td colspan="2"><strong>Pagibig:</strong> 
							<?php 
							if  ($row->pag_ibig == ""){
								echo "N/A";
							}else{ 
								echo $row->pag_ibig;
							}?></td>
						<td><strong>Bank Account:</strong> 
							<?php 
							if  ($row->bank_account == ""){
								echo "N/A";
							}else{ 
								echo $row->bank_account;
							}?></td>
					</tr>
					<?php }?>
				</table>

				<table id="tbl_contact_info">
					<tr>
						<td colspan="4" id="thead-cinfo">Contract Information</td>
					</tr>
					<tr>
						<td class="th-info"><strong>Contract</strong></td>
						<td class="th-info"><strong>Position</strong></td>
						<td class="th-info"><strong>Rate</strong></td>
						<td class="th-info"><strong>Rate Type</strong></td>
					</tr>
					<?php if (count($duties) > 0){?>
					<?php foreach($duties as $rowd){?>
					<tr>
						<td><?php echo date('m-d-Y',strtotime($rowd->date_start));?></td>
						<td><?php echo $rowd->position;?></td>
						<td align="right">&#8369;<?php echo number_format($rowd->salary_reg_rates,2);?></td>
						<td><?php echo $rowd->payment_type;?></td>
					</tr>
					<?php }}else{?>
					<tr>
						<td colspan="4"><center>No data Available</center></td>
					</tr>
					<?php }?>
				</table>

				<table id="tbl_contact_info">
					<tr>
						<td colspan="4" id="thead-cinfo">Memos (Disciplines)</td>
					</tr>
					<tr>
						<td class="th-info"><strong>Date</strong></td>
						<td class="th-info"><strong>Violation</strong></td>
						<td class="th-info"><strong>Disciplinary Action</strong></td>
					</tr>
					<?php if (count($memos) > 0){?>
					<?php foreach ($memos as $rowm){?>
					<tr>
						<td><?php echo date('m-d-Y',strtotime($rowm->date_memo));?></td>
						<td><?php echo $rowm->remarks;?></td>
						<td><?php echo $rowm->disciplinary_action_policy;?></td>
					</tr>
					<?php }}else{?>
					<tr>
						<td colspan="3"><center>No data Available</center></td>
					</tr>
					<?php }?>
				</table>

				<table id="tbl_contact_info">
					<tr>
						<td colspan="4" id="thead-cinfo">Commendation</td>
					</tr>
					<tr>
						<td class="th-info"><strong>Date</strong></td>
						<td class="th-info"><strong>Memo</strong></td>
						<td class="th-info"><strong>Action</strong></td>
					</tr>
					<?php if (count($commendation) > 0){?>
					<?php foreach ($commendation as $rowc){?>
					<tr>
						<td><?php echo date('m-d-Y',strtotime($rowc->date_commendation));?></td>
						<td><?php echo $rowc->memo_number;?></td>
						<td><?php echo $rowc->remarks;?></td>
					</tr>
					<?php }}else{?>
					<tr>
						<td colspan="3"><center>No data Available</center></td>
					</tr>
					<?php }?>
				</table>

				<table id="tbl_contact_info">
					<tr>
						<td colspan="4" id="thead-cinfo">Seminars &amp; Training</td>
					</tr>
					<tr>
						<td class="th-info"><strong>Date</strong></td>
						<td class="th-info"><strong>Course Taken (Title)</strong></td>
						<td class="th-info"><strong>Certificate / Achievement</strong></td>
						<td class="th-info"><strong>Venue</strong></td>
					</tr>
					<?php if (count($seminars) > 0){?>
					<?php foreach ($seminars as $rows){?>
					<tr>
						<td><?php echo date('m-d-Y',strtotime($rows->date_from));?></td>
						<td><?php echo $rows->seminar_title;?></td>
						<td><?php echo $rows->certificate;?></td>
						<td><?php echo $rows->venue;?></td>
					</tr>
					<?php }}else{?>
					<tr>
						<td colspan="4"><center>No data Available</center></td>
					</tr>
					<?php }?>
				</table>
				</div>
			</div>
		</div>
	</div>
	
<!-- 
</div>
 -->