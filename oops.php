<?php
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
// Adding 2 SledgeHammers
$cartitem1=$product_list[0]->addToCart($cart,2);
//Adding 3 Axe
$cartitem2=$product_list[1]->addToCart($cart,3);
echo "Number of items in cart: ".PHP_EOL;
echo $cart->getTotalQuantity().PHP_EOL; // This must print 5
echo "Total amount of the Cart".PHP_EOL;
echo $cart->getTotalSum().PHP_EOL; // This must print 823

//increase quantity of sledgehammers by 2
$cartitem1->increaseQuantity(2);
 echo "\n";
echo "Number of items in cart: ".PHP_EOL;
echo $cart->getTotalQuantity().PHP_EOL; // This must print 7

// Adding 1 Bandsaw
$cartitem3=$product_list[2]->addToCart($cart,1);

//decrease quantity of Axe by 2
$cartitem2->decreaseQuantity(2);

//removing sledgehammers from cart
$cart->removeProduct($product_list[0]);

//Total amount should be 752.63
echo "Total amount of the Cart".PHP_EOL;
echo number_format($cart->getTotalSum(),2).PHP_EOL;
// showcase the cart
print_r($cart->getItems());
?>