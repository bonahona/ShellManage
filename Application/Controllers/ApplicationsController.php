<?php
class ApplicationsController extends Controller
{
    public function BeforeAction()
    {
        if(!$this->IsLoggedIn()){
            return $this->Redirect('/User/Login', array('ref' => $this->RequestUri));
        }
    }

    public function Index()
    {
        $this->Title = 'Applications';

        $applications = $this->Helpers->ShellAuth->GetApplication();
        $this->Set('Applications', $applications['Data']);
        return $this->View();
    }

    public function Details($id)
    {
        $this->Title = 'Aplication Details';

        if($id == null || $id == ""){
            return $this->HttpNotFound();
        }

        $response = $this->Helpers->ShellAuth->GetApplication($id);
        $application = First($response['Data']);
        $this->Set('Application', $application);
        return $this->View();
    }

    public function Create()
    {
        $this->Title = 'Create Application';

        if($this->IsPost() && !$this->Data->IsEmpty()){
            $application = $this->Data->RawParse('ShellApplication');

            $response = $this->Helpers->ShellAuth->CreateApplication($application);

            if($response['Error'] == 0){
                return $this->Redirect('/Applications/Index');
            }else{
                $this->Set('Application', $application);
                return $this->View();
            }
        }else{

            $application = array(
                'ApplicationName' => '',
                'DefaultUserLevel' => 0,
                'RsaPublicKey' => '',
                'RsaPrivateKey' => '',
                'IsInactive' => 0
            );

            $this->Set('ShellApplication', $application);
            return $this->View();
        }
    }

    public function Edit($id)
    {
        $this->Title = 'Edit Application';

        if($this->IsPost() && !$this->Data->IsEmpty()){
            $shellApplication = $this->Data->RawParse('ShellApplication');

            $response = $this->Helpers->ShellAuth->EditApplication($shellApplication);
            if($response['Error'] == 0){
                return $this->Redirect('/Applications/');
            }else{
                $this->Set('ShellApplication', $shellApplication);

                $this->ModelValidation->AddError('ShellApplication', 'ApplicationName', $response['ErrorList']);
                return $this->View();
            }
        }else{

            if($id == null || $id == ""){
                return $this->HttpNotFound();
            }

            $response = $this->Helpers->ShellAuth->GetApplication($id);
            $shellApplication = $response['Data'][0];

            $this->Set('ShellApplication', $shellApplication);
            return $this->View();
        }
    }

    public function Delete($id)
    {
        $response = $this->Helpers->ShellAuth->DeleteApplication($id);
        if($response['Error'] == 0){
            return $this->Redirect('/Applications/');
        }
    }

    public function Get($id)
    {
        var_dump($this->Helpers->ShellAuth->GetApplication($id));
    }
}