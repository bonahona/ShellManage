<?php
class UserController extends Controller
{
    public function BeforeAction()
    {
        $this->SetLinks();

        if(!$this->IsLoggedIn()) {
            if ($this->Action != "Login") {
                return $this->Redirect('/User/Login', array('ref' => $this->RequestUri));
            }
        }
    }

    public function SetLinks()
    {
        $this->Set('ApplicationLinks', $this->Helpers->ShellAuth->GetApplicationLinks()['data']);
    }

    public function Index()
    {
        $this->Title = 'Manage Users';

        $response = $this->Helpers->ShellAuth->GetUsers();
        $this->Set('Users', $response['data']);

        return $this->View();
    }

    public function LocalUsers()
    {
        $this->Title = "Local Users";

        $response = $this->Helpers->ShellAuth->GetLocalUsers();

        $this->Set('LocalUsers', $response['data']);
        return $this->View();
    }

    public function Details($id)
    {
        $this->Title = 'User details';

        if($id == null || $id == ""){
            return $this->HttpNotFound();
        }

        $response = $this->Helpers->ShellAuth->GetUser($id);

        if(isset($response['errors'])){
            return $this>$this->HttpNotFound();
        }

        if($response['data']['ShellUser'] == null){
            return $this->HttpNotFound();
        }

        $this->Set('User', $response['data']);

        $otherApplications = array();
        foreach($response['data']['ShellApplications'] as $application){
            $found = false;
            foreach($response['data']['ShellUser']['Privileges'] as $privilege){
                if($privilege['ShellApplication']['Id'] == $application['Id']){
                    $found = true;
                }
            }

            if(!$found){
                $otherApplications[] = $application;
            }
        }

        $this->Set('OtherApplications', $otherApplications);

        return $this->View();
    }

    public function Create()
    {
        $this->Title = 'Create User';

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
        $this->Title = "Edit User";

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
            $this->Set('ShellUser', $response['data']['ShellUser']);
            return $this->View();
        }
    }

    public function ResetPassword($id)
    {
        $this->Title = 'Reset Password';
        
        if($id == null || $id == ""){
            return $this->HttpNotFound();
        }

        if($this->IsPost() && !$this->Data->IsEmpty()){
            $user = $this->Data->RawParse('ShellUser');
            $password = $user['Password'];
            $response = $this->Helpers->ShellAuth->ResetPassword($user['Id'], $user['Password']);
            if(!isset($response['error'])){
                return $this->Redirect('/User/');
            }else{
                $response = $this->Helpers->ShellAuth->GetUser($id );
                $user = $response['data']['ShellUser'];
                $user['Password'] = $password;
                $this->Set('ShellUser', $user);
                return $this->View();
            }
        }else{
            $response = $this->Helpers->ShellAuth->GetUser($id );

            $user = $response['data']['ShellUser'];
            $user['Password'] = '';
            $this->Set('ShellUser', $user);
            return $this->View();
        }
    }

    public function GrantAccess($id)
    {
        if($id == null || $id == ""){
            return $this->HttpNotFound();
        }

        $response = $this->Helpers->ShellAuth->SetPrivilegeLevel($id, 1);

        if(!isset($response['errors'])) {
            if (isset($_GET['ref'])) {
                return $this->Redirect($_GET['ref']);
            } else {
                return $this->Redirect('/User/Details/' . $response['data']['ShellUserPrivilege']['ShellUserId']);
            }
        }
    }

    public function RevokeAccess($id)
    {
        if($id == null || $id == ""){
            return $this->HttpNotFound();
        }

        $response = $this->Helpers->ShellAuth->SetPrivilegeLevel($id, 0);

        if(!isset($response['errors'])) {
            if (isset($_GET['ref'])) {
                return $this->Redirect($_GET['ref']);
            } else {
                return $this->Redirect('/User/Details/' . $response['data']['ShellUserPrivilege']['ShellUserId']);
            }
        }
    }

    public function CreateAccess($userId = null, $applicationId = null)
    {
        if($userId == null || $applicationId == null){
            return $this->HttpNotFound();
        }

        $response = $this->Helpers->ShellAuth->CreatePrivilege($userId, $applicationId, 1);

        if(!isset($response['errors'])){
            if (isset($_GET['ref'])) {
                return $this->Redirect($_GET['ref']);
            } else {
                return $this->Redirect('/User/Details/' . $userId);
            }
        }
    }

    public function Delete($id)
    {
        if($id == null || $id == ""){
            return $this->HttpNotFound();
        }

        $this->Helpers->ShellAuth->DeleteUser($id);
        return $this->Redirect('/User/');
    }

    public function Login($ref = null)
    {
        $this->Title = 'Login';
        $this->Layout = 'Login';

        if($this->IsPost()) {
            $user = $this->Data->RawParse('User');

            $response = $this->Helpers->ShellAuth->Login($user['Username'], $user['Password']);

            if(isset($response['errors'])){
                foreach($response['errors'] as $error){
                    $this->ModelValidation->AddError('User', 'Password', $error);
                }
            }

            $ref = $this->Get['ref'];
            if($this->ModelValidation->Valid()) {
                if($ref == null || $ref == ""){
                    return $this->Redirect('/');
                }else{
                    return $this->Redirect($ref);
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

    public function SetPrivilegeLevel($userLevel)
    {
        $user = $this->GetCurrentUser();
        var_dump($this->Helpers->ShellAuth->SetPrivilegeLevel($userLevel, $user['Id']));
    }
}