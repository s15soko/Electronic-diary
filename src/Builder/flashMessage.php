<?php
// if flash message is set
if(isset($_SESSION['flashMessage']))
{
    if(is_array($_SESSION['flashMessage']))
    {
        foreach ($_SESSION['flashMessage'] as $key => $message) 
        {
            echo "<span class='flash_message'>". $message . "</span>";
        }
    }
    else
    {
        echo "<span class='flash_message'>". $_SESSION['flashMessage'] . "</span>";
    }
    
    // unset 
    unset($_SESSION['flashMessage']);
}
?>