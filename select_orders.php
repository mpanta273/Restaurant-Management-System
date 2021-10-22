
<!DOCTYPE html>

<html>
<head>
<link rel = "stylesheet"
   type = "text/css"
   href = "index.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<header>
<center>
<h1 id="welcome">Three Hugs Momo Restaurant</h1>
<h2> Tettisputali, Kathmandu </h2>
</center>

<div class="topnav">
    <a class="active" href="index.html">Home</a>
    <a href="select_customers.php">View Our Customers</a>
        <a href="select_chefs.php">View Our Chefs</a>
        <a href="select_foodinfo.php">View Our Menu</a>
        <a href="select_orders.php">See What People Are Ordering</a>
        <a href="add_customer.html" id="new_customer">New Customer? Sign Up!</a>
        <a href="find_customer.html"id="find_customer">Looking For A Momo Mate? Search Customer</a>
  </div>
</header>

<?php
require_once('db_setup.php');
$sql = "USE aachary5_1;";
if ($conn->query($sql) === TRUE) {
} else {
   echo "Error using database: " . $conn->error;
}
// Query:
$sql = "SELECT * FROM Orders";
$result = $conn->query($sql);
if($result->num_rows > 0){

?>
   <table class="table">
   <thead>
      <tr>
         <th scope="col">OrderNo</th>
         <th scope="col">OrderDate</th>
         <th scope="col">CustomerID</th>
      </tr>
  </thead>
<tbody>
<?php
while($row = $result->fetch_assoc()){
?>
      <tr>
          <td><?php echo $row['OrderNo']?></td>
          <td><?php echo $row['OrderDate']?></td>
          <td><?php echo $row['CustomerID']?></td>
      </tr>

<?php
}
}
else {
echo "Nothing to display";
}
?>
</tbody>
    </table>

<?php
$conn->close();
?>


<footer>
<div class="footer">
<a href="about_us.html">About Us</a><br>
<a href="our_news.html">Three Hugs In The News</a><br>
<a href="suggestions.html">Suggestions</a><br>
<a href="privacy_policy.html">Three Hugs Privacy Policy</a><br>
<p> All Rights Reserved. Three Hugs Momo Restaurant. </p>
</div>
</footer>
</body>
</html>
