<?php

class roleController
{
    // ours available roles 
    private $availableRoles = array(
        0 => "USER",
        1 => "MODERATOR",
        2 => "ADMINISTRATOR"
    );

    // found and return role for user
    public function setUserRole($role)
    {
        foreach ($this->availableRoles as $key => $role_name) 
        {
            // return role name
            if($role_name === $role)
            {
                return $role_name;
            }
        }
    }

    // return all roles
    public function returnRoles()
    {
        return $this->availableRoles;
    }

    

}


?>