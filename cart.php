<?php

class Cart
{
    /**
     * variable array for cartitems
     */
    private $items=[];
    // public function __construct(){ 
    //     // get the shopping cart array from the session 
    //     $this->items= !empty($_SESSION['CART'])?$_SESSION['CART']:NULL; 
    // }
    /**
     * get items in cart
     */
    public function getItems(){
        return $this->items;
    }
    /**
     * set items in cart
     */
    public function setItems($items){
        $this->items=$items;
    }
    /**
     * Add product in cart. If product already exists the quantity is increased.
     */
    public function addProduct(Product $product,int $quantity){
        //find product in cart
        $cartItem=$this->findCartItem($product->getId());
        if($cartItem===null){
            $cartItem=new CartItem($product,0);
            $this->items[$product->getId()]=$cartItem;
        }
        $cartItem->increaseQuantity($quantity);
        // $_SESSION["CART"][]=(array) $this->items;
        return $cartItem;
    }
    public function findCartItem(int $productId){
        return $this->items[$productId] ?? null;
    }
    /**
     * Remove product from cart
     */
    public function removeProduct(Product $product){
        unset($this->items[$product->getId()]);
    }
    /**
     * Returns total quantity of products in cart
     */
    public function getTotalQuantity()
    {
        $sum=0;
        foreach($this->items as $item){
            $sum+=$item->getQuantity();
        }
        return $sum;
    }
    /**
     * This Returns total price of products added in cart
     * 
     */
    public function getTotalSum()
    {
        $totalSum=0;
        foreach ($this->items as $item){
            $totalSum += $item->getQuantity() * $item->getProduct()->getPrice();
       }
       return $totalSum;
    }
}
?>