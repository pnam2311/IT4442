<!-- Hiển thị giao diện danh mục hàng hóa -->
<?php
  include $_SERVER['DOCUMENT_ROOT'].'/IT4442/it4442/ConnectionDB/ConnectionDB.php';
  include $_SERVER['DOCUMENT_ROOT'].'/IT4442/it4442/Cart/Cart.php';

  $cart = new Cart();

  // session_unset();

  if(isset($_POST["add_to_cart"])) {
    $id = $_GET["id"];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $cart->add($id, $name, $price, $quantity);

    // if(isset($_SESSION["cart"])) {
    //   $item_array_id = array_column($_SESSION["cart"], "item_id");
    //   $count = count($_SESSION["cart"]);
    //   if(!in_array($id, $item_array_id)) {
    //     $item_array = array(
    //       'item_id' => $id,
    //       'item_name' => $name,
    //       'item_price' => $price,
    //       'item_quantity' => $quantity
    //     );
    //     $_SESSION["cart"][$count] = $item_array;
    //
    //   } else {
    //     for($i = 0; $i < $count; $i++){
    //       if($id == $item_array_id[$i]){
    //         $_SESSION["cart"][$i]['item_quantity'] += 1;
    //         break;
    //       }
    //     }
    //   }
    // } else {
    //   $item_array = array (
    //     'item_id' => $id,
    //     'item_name' => $name,
    //     'item_price' => $price,
    //     'item_quantity' => $quantity
    //   );
    //   $_SESSION["cart"][0] = $item_array;
    //
    //
    // }

    echo '<script>alert("'.$quantity.' '.$name.' added")</script>';
    // echo '<script>window.location="index.php"</script>';
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <title> Shopping Cart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="lib/bootstrap.min.css">
    <script src="lib/jquery.min.js"></script>
    <script src="lib/bootstrap.min.js"></script>
  </head>
  <body>
    <br/>

   
    <div align='center'>

      <a href="cart_controller.php"><input type="submit" name="go_to_cart" style="margin-top:5px;height: 30px;font-size: 16px;" class="btn btn-success" value="My cart" /></a>

      <?php include("header.php"); ?>

      <form action="search.php" method="GET">
        <input type="text" name="query" style="margin-top:5px;height: 30px;font-size: 16px;"/>
        <input type="submit" name="search_products" style="margin-top:5px;height: 30px;font-size: 16px;" class="btn btn-success" value="Search" />
    
    <div class="alert alert-info">
         <?php
             if(isset($_SESSION['user'])){
                echo '<h2>Xin chào ' . $_SESSION['user']['full_name'] . '</h2>';

             if(!isset($_SESSION['user']['full_name']) ||
                  !isset($_SESSION['user']['sex']) ||
                  !isset($_SESSION['user']['email']) ||
                  !isset($_SESSION['user']['address']) ||
                  !isset($_SESSION['user']['phone_number']))
          echo '<h3>Bạn chưa update profile, làm ơn hãy update để chúng tôi có thể phục vụ bạn tốt nhất !!!</h3>';
    } ?>
    </div>
      </form>

    </div>

    <div class="container" style="width:700px;">
      <h3 align="center" style="font-size: 60px">Shop Products</h3><br />
      <?php
        $query = "SELECT * FROM product ORDER BY id ASC";
        $result = mysqli_query(ConnectionDB::getConnection(), $query);
        if(mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_array($result)) {
      ?>
      <div class="col-md-4">
        <form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">
          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; float: left;" align="center">
            <img src="img/<?php echo $row["image"]; ?>" class="img-responsive" /><br />
            <h4 class="text-info"><?php echo $row["name"]; ?></h4>
            <h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>
            <input type="hidden" name="name" value="<?php echo $row["name"]; ?>" />
            <input type="hidden" name="price" value="<?php echo $row["price"]; ?>" />
            <input type="hidden" name="quantity" value='1'/>
            <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
          </div>
        </form>
      </div>
      <?php
          }
        }
      ?>
      <div style="clear:both"></div>
    </div>
    <br />
  </body>
</html>
