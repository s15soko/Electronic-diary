<?php

class roleController
{
    // ours available roles 
    private $availableRoles = array(
        0 => "USER",
        1 => "MODERATOR",
        2 => "ADMINISTRATOR"
    );

    private $schoolAvailableRoles = array(
        0 => "STUDENT", // user
        1 => "TEACHER", // moderator
        2 => "DIRECTOR" // administrator
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

    // return all school roles
    public function returnSchoolRoles()
    {
        return $this->schoolAvailableRoles;
    }


}


?>