<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Cart</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <h2 align="center">Cart</h2>
    <table align="center" width="600px" border="1px">
      <?php
        include $_SERVER['DOCUMENT_ROOT'].'/IT4442/it4442/Cart/Cart.php';

        $cart = new Cart();

        // session_unset();

        $Id = -1;
        $Name = NULL;
        $Price = NULL;
        $Quantity = NULL;

        if($_POST){
          $Id = $_POST["id"];
          if($_POST["submit"] == "Edit"){
            $Quantity = $_POST["quantity"];

            // for($i = 0; $i < count($_SESSION["cart"]); $i++) {
            //   if($_SESSION["cart"][$i]['item_id'] == $Id){
            //     if($Quantity == 0 || $Quantity == "") {
            //       unset($_SESSION["cart"][$i]);
            //       $_SESSION["cart"] = array_values($_SESSION["cart"]);
            //     } else {
            //       $_SESSION["cart"][$i] = $Products[$i];
            //     }
            //     break;
            //   }
            // }

            $cart->edit($Id, $Quantity);
          }
          if($_POST["submit"] == "Remove"){
              $cart->delete($Id);
          }
        }

        $Products = array();
        if(isset($_SESSION["cart"])) {
          $array = $_SESSION["cart"];
          foreach ($array as $value) {
            $Products[] = array(
              'item_id' => $value['item_id'],
              'item_name' => $value['item_name'],
              'item_price' => $value['item_price'],
              'item_quantity' => $value['item_quantity']
            );
          }
        }
       ?>
      <tr>
        <td>Name</td>
        <td>Price</td>
        <td>Quantity</td>
        <td colspan="2"></td>
      </tr>
      <?php
        foreach ($Products as $value) {
          echo" <tr>
                  <td>{$value['item_name']}</td>
                  <td>{$value['item_price']}</td>
                  <form action=\"cart_controller.php\" method=\"post\">
                    <td>
                      <input name='quantity' value='{$value['item_quantity']}'>
                      <input name='id' value='{$value['item_id']}' type='hidden'>
                    </td>
                    <td>
                      <input class=\"edit action\" type=\"submit\" name='submit' value=\"Edit\">
                    </td>
                  </form>
                  <td>
                    <form action=\"cart_controller.php\" method=\"post\">
                      <input name=\"id\" value=\"{$value['item_id']}\" type='hidden'>
                      <input class=\"remove action\" type=\"submit\" name=\"submit\" value=\"Remove\">
                    </form>
                  </td>
                </tr>";
        }
       ?>
       <tr>
         <td>Total: </td>
         <td><?php
           $total = 0;
           foreach($Products as $value){
             $total += $value['item_price'] * $value['item_quantity'];
           }
           echo $total;
          ?></td>
       </tr>
       <?php
        if(isset($_SESSION["cart"]) && count($_SESSION["cart"]) != 0) {
          echo "<tr>
             <td colspan='5' align='center'>
               <a href='payment.php'>
                 <button type='button'>
                   Tiến hành thanh toán
                 </button>
               </a>
             </td>
          </tr>";
        }
        ?>

       <tr>
          <td colspan='5' align='center'>
            <a href="index.php">
              <button type="button">
                Tiếp tục mua hàng
              </button>
            </a>
          </td>
       </tr>
    </table>
  </body>
</html>
