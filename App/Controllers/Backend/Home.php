<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use System\Facades\Request;
class Home extends BaseController
{
    public function GetDistrictByCity(){
        if(Request::isAjax() && Request::isMethod('GET')){
            $CityID = Request::get('CityID', true);

            if($CityID)
            {
                $DistrictList = \System\Facades\Model::run('Home')->GetDistrictByCity($CityID);

                if($DistrictList)
                {
                    $data['DistrictList'] = $DistrictList;
                }else {
                    $data['DistrictList'] = Null;
                }
            }
            echo json_encode($data);
        }
    }
}
