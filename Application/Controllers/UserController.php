<?php
class UserController extends Controller
{
    public function BeforeAction()
    {
        if(!$this->IsLoggedIn()) {
            if ($this->Action != "Login") {
                return $this->Redirect('/User/Login', array('ref' => $this->RequestUri));
            }
        }
    }

    public function Index()
    {
        $response = $this->Helpers->ShellAuth->GetUser();
        if($response['Error'] == 0){
            $this->Set('Users', $response['Data']);
        }else{
            $this->Set('Users', array());
        }

        return $this->View();
    }

    public function LocalUsers()
    {
        $response = $this->Helpers->ShellAuth->GetLocalUsers();

        $this->Set('Users', $response['Data']);
        return $this->View();
    }

    public function Details($id)
    {
        if($id == null || $id == ""){
            return $this->HttpNotFound();
        }

        $response = $this->Helpers->ShellAuth->GetUser($id);

        if($response['Error'] == 0){
            $user = $response['Data'][0];
            $this->Set('User', $user);
        }

        $this->View();
    }

    public function Create()
    {
        if($this->IsPost() && !$this->Data->IsEmpty()){
            $user = $this->Data->RawParse('ShellUser');

            $response = $this->Helpers->ShellAuth->CreateUser($user);
            if($response['Error'] == 0){
                return $this->Redirect('/User/');
            }else {
                $this->ModelValidation->AddError('User', 'Username', $response['ErrorList']);
                $this->Set('ShellUser', $user);
                return $this->View();
            }
        }else{
            $user = array(
                'Username' => '',
                'DisplayName' => '',
                'Password' => ''
            );
             $this->Set('ShellUser', $user);
            return $this->View();
        }
    }

    public function Edit($id)
    {
        if($id == null || $id == ""){
            return $this->HttpNotFound();
        }

        if($this->IsPost() && !$this->Data->IsEmpty()){
            $user = $this->Data->RawParse('ShellUser');
            $response = $this->Helpers->ShellAuth->EditUser($user);

            if($response['Error'] == 0){
                return $this->Redirect('/User/');
            }else{
                $this->Set('ShellUser', $user);
                return $this->View();
            }
        }else{
            $response = $this->Helpers->ShellAuth->GetUser($id);
            $this->Set('ShellUser', $response['Data'][0]);
            return $this->View();
        }
    }

    public function ResetPassword($id)
    {
        if($id == null || $id == ""){
            return $this->HttpNotFound();
        }

        if($this->IsPost() && !$this->Data->IsEmpty()){
            $user = $this->Data->RawParse('ShellUser');
            $response = $this->Helpers->ShellAuth->ResetPassword($user['Id'], $user['Password']);
            if($response['Error'] == 0){
                return $this->Redirect('/User/');
            }else{
                $this->ModelValidation('ShellUser', 'Password', $response['ErrorList']);
                $this->Set('ShellUser', $user);
                return $this->View();
            }
        }else{
            $response = $this->Helpers->ShellAuth->GetUser($id);

            $user = $response['Data'][0];
            $user['Password'] = '';
            $this->Set('ShellUser', $user);
            return $this->View();
        }
    }

    public function GrantAccess($id, $applicationId = null)
    {
        if($id == null || $id == ""){
            return $this->HttpNotFound();
        }

        $response = $this->Helpers->ShellAuth->SetPrivilegeLevel(1, $id, $applicationId);

        return $this->Redirect('/User/Details/' . $id);

    }

    public function RevokeAccess($id, $applicationId = null)
    {
        if($id == null || $id == ""){
            return $this->HttpNotFound();
        }

        $response = $this->Helpers->ShellAuth->SetPrivilegeLevel(0, $id, $applicationId);

        return $this->Redirect('/User/Details/' . $id);
    }

    public function Delete($id)
    {
        if($id == null || $id == ""){
            return $this->HttpNotFound();
        }

        $this->Helpers->ShellAuth->DeleteUser($id);
        return $this->Redirect('/User/');
    }

    public function Login($ref)
    {
        if($this->IsPost()) {
            $user = $this->Data->RawParse('User');

            $response = $this->Helpers->ShellAuth->Login($user['Username'], $user['Password']);

            if($response['Error'] != 0){
                foreach($response['ErrorList'] as $error){
                    $this->ModelValidation->AddError('User', 'Password', $error);
                }
            }

            if($this->ModelValidation->Valid()) {
                if($ref == null || $ref == ""){
                    return $this->Redirect('/');
                }else{
                    $this->Redirect($ref);
                }
            }

            $this->Set('User', $user);
            return $this->View();
        }else{
            return $this->View();
        }
    }

    public function Logout()
    {
        $this->Helpers->ShellAuth->Logout();
        return $this->Redirect('/User/Login/');
    }

    public function CheckAccessToken()
    {
        var_dump($this->Helpers->ShellAuth->CheckAccessToken());
    }
    public function Get($id)
    {
        var_dump($this->Helpers->ShellAuth->GetUser($id));
    }

    public function SetPrivilegeLevel($userLevel)
    {
        $user = $this->GetCurrentUser();
        var_dump($this->Helpers->ShellAuth->SetPrivilegeLevel($userLevel, $user['Id']));
    }
}