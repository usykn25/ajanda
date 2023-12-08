<?php

namespace App\Models;

use DB;
class Home
{
    public function GetCityList()
    {
        return DB::table('city_lists')
            ->where('Status', '=', 1)
            ->getAll();
    }

    public function GetDistrictByCity($cityid)
    {
        if($cityid)
        {
            return DB::table('district_lists')
                ->where('CityID  ', '=', $cityid)
                ->where('Status', '=', 1)
                ->getAll();
        }
    }
}
