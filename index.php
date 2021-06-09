<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
session_start();
require_once "product.php";
require_once "cart.php";
require_once "cartitem.php";

$products = [
    [ "name" => "Sledgehammer", "price" => 125.75 ],
    [ "name" => "Axe", "price" => 190.50 ],
    [ "name" => "Bandsaw", "price" => 562.131 ],
    [ "name" => "Chisel", "price" => 12.9 ],
    [ "name" => "Hacksaw", "price" => 18.45 ],
   ];

$product_list=[];
foreach($products as $x=>$value){
    $product_list[$x]=new Product($x,$value["name"],$value["price"]);
}
$cart=new Cart();
$_SESSION["CART"]=$cart;
if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            if(!empty($_POST["quantity"])){
                foreach($product_list as $product) {
                    if ($_GET["id"] == $product->getID()) {
                        $item_add = $product;
                        break;
                    }
                }
                if(!empty($SESSION["CART"])){
                    if(in_array($item_add->getId(),$cart->getItems()->getProduct()->getID())){
                        foreach($cart as $cartitem){
                            if($item_add->getId() == $cartitem->getProduct()->getId()){
                                if(empty($cartitem->getquantity())){
                                    $cartitem->setquantity(0);
                                }
                                $cartitem->increaseQuantity($_POST["quantity"]);
                                
                            }
                        }
                    }else {
                        $_SESSION["CART"][]=array_push($_SESSION["CART"],$item_add->addToCart($cart,$_POST["quantity"]));
                    }
                }else{
                    $_SESSION["CART"]=$item_add->addtoCart($cart,$_POST["quantity"]);
                }
            }      
        break;
        case "remove":
            if(!empty($cart)){
                foreach($cart as $cartitems){
                    if($_GET["id"] == $cartitems->getProduct()->getId()){
                        $cart->removeProduct($cartitems->getProduct());
                    }
                }
            }
        break;
    


        }
    }

?>
<html>
<head>
<title>PHP SHOPPING CART</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="shopping-cart">
<div class="txt-heading"> Shopping Cart</div>
<?php
if(isset($_SESSION["Cart"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Id</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>
<?php		
    foreach ($cart->getItems() as $item){
        var_dump($item);
        $item_price = $item->cartitemprice();
		?>
				<tr>
				<td><?php echo $item->getProduct()->getName(); ?></td>
				<td><?php echo $item->getProduct()->getId(); ?></td>
				<td style="text-align:right;"><?php echo $item->getQuantity(); ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item->getProduct()->getPrice(),2); ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item->getProduct()->getId(); ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity=$cart->getTotalQuantity();
				$total_price = $cart->getTotalSum();
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>	
<?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>

<div id="product-grid">
	<div class="txt-heading">Products</div>
	<?php
	if (!empty($product_list)) { 
		foreach($product_list as $product){
	?>
		<div class="product-item">
			<form method="post" action="index.php?action=add&id=<?php echo $product->getId(); ?>">
			<div class="product-tile-footer">
			<div class="product-title"><?php echo $product->getName(); ?></div>
			<div class="product-price"><?php echo "$".number_format($product->getPrice(),2); ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			</div>
			</form>
		</div>
	<?php
		}
	}
	?>
</body>

</html>