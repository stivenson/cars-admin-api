<?php 
declare(strict_types=1);
namespace Car;
use Helpers\Image;
use Models\Product as MProduct;

class Product {
	
	const WIDTH_IMAGE = 300;
	const END_POINT_IMAGE_SHARE_F = '/public/share/image_product/facebook';
	const END_POINT_SHARE_F = '/public/share/product/facebook';

	public function listR($available) {
		if($available)
		 	return MProduct::where('available',1)->orderBy('id','DESC')->get();
		else
			return MProduct::orderBy('id','DESC')->get();
	}

    public function listRPagination($available, $skip = false, $take = false) {
		if(!$skip && !$take){
			$this->listR($available);
		}else{
			if($available)
				return MProduct::where('available',1)->orderBy('id','DESC')->skip($skip)->take($take)->get();
   			else
				return MProduct::orderBy('id','DESC')->skip($skip)->take($take)->get();
		}
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
			$attr['available'] = ($attr['available'] === 'true');
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
		$attr['available'] = ($attr['available'] === 'true');
		$o->fill($attr);
		return $o->save();
	}
	
	public function delete($id) {
		$o = MProduct::find($id);
		return $o->delete();
	}
	

	public function getProductForFacebookWith(int $id, array $fields, bool $withLink) : array {

		$dbProduct = MProduct::where('id',$id)->first($fields);

		$res = array_combine($fields, array_values(json_decode(json_encode($dbProduct), true)));

		if($withLink){
			$linkImage = env('APP_URL').(env('API_PORT') == '' ? '' : ':'.env('API_PORT') ).env('API_URL').self::END_POINT_IMAGE_SHARE_F.'/'.$id;
			$linkShare = env('APP_URL').(env('API_PORT') == '' ? '' : ':'.env('API_PORT') ).env('API_URL').self::END_POINT_SHARE_F.'/'.$id;
			$res['linkImage'] = $linkImage;
			$res['linkShare'] = $linkShare;
		}

		if(isset($res['image1'])){
			$res['image1'] = base64_decode($res['image1']);
		}

		return $res;
	}
	
	private function processImage($image) {
		$mime = Image::getMime($image);
		$image1 = Image::resizeBase64andScaleHeight(Image::getBase64($image),$mime,self::WIDTH_IMAGE);
		return [$image1,$mime];
	}
	
	
}
