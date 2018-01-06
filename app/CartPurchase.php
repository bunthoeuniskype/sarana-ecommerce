<?php

namespace App;

class CartPurchase
{
    public $items = null;
    public $totalQty = 0;
    public $totalCost = 0;


    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalCost = $oldCart->totalCost;
        }
    }
    
  public function add($item, $id)
    {
        $storeItem = ['cost'=>$item->cost,'qty' => 0, 'amount' => 0, 'discount' => $item->discount, 'item' => $item];

        if($this->items){
            if(array_key_exists($id, $this->items)){                
            $storeItem = $this->items[$id];
            $storeItem['qty']++;
            $amount = ($this->items[$id]['cost'] * $storeItem['qty']) - (($this->items[$id]['cost'] * $storeItem['qty'] * $this->items[$id]['discount'])/100);
            $cost = $this->items[$id]['cost'] - (($this->items[$id]['cost']*$this->items[$id]['discount'])/100);
            } else{
             $storeItem['qty']++;
            $amount = ($item->cost * $storeItem['qty']) - (($item->cost * $storeItem['qty'] * $storeItem['discount'])/100);
            $cost = $item->cost - (($item->cost*$item->discount)/100);
            }

        }else{
             $storeItem['qty']++;
            $amount = ($item->cost * $storeItem['qty']) - (($item->cost * $storeItem['qty'] * $storeItem['discount'])/100);
            $cost = $item->cost - (($item->cost*$item->discount)/100);
        }         
         
            $storeItem['amount'] = $amount;
            $this->items[$id] = $storeItem;

            $this->totalQty++;
            $this->totalCost += $cost;
    }


    public function Remove($id)
    {
            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalCost -= $this->items[$id]['amount'];            
            unset($this->items[$id]);
        
    }


    public function update($item,$cost,$qty,$discount,$id){
                      

            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalCost -= $this->items[$id]['amount'];

             $storeItem = ['cost' => $cost, 'qty' => 0, 'amount' => 0, 'discount' => $discount, 'item' => $item];

            $storeItem['qty'] = $qty;
            $amount = ($cost * $qty) - (($cost * $qty * $discount)/100);
            $storeItem['amount'] = $amount;
            $this->items[$id] = $storeItem;
            
            $this->totalQty = $qty;
            $this->totalCost += $amount;          
    }

}
