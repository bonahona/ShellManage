<?php

class HomeController extends Controller
{
    public function BeforeAction()
    {
        if(!$this->IsLoggedIn()){
            return $this->Redirect('/User/Login', array('ref' => $this->RequestUri));
        }
    }

    public function Index()
    {
        $this->Title = 'Manage';
        return $this->View();
    }
}