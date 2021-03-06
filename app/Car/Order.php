<?php namespace Car;

use Abstracts\Resource;
use Models\Order as MOrder;
use Models\ItemsOrder;
use Users\Client;

class Order extends Resource{

    public function listTypeDelivery($type = 0) {
        
        $items = [];
        $type = (int)$type;
        if($type == 0)
            $items =  MOrder::orderBy('id','DESC')->get();
        else
            $items = MOrder::where('delivery_type',$type)->orderBy('id','DESC')->get();
            
        return $items;
    }
    
    public function listStatus($type = 0) {
    
        $items = [];
        $type = (int)$type;
        if($type == 0)
            $items =  MOrder::orderBy('id','DESC')->get();
        else
            $items = MOrder::where('status',$type)->orderBy('id','DESC')->get();
                    
        return $items;
    }

    public function listStatusPagination($type = 0, $skip, $take) {
    
        $items = [];
        $type = (int)$type;
        if($type == 0)
            $items =  MOrder::orderBy('id','DESC')->skip($skip)->take($take)->get();
        else
            $items = MOrder::where('status',$type)->orderBy('id','DESC')->skip($skip)->take($take)->get();
        return $items;
    }

    public function listItemsOfOrder($id) {
        return ItemsOrder::where('orders_id',$id)->get();
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
        date_default_timezone_set('america/bogota');
		if(isset($attr['id'])){
			$this->update($attr['id'],$attr);
		}else{
            $itemsOrder = $attr['items_orders'];
            $attr['created_at'] = date('Y-m-d H:i:s');
            $o = new MOrder;
            $user = new Client;

            if(array_key_exists('userIdFacebook',$attr)){
                $attr['users_id'] = $user->updateOrSaveforIdFacebook($attr);
            }
            $o->fill($attr);
            return $this->transactionOrderAndItems($o, $itemsOrder);			
		}
    }
    
    private function transactionOrderAndItems($o, $itemsOrder, $update = false){

        try {
            \DB::transaction(function() use ($o, $itemsOrder, $update)
            {

                if($update) {
                    \DB::table('items_orders')->where('orders_id', $o->id)->delete();
                }

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
        $itemsOrder = $attr['items_orders'];
        $o = MOrder::find($id);
        unset($attr['created_at']);
        // $attr['created_at'] = date('Y-m-d H:i:s');
        $o->fill($attr);
        return $this->transactionOrderAndItems($o, $itemsOrder, true);
    }
    
    public function delete($id) {
        $o = MOrder::find($id);
        \DB::table('items_orders')->where('orders_id', $o->id)->delete();
        $o->delete();
    }
}


