<?php
// need $inputs, $method, $headertext
?>

<form <?php if($method) echo "action=$method"; ?>>

    <?php
    // show inputs
    if($inputs)
    {

        
        foreach ($inputs as $key => $input) 
        {
            echo "<div>";
            // header text
            if($headertext)
            {
                foreach ($headertext as $header_key => $header_text) 
                {
                    if($header_key === $key)
                    {
                        echo "<h2>$header_text</h2>";
                    }
                }
            }


            if($input['type'] !== 'select')
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

            if($input['type'] === 'select')
            {
                echo "<select name='$input[name]'>";
                    foreach($input['options'] as $key => $option)
                    {
                        echo "<option value='$option[id]'>$option[rok_szkolny]</option>";
                    }
                echo "</select>";
            }


            
            echo "</div>";
        }
        

    }

    ?>

</form>