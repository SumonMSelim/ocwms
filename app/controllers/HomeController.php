<?php

class HomeController extends BaseController
{

    public function showHome()
    {
        $data['page_title'] = 'Home';
        return View::make('home');
    }

}
