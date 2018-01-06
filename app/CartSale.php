<?php

namespace App;

class CartSale
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;


    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }
    
  public function add($item, $id)
    {
        $storeItem = ['price'=>$item->price,'qty' => 0,'tax' => $item->tax, 'amount' => 0, 'discount' => $item->discount, 'item' => $item];

        if($this->items){
            if(array_key_exists($id, $this->items)){                
            $storeItem = $this->items[$id];
            $storeItem['qty']++;
            $amount = (($this->items[$id]['price'] * $storeItem['qty']) - (($this->items[$id]['price'] * $storeItem['qty'] * $this->items[$id]['discount'])/100)) + ((($this->items[$id]['price'] * $storeItem['qty']) * $this->items[$id]['tax'])/100);

            $price = ($this->items[$id]['price'] - (($this->items[$id]['price']*$this->items[$id]['discount'])/100)) +  ((($this->items[$id]['price'] * $storeItem['qty']) * $this->items[$id]['tax'])/100);
            } else{            

            $storeItem['qty']++;
            $amount = (($item->price * $storeItem['qty']) - (($item->price * $storeItem['qty'] * $storeItem['discount'])/100)) + ((($item->price * $storeItem['qty']) * $item->tax)/100);
            $price = ($item->price - ((($item->price*$item->discount)/100)) +  (($item->price * $storeItem['qty']) * $item->tax)/100);
            }

        }else{
            $storeItem['qty']++;
            $amount = ($item->price * $storeItem['qty']) - (($item->price * $storeItem['qty'] * $storeItem['discount'])/100);
            $price = $item->price - (($item->price*$item->discount)/100);
        }         
         
            $storeItem['amount'] = $amount;
            $this->items[$id] = $storeItem;

            $this->totalQty++;
            $this->totalPrice += $price;
    }

    

    public function Remove($id)
    {
            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['amount'];            
            unset($this->items[$id]);
        
    }


    public function update($item,$price,$qty,$discount,$tax,$id){
                      
            //clear old qty and total amount
            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['amount'];

            $storeItem = ['price' => $price, 'qty' => 0,'tax' => $tax, 'amount' => 0, 'discount' => $discount, 'item' => $item];

            $storeItem['qty'] = $qty;
            $amount = ((($price * $qty) - (($price * $qty * $discount)/100))) + ((($price * $qty) * $tax)/100);
            $storeItem['amount'] = $amount;
            $this->items[$id] = $storeItem;
            
            $this->totalQty = $qty;
            $this->totalPrice += $amount;          
    }

}
