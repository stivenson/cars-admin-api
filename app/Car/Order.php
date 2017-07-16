<?php namespace Car;

use Abstracts\Resource;
use Models\Order as MOrder;
use Models\ItemsOrder;

class Order extends Resource{

    public function listTypeDelivery($type = 0) {
        
        $items = [];
        $type = (int)$type;
        if($type == 0)
            $items =  MOrder::all();
        else
            $items = MOrder::where('delivery_type',$type)->get();
            
        return $items;
    }
    
    public function listStatus($type = 0) {
    
        $items = [];
        $type = (int)$type;
        if($type == 0)
            $items =  MOrder::all();
        else
            $items = MOrder::where('status',$type)->get();
                    
        return $items;
    }
    
    public function find($id) {
        $o = MOrder::find($id);
        return !is_null($o) ? $o : false;
    }
    
    /*
    public function save($attr) {
        $o = new MOrder();
        $o->fill($attr);
        return $o->save() ? $o: false;
    }
    */
    
    public function save($attr) {
        //var_dump($attr);
        $itemsOrder = $attr['items_orders'];
        $o = new MOrder();
        $o->fill($attr);
        return $this->transactionOrderAndItems($o, $itemsOrder);
    }
    
    private function transactionOrderAndItems($o, $itemsOrder){
        try {
            \DB::transaction(function() use ($o, $itemsOrder)
            {
                $o->save();
                $arrJson = json_decode($itemsOrder,true);
                foreach ($arrJson as $itemorder){
                    $io = new ItemsOrder;
                    $io->products_id = $itemorder['products_id'];
                    $io->amount = $itemorder['amount'];
                    $io->observations = $itemorder['observations'];
                    $io->orders_id = $o->id;
                    $io->save();
                }
            });
            return true;
        }catch (Exception $e){
            return false;
        }
    }
    
    public function update($id,$attr) {
        $o = MOrder::find($id);
        $o->fill($attr);
        return $o->save() ? $o: false;
    }
    
    public function delete($id) {
        $o = MOrder::find($id);
        $o->delete();
    }
}


