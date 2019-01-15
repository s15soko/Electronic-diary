<div id="nav_bar">
    <div id="nav_bar-content">
        <div class="box">
            <h3>
            <?php
                
                $school = new schoolController();
                $s_query = $school->schoolInformation("nazwa");
                // show school name
                echo $s_query[0];
                
            ?>
            </h3>
            <small style="font-size: 16px;">Electronic-diary.com</small>
        </div>
        <div class="box">
            <img src='assets/logo.png'/>
        </div>
        <div class="box">
            <span>
                Hello 
                <?php 

                    $user = new userDataController();
                    $u_query = $user->getUserData("imie");
                    // show user name
                    echo $u_query[0]."!";
                ?>

            </span>
            <span id='myClockSPAN'>
                <script>

                    function waitSecond()
                    {
                        var waitTime = 1000;
                        time=setTimeout('displayClock()', waitTime)
                    }

                    function addZero(data)
                    {
                        if(data < 10)
                        {
                            data = "0" + data;
                        } 
                        return data;
                    }

                    function displayClock()
                    {
                        var date = new Date();
                        h = addZero(date.getHours());
                        m = addZero(date.getMinutes());
                        s = addZero(date.getSeconds());
                        document.getElementById("myClockSPAN").innerHTML = h+":"+m+":"+s;
                        waitSecond();
                    }

                </script>
            </span>
            <span>
                <a href="public/inc/destroySession.php">Log Out</a>
            </span>
        </div>
    </div>
</div>