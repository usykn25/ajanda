<?php
namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use System\Kernel\Controller;
use View;
use Model;
use System\Facades\Request;

class Home extends BaseController
{

    public function index()
    {
        View::render('Frontend/Home/index',$this->data);
    }
    public function siparisSorgu(){
        $code = Request::post('sipCode');
        if(count(explode('#',$code)) != 2){
            redirect(route('homePage'));
            exit;
        }
        redirect(route('siparisFront',['id'=>explode('#',$code)[1],'code'=>explode('#',$code)[0]]));
    }
    public function siparisOlustur($id,$code){
        $this->data['sipBilgi'] = Model::run('Siparis','Backend')->sipCek($id,$code);
        if(!$this->data['sipBilgi']){
            redirect(route('homePage'));
            exit;
        }
        $this->data['sipRow'] = Model::run('Siparis','Backend')->sipRowCek($id);
        $this->data['products'] = array();
        foreach(json_decode($this->data['sipBilgi']->schoolId) as $value){
            $product = Model::run('Product', 'Backend')->list(0, 50, [ 'schoolId' => $value ]);
            $this->data['products'] += $product;
        }
        View::render('Frontend/Home/siparis',$this->data);
    }

    public function productAjax(){
        $id = Request::get('productId');
        $this->data['product'] = Model::run('Product','Backend')->getProduct($id);
        $this->data['product']->gallery =  json_decode($this->data['product']->gallery);
        $this->data['category'] = Model::run('Category','Backend')->getCategory($this->data['product']->categoryId);
        $this->data['school'] = Model::run('School','Backend')->getSchool($this->data['product']->schoolId);
        $this->data['anabedencode'] = Model::run('Product','Backend')->getanabedencodeRow($this->data['product']->anaBedenCodeId);
        $this->data['bellastik'] = Model::run('Product','Backend')->getbellastikRow($this->data['product']->belLastikId);
        $this->data['cepmodel'] = Model::run('Product','Backend')->getcepmodelRow($this->data['product']->cepModelId);
        $this->data['koltipi'] = Model::run('Product','Backend')->getkoltipiRow($this->data['product']->kolTipiId);
        $this->data['kumastype'] = Model::run('Product','Backend')->getkumastypeRow($this->data['product']->kumasTipId);
        $this->data['productcolorcode'] = Model::run('Product','Backend')->getproductcolorcodeRow($this->data['product']->productColorCodeId);
        $this->data['ribana'] = Model::run('Product','Backend')->getribanaRow($this->data['product']->ribanaId);
        echo json_encode($this->data);
    }

    public function sipSave(){
        $data = Request::post();
        $sipId = $data['sipId'];
        $sipCode = $data['uniqCode'];
        $this->data['sipBilgi'] = Model::run('Siparis','Backend')->sipCek($sipId,$sipCode);
        if(!$this->data['sipBilgi']){
            redirect(route('homePage'));
            exit;
        }
        $hata =false;
        if(count($data['productId']) == count($data['adet']) && count($data['adet']) == count($data['aciklama'])){
            for ($i=0;$i<count($data['productId']);$i++){
                $saveRow = [
                    'sipId'=>$sipId,
                    'productId'=>$data['productId'][$i],
                    'adet'=>$data['adet'][$i],
                    'aciklama'=>$data['aciklama'][$i]
                ];
                $InsertRow = Model::run('Siparis', 'Backend')->InsertRow($saveRow);
            }
            if(!$hata){
                $data = [
                    "IsSuccess" => true,
                    "Title" => "Tebrikler",
                    "Message" => "Başarılı bir şekilde sipariş oluşturdunuz.",
                    "Type" => "success",
                    "Redirect" => route('homePage')
                ];
            }else{
                $data = [
                    "IsSuccess" => false,
                    "Title" => "Hata",
                    "Message" => "Bir sorun oluştu.",
                    "Type" => "error"
                ];
            }
        }else{
            redirect(route('homePage'));
            exit;
        }
        echo json_encode($data);
    }


}
