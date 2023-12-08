<?php
namespace App\Controllers\Backend;

use System\Kernel\Controller;
use View;

class Dashboard extends Controller
{
    public function __construct()
    {
        $this->middleware(['Auth']);
    }

    public function index()
    {
        View::render('Backend/dashboard');
    }
    public function form()
    {
        View::render('Backend/form');
    }

    public function table(){
        View::render('Backend/table');
    }


}
