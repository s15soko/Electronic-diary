
<form id='editFormBuilder'<?php 
    if(isset($method))
    {
        echo "method=$method";
        echo " ";
    }  

    if(isset($js))
    {
        echo "onsubmit='$js'";
    }

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

            // input for select
            if($input['type'] === 'select')
            {
                echo "<select name='$input[name]' required>";
                
                    // set same value
                    echo "<option value='$input[value]'>Pozostaw to samo</option>";

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
            echo "</div>";
        }
    }
    ?>
</form>