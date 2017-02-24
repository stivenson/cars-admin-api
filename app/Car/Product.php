<?php namespace Car;
use Helpers\Image;
use Models\MProduct;

class Product {
	
	const WIDTH_IMAGE = 300;

	public function list() {
		return MProduct::orderBy('name')->get();
	}
	
	public function find($id) {
		$o = MProduct::find($id);
		return !is_null($o) ? $o : false;
	}
	
	public function save($attr) {
		$o = new MProduct();
		$arrImage = $this->processImage($image);
		$attr['image1'] = $arrImage[0];
		$attr['mime'] = $arrImage[1];
		$o->fill($attr);
		return $o->save() ? $o: false;
	}
	
	public function update($id,$attr) {
		$o = MProduct::find($id);
		$arrImage = $this->processImage($image);
		$attr['image1'] = $arrImage[0];
		$attr['mime'] = $arrImage[1];
		$o->fill($attr);
		return $o->save() ? $o: false;
	}
	
	public function delete($id) {
		$o = MProduct::find($id);
		$o->delete();
	}
	
	private function processImage($image) {
		$mime = Image::getMime($image);
		$image1 = Image::resizeBase64andScaleHeight(Image::getBase64($image),$mime,self::WIDTH_IMAGE);
		return [$mime,$image1];
	}
	
	
}
