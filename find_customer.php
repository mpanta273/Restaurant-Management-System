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
$id = $_POST['id'];
// $Fname = $_POST['Fname'];
// $Lname = $_POST['Lname'];
// $PhoneNum = $_POST['PhoneNum'];
// $Email = $_POST['Email'];
$sql = "SELECT Customer.CustomerID, Fname, Lname, PhoneNum, Email, OrderNo, OrderDate FROM Customer LEFT JOIN Customer_PhoneNum ON Customer.CustomerID = Customer_PhoneNum.CustomerID LEFT JOIN CustomerEmail ON Customer.CustomerID = CustomerEmail.CustomerID LEFT JOIN Orders ON Customer.CustomerID = Orders.CustomerID WHERE Customer.CustomerID = $id;";


#$sql = "SELECT * FROM Students where Username like 'amai2';";
$result = $conn->query($sql);


if($result->num_rows > 0){

//$stmt = $conn->prepare("Select * from Students Where Username like ?");
//$stmt->bind_param("s", $username);
//$result = $stmt->execute();
//$result = $conn->query($sql);
?>
<table class="table">
   <thead>
      <tr>
         <th scope="col">CustomerID</th>
         <th scope="col">Fname</th>
         <th scope="col">Lname</th>
         <th scope="col">PhoneNum</th>
         <th scope="col">Email</th>
         <th scope="col">OrderDate</th>
         <th scope="col">OrderNo</th>
      </tr>
  </thead>
<tbody>
<?php
while($row = $result->fetch_assoc()){
?>
      <tr>
          <td><?php echo $row['CustomerID']?></td>
          <td><?php echo $row['Fname']?></td>
          <td><?php echo $row['Lname']?></td>
          <td><?php echo $row['PhoneNum']?></td>
          <td><?php echo $row['Email']?></td>
          <td><?php echo $row['OrderDate']?></td>
          <td><?php echo $row['OrderNo']?></td>
      </tr>

<?php
}
}
else {
echo "Customer not found";
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

