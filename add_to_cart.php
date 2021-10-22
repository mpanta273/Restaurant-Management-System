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
<div class="container mt-5">
        <form action="add_to_cart.php" method="post" class="mb-3">
          <div class="select-block">
	<center>

           <h3>Please choose an option and a quantity and  press the 'add to cart' button.</h3>
            <select name="cart-food-items">
              <option value="" disabled selected>Choose option</option>
              <option value="Steamed Chicken">Steamed Chicken</option>
              <option value="Kothe Chicken">Kothe Chicken</option>
              <option value="Fried Chicken">Fried Chicken</option>
              <option value="Kothe Chicken">Kothe Chicken</option>
              <option value="Jhol Chicken">Jhol Chicken</option>
              <option value="Steamed Vegetable">Steamed Vegetable</option>
              <option value="Kothe Vegetable">Kothe Vegetable</option>
              <option value="Fried Vegetable">Fried Vegetable</option>
              <option value="Jhol Vegetable">Jhol Vegetable</option>
              <option value="Steamed Paneer">Steamed Paneer</option>
              <option value="Fried Paneer">Fried Paneer</option>
              <option value="Kothe Paneer">Kothe Paneer</option>
              <option value="Jhol Paneer">Jhol Paneer</option>
            </select>
<select name="cart-quantity">
            <option value="" disabled selected>Choose Quantity</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            </select>
	</center>
          </div>

        <center><input type="submit" name="submit" value="Add To Cart"></center>
        </form>

      </div>
      <?php
            require_once('db_setup.php');
            $sql = "USE aachary5_1;";
            if ($conn->query($sql) === TRUE) {
               // echo "using Database tbiswas2_company";
            } else {
               echo "Error using  database: " . $conn->error;
            }

          if(isset($_POST['submit'])){
            if(!empty($_POST['cart-food-items'] and !empty($_POST['cart-quantity']))) {
              $selected_food = $_POST['cart-food-items'];
              $selected_quantity = $_POST['cart-quantity'];
             //  echo 'Food chosen: ' . $selected_food;
             //  echo 'Quantity chosen: ' . $selected_quantity;

              // $sql_get_price = "SELECT Price From FoodInfo WHERE ItemName = $selected_food;";
              // $result_get_price = $conn->query($sql_get_price);
              
              // (SELECT Price From FoodInfo WHERE ItemName = '$selected_food';)
              $sql_cart = "INSERT INTO Cart (ItemName, Quantity, Price) VALUES ('$selected_food', '$selected_quantity', (SELECT Price FROM FoodInfo WHERE ItemName = '$selected_food'));";
              $result_cart = $conn->query($sql_cart);

              if ($result_cart === TRUE) {
                echo "<center>Food Item added to cart successfully</center>";
                echo "<br>";
              }else{
                  echo "<center>Insertion into cart failed. Please retry.</center>";
              }

              echo "<center>View your cart below.</center>";
            }else{
                echo "<center>Error. Please make sure to select both food item and quantity.</center>";
            }
        }else{
        }
?>

<?php
$conn->close();
?>
<center>
<form action="select_cart.php" method="post" class="mb-3">
<input type="submit" name="submit" value="View Cart">
</center>
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
