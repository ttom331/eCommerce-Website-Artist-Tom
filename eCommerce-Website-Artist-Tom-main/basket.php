<?php

    session_start();

    if(!isset($_SESSION["userid"])){
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" class="">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e89f7f9e54.js" crossorigin="anonymous"></script>
    <script type = "text/javascript" src="/jscomponents/scrollreveal.js"></script>
    <title>Basket</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/header-logo.png" />

</head>
<body>
<nav style="background-color: #769164">
        <div class="topNavigation" id="myTopnav" style="background-color: #769164">
            <div class="nav-links">
                <a href="index.php"><img class="navbar-brand" src="assets/logo.jpg"/></a>
                <a href="index.php" style="text-decoration: underline;">Home</a>
                <a href="petPortrait.php">Pet Portraits</a>
                <a href="prints.php">Prints</a>
                <a href="greetingCards.php">Greetings Cards</a>
                <a href="contact.php">Contact</a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
                <div class="nav-links-right">
                <?php 
                    if(isset($_SESSION["userid"]))
                    {
                        
                ?>  <a href="account.php" class="right-side" style=>My Account</a>
                    <form class="" action="logout.php" method="post" style="display:inline-flex; display: contents;">
                        <a href="includes/logout.inc.php" class="right-side">Sign Out</a>
                    </form>
                    <a href="basket.php" class="right-side"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16"><path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z"/></svg></a>
                <?php
                    }
                    else
                    {
                ?>
                    <a href="login.php" class="right-side">Sign In</a>
                <?php
                    }
                ?>
                </div>
            </div>
            </a>
        </div>
    </nav>
    <!-- cover image-->
    <div class="main-content">
        <div class="flex-container">
            <div class="flex-item-left">
                <h4>My Basket</h4>
                <hr>
                <!--get session for basket -->
                <?php include('classes/getBasketitems.php');
                if (isset($basket) && $basket) {
                    foreach ($basket as $row) { ?>

                <ul>
                    <li style="text-align: center;">
                        <div>
                            <img style="width: 80px; height: 80px;" src="/assets/products/<?php echo htmlspecialchars($row['print_Image']);?>" alt="">
                            <h6 style="color: black; width:80px;"><?php echo htmlspecialchars($row['print_Name']);?></h6>
                        </div>
                    </li>
                    <li>
                        <small style="color: black;"><span>£</span><?php echo number_format($row['print_Price'] * $row['quantity'],2);?></small>
                    </li>
                    <li><!--edit quantity of the product -->
                        <form method="POST" action="includes/basket-edit.inc.php">
                            <input type="hidden" name="basket_ID" value="<?php echo $row['basket_ID'];?>"/>
                            <input type="hidden" name="customer_ID" value="<?php echo $row['user_id']; ?>"/>
                            <input name="quantity" type="number" style="width: 25%;" value="<?php echo $row['quantity']; ?>"/>
                            <input type="submit" class="basketButtons" value="Edit" name="edit_Quantity"/>
                        </form>
                    </li>
                    <li>
                        <!-- remove a product from the basket-->
                        <form method="POST" action="includes/basket-remove.inc.php">
                            <input type = "hidden" name="print_ID" value="<?php echo $row['basket_ID'];?>"/>
                            <input type="hidden" name="customer_ID" value="<?php echo $row['user_id']; ?>"/>
                            <input type="submit" class="basketButtons" name="remove_Print" value="Remove"/>
                        </form>
                    </li>
                </ul>
                <?php } }?>
            <?php if (empty($basket) ) {
            ?> 
            <div class="basketEmpty" style="text-align:center; margin-top: 20vh; margin-bottom: 20vh;">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#769164" class="bi bi-bag-fill" viewBox="0 0 16 16"><path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z"/></svg>
                <h5>You've got an empty basket.</h5>

            </div>
            
            <?php
            }
            ?>
            </div>
            <?php if (!empty($basket) ) {
                ?>
            <div class="flex-item-right">
                <h4>Checkout</h4>
                <hr>
                <ul>
                    <li>
                    <?php
                        if (isset($_SESSION['totalCost'])) {
                            ?><h5><?php echo "Basket Total: £" . number_format($_SESSION['totalCost'], 2);?></h5>
                        <?php
                        } else {
                            echo "Total Cost not set.";
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['totalCost2']) &&(isset($_SESSION['discount']))) {
                            ?>
                            <h5><?php echo "Discount Total: £" . number_format($_SESSION['totalCost2'], 2);?></h5>
                            <p style="font-size: .8rem;">(Excluding Delivery)</p>
                            <p><?php echo $_SESSION["discount"]; ?>% off!</p>
                        <?php
                        } else {
                            $_SESSION['totalCost2'] = $_SESSION['totalCost'];
                            ?>
                            <h5><?php echo "Discount Total: £" . number_format($_SESSION['totalCost'], 2);?></h5>
                            <p style="font-size: .8rem;">(Excluding Delivery)</p>
                            <p>No Discount active.</p>
                            <?php
                        }
                        ?>
                    </li>
                    <li>
                        
                    </li>
                    <li>
                        <h5>Promotional Code</h5>
                    </li>
                        <form method="POST" action="includes/basket-promo.inc.php">
                            <input class="promo" name="code" placeholder="CODE">
                            <input type="hidden" name="customer_ID" value="<?php echo $row['user_id']; ?>"/>
                            <input type="submit" class="basketButtons" value="Apply" name="promo"/>
                        </form>
                    </li>
                    <form method="POST" action="checkout.php">
                        <li>
                            <h2>Delivery Address</h2>
                            <hr>
                            <label for="addressline1" style="float:left;"><b>Address line 1</b></label>
                            <input class="delivery" style="padding: 7px;" type="text" name="addressline1" placeholder="Address line 1" required>
                            <label for="addressline2" style="float:left;"><b>Address line 2</b></label>
                            <input style="padding: 7px;" type="text" name="addressline2" placeholder="Address line 2">
                            <label for="town" style="float:left;"><b>Town/City</b></label>
                            <input style="padding: 7px;" type="text" name="town" placeholder="Town/City" required>
                            <label for="postcode" style="float:left;"><b>Postcode</b></label>
                            <input style="padding: 7px;" type="text" name="postcode" placeholder="Postcode" required>
                            <input type="hidden" name="order_total" value="<?php $_SESSION['totalCost'];?>">
                            <button class="checkoutButton" type="submit" name="submitorder">Checkout</button>
                        </li>
      
                    </form>
                        
                </ul>
            </div>
            <?php }?>
        </div>
    </div>
    


<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topNavigation") {
    x.className += " responsive";
  } else {
    x.className = "topNavigation";
  }
}
</script>

<script type = "text/javascript" src="/jscomponents/carousel.js"></script>
<footer>
    <div class="footer">
        <div class="icons">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
            <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
            <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
            </svg>
        </div>
        <a href="petPortrait.php"><p>Pet Portraits</p></a>
        <a href="greetingsCards.php"><p>Greetings Cards</p></a>
        <a href="contact.php"><p>Contact</p></a>
        <h5>©2024 Lisa Wellwood | All Rights Reserved</h5>
    </div>
</footer>
</body>



<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
