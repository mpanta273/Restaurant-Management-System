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

            // $id_refnumber = $_POST['refnumber'];
            // $id_quantity = $_POST['quantity'];
            // Query:
                $customer_email = $_POST['customer_email'];
                $customer_phonenum = $_POST['customer_phonenum'];
                // INSERT INTO Contain(OrderNo, ItemName, Quantity) SELECT (SELECT MAX(OrderNo) FROM Orders), ItemName, Quantity FROM Cart;
                
                // if (($customer_phonenum)){
                    $sql_select_customer = "SELECT Customer_PhoneNum.CustomerID FROM Customer_PhoneNum, CustomerEmail WHERE Customer_PhoneNum.PhoneNum = '$customer_phonenum' AND CustomerEmail.Email = '$customer_email' AND CustomerEmail.CustomerID = Customer_PhoneNum.CustomerID";
                    $result_select_customer = $conn->query($sql_select_customer);
                    if($result_select_customer->num_rows > 0){
                        $sql_insert_order = "INSERT INTO Orders (OrderDate, CustomerID) VALUES (NOW(), (SELECT Customer_PhoneNum.CustomerID FROM Customer_PhoneNum, CustomerEmail WHERE Customer_PhoneNum.PhoneNum = '$customer_phonenum' AND CustomerEmail.Email = '$customer_email' AND CustomerEmail.CustomerID = Customer_PhoneNum.CustomerID));";
                    $result_insert_order = $conn->query($sql_insert_order);
                    if ($result_insert_order == TRUE){
                    //    echo "insertion into order completed successfully.";
                    }else{
                     //   echo "insertion into order failed.";
                    }
                    $sql_insert_contain = "INSERT INTO Contain(OrderNo, ItemName, Quantity) SELECT (SELECT MAX(OrderNo) FROM Orders), ItemName, Quantity FROM Cart";
                    $result_insert_contain = $conn->query($sql_insert_contain);
                    if ($result_insert_contain == TRUE){
                     //   echo "insertion into contain completed successfully.";
                        echo "<center><h1>We have received your order. We will contact you soon!</h1></center>";
                    }else{
                     //   echo "insertion into contain failed.";
                    }
?>

                    <h3> View Your Order Information Below </h3>
                    <!-- <form action=""></form> -->

                    <?php
                        $sql_select_order = "SELECT Orders.OrderNo, OrderDate, ItemName, Quantity FROM Orders, Contain WHERE Orders.OrderNo = (SELECT MAX(OrderNo) FROM Orders) AND Contain.OrderNo = Orders.OrderNo";
                        $result_select_order = $conn->query($sql_select_order);
                        if($result_select_order->num_rows > 0){
                    ?>
                    <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">OrderNo</th>
                            <th scope="col">OrderDate</th>
                            <th scope="col">ItemName</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        while($row = $result_select_order->fetch_assoc()){
                    ?>
                        <tr>
                            <td><?php echo $row['OrderNo']?></td>
                            <td><?php echo $row['OrderDate']?></td>
                            <td><?php echo $row['ItemName']?></td>
                            <td><?php echo $row['Quantity']?></td>
                        </tr>

                    <?php
                        }
                        $total_price = "SELECT SUM(Quantity * Price) AS Price FROM Cart";
                        $result_total_price = $conn->query($total_price);
                        if($result_total_price->num_rows > 0){
                        ?>
                        <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Total Amount Charged</th>
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
			$drop_cart = "DELETE FROM Cart";
			$result_drop_cart = $conn->query($drop_cart);
                        ?>
                    <?php
                    }else{
                        //    echo "Error. Your order could not be displayed.";
                        }
                
                    } else{
                        echo "Your account information does not exist. Please sign up.";
                    }
                    ?>

<?php
$conn->close();
?>

</tbody>
</table>


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

