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
        <a href="add_to_cart.php">Make An Order</a>
        <a href="select_cart.php">View Cart</a>
        <a href="add_customer.html" id="new_customer">New Customer? Sign Up!</a>
        <a href="find_customer.html"id="find_customer">Search Customer</a>
  </div>
</header>

<?php
require_once('db_setup.php');
$sql = "USE aachary5_1;";
if ($conn->query($sql) === TRUE) {
   // echo "using Database tbiswas2_company";
} else {
   echo "Error using  database: " . $conn->error;
}
// Query:
$sql = "SELECT * FROM Cart";
$result = $conn->query($sql);
if($result->num_rows > 0){

?>
   <table class="table">
   <thead>
      <tr>
         <th scope="col">Reference Number</th>
         <th scope="col">Item Name</th>
         <th scope="col">Quantity</th>
         <th scope="col">Price</th>
      </tr>
  </thead>
<tbody>

<?php
while($row = $result->fetch_assoc()){
?>
      <tr>
          <td><?php echo $row['CartID']?></td>
          <td><?php echo $row['ItemName']?></td>
          <td><?php echo $row['Quantity']?></td>
          <td><?php echo $row['Price']?></td>
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
$total_price = "SELECT SUM(Quantity * Price) AS Price FROM Cart";
$result_total_price = $conn->query($total_price);
if($result_total_price->num_rows > 0){
?>
<table class="table">
   <thead>
      <tr>
         <th scope="col">Total Price</th>
      </tr>
  </thead>
<tbody>

<?php
while($row = $result_total_price->fetch_assoc()){
?>
      <tr>
          <td><?php echo $row['Price']?></td>
      </tr>

<?php
}
?>

<?php 
}
?>


<?php
$conn->close();
?>

</tbody>
</table>

<form action="add_to_cart.php" method="post" class="mb-3">
<input type="submit" name="submit" value="Add More Items">
</form>

<form action="update_quantity.html" method="post" class="mb-3">
<input type="submit" name="submit" value="Update or Delete Items">
</form>

<form action="checkout.html" method="post" class="mb-3">
<input type="submit" name="submit" value="Checkout">
</form>

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

