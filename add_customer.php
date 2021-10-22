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
$Fname = $_POST['Fname'];
$Lname = $_POST['Lname'];
$Email = $_POST['Email'];
$PhoneNum = $_POST['PhoneNum'];
$sql_validate_email = "SELECT * FROM CustomerEmail, Customer_PhoneNum WHERE CustomerEmail.Email = '$Email' AND Customer_PhoneNum.PhoneNum = '$PhoneNum'";
$result_validate_email = $conn->query($sql_validate_email);

if ($result_validate_email->num_rows > 0){
echo "A customer with that email and phonenum already exists. Please sign up with a different email or phone number.";

}else{

$sql_customer = "INSERT IGNORE INTO Customer (Fname, Lname) values ('$Fname', '$Lname');";
// $sql_phonenum = "INSERT IGNORE INTO Customer_PhoneNum (PhoneNum) values ('$PhoneNum');";
$sql_phonenum = "INSERT IGNORE INTO Customer_PhoneNum SELECT MAX(CustomerID), '$PhoneNum' FROM Customer WHERE Fname = '$Fname' AND Lname = '$Lname'";
// $sql_email = "INSERT IGNORE INTO CustomerEmail (Email) values ('$Email');";
$sql_email = "INSERT IGNORE INTO CustomerEmail SELECT MAX(CustomerID), '$Email' FROM Customer WHERE Fname = '$Fname' AND Lname = '$Lname'";
$result_customer = $conn->query($sql_customer);

if ($result_customer === TRUE) {
    echo "Customer added to the database successfully.";
    echo "<br>";



$result_phonenum = $conn->query($sql_phonenum);

if ($result_phonenum === TRUE) {
    echo "Phone Number added successfully.";
    echo "<br>";

$result_email = $conn->query($sql_email);

if ($result_email === TRUE) {
    echo "Email added successfully.";
    echo "<br>";
}}}

}

?>

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
