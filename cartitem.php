<?php

class CartItem{
    private $product;
    private $quantity;
/**
 * Cartitem constructor
 */
public function __construct(\Product $product,$quantity)
{
    $this->product=$product;
    $this->quantity=$quantity;
}
/**
 * Get the Product object of the Cart Item
 */
public function getProduct(){
    return $this->product;
}
/**
 * Set product in cartitem
 */
public function setProduct($product)
{
    $this->product=$product;
}
/**
 * return quantity
 */
public function getQuantity(){
    return $this->quantity;
}
/**
 * set quantity of item in cart
 */
public function setQuantity($quantity){
    $this->quantity=$quantity;
}
public function increaseQuantity($amount=1)
{
    if ($this->getQuantity() + $amount > 100){
        throw new Exception("Product quantity can not be more than ".$this->MAX);}
    $this->quantity+=$amount;
}
public function decreaseQuantity($amount=1)
{
    if($this->getQuantity()-$amount <1){
        throw new Exception("Quantity can not be less than 1");
    }
    $this->quantity-=$amount;
}
/***
 * Returns the price*quantity 
 */
public function cartitemprice(){
    $cartitemprice=$this->getProduct()->getPrice()*$this->getQuantity();
    return $cartitemprice;
}
}

?>