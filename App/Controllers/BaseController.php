<?php
namespace App\Controllers;

use System\Kernel\Controller;
use Event;
use Request;
use App;
use Model;
use App\Enums\packagePeriod;
use System\Libs\Router\Router;

class BaseController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data[] = null;
    }

    protected function buildCategoryTree($elements,$parentId=0){
        $branch = array();
        foreach ($elements as $element){
            if($element->mainCategoryId == $parentId){
                $children = $this->buildCategoryTree($elements,$element->id);
                if($children){
                    $element->children = $children;
                }
                $branch[]=$element;
            }
        }
        return $branch;
    }

    protected function printCategoryTreeSelectOption($items,$selectedId = 0,$disabledId = 0,$prefix=''){
        $html = '';
        foreach ($items as $item){
            if($disabledId != $item->id){
                if($selectedId == $item->id)
                    $selected = 'selected';
                else
                    $selected = '';
                $html  .= '<option value="'.$item->id.'" '.$selected.'>'.$prefix.$item->title.'</option>';
                if(isset($item->children)){
                    $html .= $this->printCategoryTreeSelectOption($item->children,$selectedId,$disabledId,$prefix.'-');
                }
            }
        }
        return $html;
    }

}
