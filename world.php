<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
$count = $_GET['country'];
$country = filter_var($count, FILTER_SANITIZE_STRING);
$context = filter_input(INPUT_GET,"context", FILTER_SANITIZE_STRING);
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if ($context == "cities") {
	$stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities INNER JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE '%$country%'");
}
else 
{
	$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php if ($context == "cities"): ?>
	<table>
		<tr>
			<th>Name</th>
			<th>District</th>
			<th>Population</th>
		</tr>
	<?php foreach ($results as $row): ?>
		<tr>
	  		<td><?= $row['name'];?></td>
	  		<td><?= $row['district'];?></td>
	  		<td><?= $row['population'];?></td>
	  	</tr>
	<?php endforeach; ?>
	</table>
<?php endif;?>

<?php if ($context != "cities"): ?>
<table>
	<tr>
		<th>Country Name</th>
		<th>Continent</th>
		<th>Year of Independence</th>
		<th>Head of State</th>
	</tr>
<?php foreach ($results as $row): ?>
	<tr>
  		<td><?= $row['name'];?></td>
  		<td><?= $row['continent'];?></td>
  		<td><?= $row['independence_year'];?></td>
  		<td><?= $row['head_of_state']; ?></td>
  	</tr>
<?php endforeach; ?>
</table>
<?php endif;?>