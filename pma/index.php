<?php
require ("config.php");
if($_POST['action']=='build'){
	$len = count($_POST['field_name']);
	$table=mysqli_escape_string($connection,$_POST["tbl_name"]);
	$query_str = 'CREATE TABLE '.$table.' (';
		if($len>0){
			for ($i=0; $i < $len; $i++) { 
				$field_dtype = "";
				if($_POST['length'][$i]==0){
					$field_dtype = mysqli_escape_string($connection,$_POST['field_name'][$i])." ".mysqli_escape_string($connection,$_POST['data_type'][$i]);
				}else{
					$field_dtype = mysqli_escape_string($connection,$_POST['field_name'][$i])." ".mysqli_escape_string($connection,$_POST['data_type'][$i])."(".mysqli_escape_string($connection,$_POST['length'][$i]).") ";
				}
				if($i!=($len-1)){
					$query_str.=$field_dtype.",";
				}else{
					$query_str.=$field_dtype;
				}
			}
			$query_str.=")";
			// $query_str;
			 mysqli_query($connection,$query_str);
			$error=mysqli_error($connection);
			if($error){
				echo $error;
				exit;
			}else{
				echo "Given table - ".$table." created successfully.";
			}
			
		}
	}
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>PMA</title>
	</head>
	<body>
		<h1 style="text-align: center;">Add Table</h1>
		<div style="width:100%">
			<form style="width:100%" method="post" name="add_frm" id="add_frm">
				<table style="margin-left: auto;margin-right: auto;" id="tbl">
					<?php
					if(!$_POST['action']=='add_cols'){
						?>
						<tr>
							<td>
								<label for="table_name">Table Name</label>
							</td>
							<td>
								<input type="text" name="table_name" id="table_name" onkeyup="check_name(event,this)" />
							</td>
						</tr>
						<tr>
							<td>
								<label for="no_of_columns">No. of Columns:</label>
							</td>
							<td>
								<input type="number" name="no_of_columns" id="no_of_columns">
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align: center;">
								<input type="submit" name="submit" value="Submit">
								<input type="hidden" name="action" value="add_cols">
							</td>
						</tr>
						<?php
					}else{
						?>
						<tr>
							<td>
								<h3>Table Name: <?=$_POST['table_name']?></h3>
								<input type="hidden" name="tbl_name" value="<?=$_POST['table_name']?>">
							</td>

						</tr>
						<?php
						echo "<tr>
						<th>Field Name</th>
						<th>Data Type</th>
						<th>Length</th>
						</tr>";
						for ($i=0; $i < $_POST['no_of_columns']; $i++) { 
							echo "<tr>
							<th><input type='text' name='field_name[]' onkeyup='check_name(event,this)'></th>
							<th><select name='data_type[]' class='dtype".$i."' onChange='show_length(`dtype".$i."`,`lenth".$i."`)'>
							<option value='0'>Select Data Type</option>
							<option value='INT'>Int</option>
							<option value='CHAR'>Char</option>
							<option value='VARCHAR'>Varchar</option>
							<option value='TEXT'>Text</option>
							<option value='DATETIME'>Date time</option>
							<option value='TIMESTAMP'>Time Stamp</option>
							</select></th>
							<th><input class='lenth".$i."' name='length[]' type='number' name='length' id='length'></th>
							</tr>";
						}
						echo '
						<td colspan="3" style="text-align: center;">
						<input type="submit" name="submit" value="Submit">
						<input type="hidden" name="action" value="build">
						</td>';
					}
					?>
				</table>
			</form>
		</div>
		<script>
			function show_length(dtypeCls,lengthCls){
				let dType = document.getElementsByClassName(`${dtypeCls}`)[0].value;
				let ln = document.getElementsByClassName(`${lengthCls}`)[0];
				if((dType=='VARCHAR') || (dType=='INT')){
					ln.removeAttribute('readonly');
				}else{
					ln.value=0;
					ln.setAttribute('readonly',true);
				}
			}
			function check_name(e,el){
				if(e.keyCode==32){
					alert("White spaces are not allowed!");
				}
				el.value = el.value.trim();
			}
		</script>
	</body>
	</html>