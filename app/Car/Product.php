<?php namespace Car;
use Helpers\Image;
use Models\Product as MProduct;

class Product {
	
	const WIDTH_IMAGE = 300;

	public function listR($available) {
		if($available)
		 	return MProduct::where('available',1)->orderBy('id','DESC')->get();
		else
			return MProduct::orderBy('id','DESC')->get();
	}
	
	public function find($id) {
		$o = MProduct::find($id);
		return !is_null($o) ? $o : false;
	}
	
	public function save($attr) {
		if(isset($attr['id'])){
			$this->update($attr['id'],$attr);
		}else{
			$o = new MProduct();
			$image = $attr['image'];
			$arrImage = $this->processImage($image);
			$attr['image1'] = $arrImage[0];
			$attr['mime'] = $arrImage[1];
			$attr['available'] = (bool) $attr['available'];
			$o->fill($attr);
			return $o->save();			
		}

	}
	
	public function update($id,$attr) {
		$o = MProduct::find($id);
		if(isset($attr['image'])){
			$image = $attr['image'];
			$arrImage = $this->processImage($image);
			$attr['image1'] = $arrImage[0];
			$attr['mime'] = $arrImage[1];
		}
		$attr['available'] = (bool) $attr['available'];
		$o->fill($attr);
		return $o->save();
	}
	
	public function delete($id) {
		$o = MProduct::find($id);
		return $o->delete();
	}
	
	private function processImage($image) {
		$mime = Image::getMime($image);
		$image1 = Image::resizeBase64andScaleHeight(Image::getBase64($image),$mime,self::WIDTH_IMAGE);
		return [$image1,$mime];
	}
	
	
}
