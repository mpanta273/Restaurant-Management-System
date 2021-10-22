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
                // pass
            } else {
               echo "Error using  database: " . $conn->error;
            }

            $id_refnumber = $_POST['refnumber'];

                
                if (is_numeric($id_refnumber) and ($id_refnumber > 0)){
                    $sql_select_cart = "SELECT * FROM Cart WHERE CartID = $id_refnumber";
                    $result_select_cart = $conn->query($sql_select_cart);
                    if($result_select_cart->num_rows > 0){
                        $sql_cart = "DELETE FROM Cart WHERE CartID = $id_refnumber;";
                        $result_cart = $conn->query($sql_cart);
                            echo "Deleted cart item successfully";
                            echo "<br>"; 
                    }else{
                        echo "A record with the given reference number was not found.";
                    }
                }else{
                    echo "Error. Invalid Reference Number.";
                }
?>

<?php
$conn->close();
?>

<h2> View Cart </h2>
<form action="select_cart.php" method="post" class="mb-3">
<input type="submit" name="submit" value="View Cart">


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
