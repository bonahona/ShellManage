<?php
class ShellAuthHelper implements  IHelper
{
    public $ApplicationName;
    public $PublicKey;

    public $ShellAuthServer;
    public $ShellAuthPort;
    public $ShellAuthMethodPath;
    public $Controller;

    public function Init($config, $controller)
    {
        $this->ApplicationName = $config['ShellApplication']['Name'];
        $this->PublicKey = $config['ShellApplication']['PublicKey'];

        $this->ShellAuthServer = $config['ShellAuthServer']['Server'];
        $this->ShellAuthPort = $config['ShellAuthServer']['Port'];
        $this->ShellAuthMethodPath = $config['ShellAuthServer']['MethodPath'];

        $this->Controller = $controller;
    }

    public function CreateApplication($application)
    {
        $payLoad = array(
            'ShellApplication' => $application
        );

        $callPath = $this->GetApplicationPath();

        return $this->SendToServer($payLoad, $callPath);
    }

    public function EditApplication($application)
    {
        $payload = array(
            'ShellApplication' => $application
        );

        $callPath = $this->GetApplicationPath('EditApplication');
        return $this->SendToServer($payload, $callPath);
    }

    public function DeleteApplication($id)
    {
        $payLoad = $id;
        $callPath = $this->GetApplicationPath('DeleteApplication');
        return $this->SendToServer($payLoad, $callPath);
    }

    public function GetApplications()
    {
        $payload = "query{
	ShellApplications {
		Id,
		Name,
		IsActive
	}
}";
        return $this->SendToServer($payload);
    }

    public function GetApplication($id)
    {
        $payload = "query{
	ShellApplication(id: \"$id\") {
		Id,
		Name,
		IsActive,
		RsaPublicKey,
		DefaultUserLevel
	}
}";
        return $this->SendToServer($payload);
    }

    public function CreateUser($shellUser)
    {
        $username = $shellUser['Username'];
        $displayName = $shellUser['DisplayName'];
        $password =$shellUser['Password'];

        $payLoad = "mutation{
	ShellUser(
		Username: \"$username\",
		DisplayName: \"$displayName\",
		Password: \"$password\"
	){
		Id,
		Username,
		DisplayName
	}
}";
        return $this->SendToServer($payLoad);
    }

    public function EditUser($shellUser)
    {
        $id = $shellUser['Id'];
        $username = $shellUser['Username'];
        $displayName = $shellUser['DisplayName'];

        $payLoad = "mutation{
	ShellUser(
		Id: \"$id\",
		Username: \"$username\",
		DisplayName: \"$displayName\"
	){
		Id,
		Username,
		DisplayName
	}
}";

        return $this->SendToServer($payLoad);
    }

    public function ResetPassword($userId, $password)
    {
        $payLoad = array(
            'ShellUser' => array(
                'Id' => $userId,
                'Password' => $password
            )
        );

        return $this->SendToServer($payLoad);
    }

    public function Login($username, $password)
    {
        $payLoad = "mutation{
	Login(
		username: \"$username\",
		password: \"$password\",
		application: \"$this->ApplicationName\"
	){
		Guid,
		Expires,
		Issued,
		ShellUserPrivilege{
			ShellUser{
				Id,
				DisplayName,
				Username,
				IsActive
			}
		}
	}
}";

        $response =  $this->SendToServer($payLoad);

        if(count($response['errors']) == 0){
            $this->Controller->Session['SessionToken'] = $response['data']['Login']['Guid'];
            $user = $response['data']['Login']['ShellUserPrivilege']['ShellUser'];
            $this->Controller->SetLoggedInUser($user);

            // Check if a local user exists, and if not, create on
            $userId = $user['Id'];
            if(!$this->Controller->Models->LocalUser->Any(array('ShellUserId' => $userId))){
                $localUser = $this->Controller->Models->LocalUser->Create(array('ShellUserId' => $userId));
                $localUser->Save();
            }
        }

        return $response;
    }

    public function Logout($accessToken = null)
    {
        $this->Controller->Session->Destroy();
    }

    public function GetUser($id)
    {
        $payload = "query{
	ShellUser(id: \"$id\")
	{
		Id,
		Username,
		DisplayName,
		IsActive,
		Privileges{
			ShellApplication{
				Id,
				Name,
				IsActive
			},
			UserLevel
		}
	}
}";

        return $this->SendToServer($payload);
    }

    public function GetUsers()
    {
        $payload = 'query{
	ShellUsers{
		Id,
		Username,
		DisplayName,
		IsActive
	}
}';
        return $this->SendToServer($payload);
    }

    public function GetLocalUsers()
    {
        $callPath = $this->GetApplicationPath('GetLocalUsers');
        return $this->SendToServer(array(), $callPath);
    }

    public function SetPrivilegeLevel($userLevel, $userId, $applicationId = null)
    {
        $payLoad = array(
            'ShellUserPrivilege' => array(
                'ShellUserId' => $userId,
                'UserLevel' => $userLevel
            )
        );

        if($applicationId != null){
            $payLoad['ShellUserPrivilege']['ShellApplicationId'] = $applicationId;
        }

        $callPath = $this->GetApplicationPath('SetPrivilegeLevel');
        return $this->SendToServer($payLoad, $callPath);
    }

    public function GetUserApplicationPrivileges($userId)
    {
        $payLoad = array(
            'Id' => $userId
        );

        $callPath = $this->GetApplicationPath('GetUserApplicationPrivileges');
        return $this->SendToServer($payLoad, $callPath);
    }

    protected function GetApplicationPath()
    {
        $result = 'http://' . $this->ShellAuthServer . ":" . $this->ShellAuthPort . $this->ShellAuthMethodPath;

        return $result;
    }

    protected function SendToServer($payload)
    {
        $callPath = $this->GetApplicationPath();
        $data = ['query' => $payload];

        $data = json_encode($data);

        $headers = [
            'Content-Type: application/json',
            'Authorization: ' . $this->Controller->Session['SessionToken']
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $callPath);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, "ShellAuthConnector");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        if(!$response = curl_exec($curl)){
            $curlError = curl_error($curl);
            //$curlErrorCode = curl_errno($curl);

            return array(
                'data' => [],
                'errors' => [
                    $curlError
                ]
            );
        }

        curl_close($curl);

        return json_decode($response, true);
    }
}