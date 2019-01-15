
<form id='editFormBuilder'

<?php 

    if(isset($method))
    {
        echo "method=$method";
        echo " ";
    }  


    if(isset($js)) echo "onsubmit='$js'";
    ?>

    >

<?php

    // show inputs
    if(isset($inputs) && $inputs)
    {
        foreach ($inputs as $m_key => $input) 
        {
            echo "<div>";
            // header text
            if($headertext)
            {
                foreach ($headertext as $header_key => $header_text) 
                {
                    if($header_key === $m_key)
                    {
                        echo "<h2>$header_text</h2>";
                    }
                }
            }


            // input
            if($input['type'] !== 'select' && $input['type'] !== 'selectrole')
            {
                // input
                echo "<input ";
                foreach ($input as $key => $value) 
                {
                    // set input 
                    echo "$key = '$value'";      
                }
                echo ">";
            }

            // input for select (for edit pages)
            if($input['type'] === 'select')
            {
                echo "<select name='$input[name]' required>";
                
                    // set same value
                    echo "<option value='$input[value]'>Leave same value</option>";

                    // set options...
                    foreach($input['options'] as $key => $option)
                    {
                        
                        echo "<option value='$option[id]'>";
                            foreach ($name_options as $key => $opt_name) 
                            {
                                if($m_key === $key)
                                {
                                    echo $option[$opt_name];
                                }
                            }
                        echo "</option>"; 
                    }

                echo "</select>";
            }

            // input for select (for user register page)
            if($input['type'] === 'selectrole')
            {
                echo "<select name='$input[name]' required>";
                
                    // set empty option
                    echo "<option disabled selected value>Choose role</option>";

                    // set options...
                    foreach($input['options'] as $key => $option)
                    {   
                        echo "<option value='$option'>$option</option>";
                    }

                echo "</select>";
            }

            echo "</div>";
        } // end foreach
    } // end if
?>

</form>