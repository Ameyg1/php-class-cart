<?php

class Product{
    private $id;
    private $name;
    private $price;
    /**
     * Product constructor.
     * 
     */
    public function __construct(int $id,string $name,$price)
    {
        $this->id=$id;
        $this->name=$name;
        $this->price=$price;
    }
    /**
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id=$id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name=$name;
    }
    public function getPrice(){
        return $this->price;
    }
    public function setPrice($price){
        $this->price=$price;
    }
    /**
     * Add Product $product into cart. If product already exists inside cart
     * it must update quantity.
     * This will create CartItem and return CartItem.
     */
    public function addToCart(Cart $cart, int $quantity)
    {
        return $cart->addProduct($this, $quantity);
    }

    /**
     * Remove product from cart
     *
     * @param Cart $cart
     */
    public function removeFromCart(Cart $cart)
    {
        return $cart->removeProduct($this);
    }
}

?>
