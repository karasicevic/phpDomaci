<?php
$connect = mysqli_connect("localhost", "root", "", "restaurants");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	select e.type, e.price, e.numOfGuests, e.date, r.name from event e join restaurant r on e.restaurantId=r.id
	WHERE e.type LIKE '%".$search."%'
	OR e.price LIKE '%".$search."%' 
    OR e.numOfGuests LIKE '%".$search."%'
	OR e.date LIKE '%".$search."%' 
	OR r.name LIKE '%".$search."%' 
	";
}
else
{
	$query = "
	select * from event e join restaurant r on e.restaurantId=r.id";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Name</th>
							<th>Type</th>
							<th>Price</th>
							<th>Number of guests</th>
                            <th>Date</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
				<td>'.$row["name"].'</td>
				<td>'.$row["type"].'</td>                
				<td>'.$row["numOfGuests"].'</td>
				<td>'.$row["price"].'</td>
				<td>'.$row["date"].'</td>
			</tr>
		';
	}
	echo $output;
}
else
{
	echo 'No results!';
}
?>