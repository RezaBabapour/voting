<?php
require_once 'connect.inc.php';
if (isset($_GET['ElectionName']) && !empty($_GET['ElectionName'])) {
	$ElectionName = $_GET['ElectionName'];
	$A = $_GET['A'];
	$B = $_GET['B'];
	$C = $_GET['C'];
	$D = $_GET['D'];
	unset($_GET);
	$_GET['ElectionName'] = '';
	$query = "INSERT INTO `election` (`id`, `name`, `active`, `a`, `b`, `c`, `d`, `ac`, `bc`, `cc`, `dc`, `uc`) VALUES (NULL, '$ElectionName', '1', '$A', '$B', '$C', 'D', '0', '0', '0', '0', '0')";
	$result = mysqli_query($link,$query);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Voting</title>
	<link rel="stylesheet" type="text/css" href="../css/common.css">
</head>
<body>
	<form>
		<fieldset>
			<legend align=center>Add Election</legend>
			<input type="text" name="ElectionName" placeholder="Enter Election Title" required/>
			<input type="text" name="A" placeholder="Enter First Candidate" required/>
			<input type="text" name="B" placeholder="Enter Second Candidate" required/>
			<input type="text" name="C" placeholder="Enter Third Candidate" required/>
			<input type="text" name="D" placeholder="Enter Fourth Candidate" required/>
			<button type="submit" name="submit">Submit</button>
		</fieldset>
	</form>
	<?php
		$query = "SELECT * FROM `election` WHERE 1";
		$result = mysqli_query($link,$query);
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
			$rows[] = $r;
		}
	?>
	<form>
		<fieldset>
			<legend>Election List</legend>
			<table>
				<tr>
					<th>Election Name</th>
					<th>First Candidate</th>
					<th>Second Candidate</th>
					<th>Third Candidate</th>
					<th>Fourth Candidate</th>
				</tr>
			<?php
				for ($i=0; $i < count($rows); $i++) { 
					echo "<tr>";
					echo '<td><input type="radio" name="radio" value="">'.$rows[$i]['name'].'</td>';
					echo '<td>'.$rows[$i]['a'].' : '.$rows[$i]['ac'].'</td>';
					echo '<td>'.$rows[$i]['b'].' : '.$rows[$i]['bc'].'</td>';
					echo '<td>'.$rows[$i]['c'].' : '.$rows[$i]['cc'].'</td>';
					echo '<td>'.$rows[$i]['d'].' : '.$rows[$i]['dc'].'</td>';
					echo "</tr>";
				}
			?>
			</table>
			<br>
			<button type="submit" name="delete">Delete</button>
		</fieldset>
	</form>


<!-- SELECT * FROM `election` WHERE 1 -->

</body>
</html>