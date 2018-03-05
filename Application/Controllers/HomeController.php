<?php

class HomeController extends Controller
{
    public function BeforeAction()
    {
        $this->SetLinks();

        if(!$this->IsLoggedIn()){
            return $this->Redirect('/User/Login', array('ref' => $this->RequestUri));
        }
    }

    public function SetLinks()
    {
        $this->Set('ApplicationLinks', $this->Helpers->ShellAuth->GetApplicationLinks()['data']);
    }

    public function Index()
    {
        $this->Title = 'Manage';
        return $this->View();
    }
}