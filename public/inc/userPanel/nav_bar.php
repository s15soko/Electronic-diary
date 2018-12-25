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
            <small style="font-size: 16px;">dziennikElektryczny.pl</small>
        </div>
        <div class="box">
            <img src='assets/logo.png'/>
        </div>
        <div class="box">
            <span>
                Witaj 
                <?php 

                    $user = new userDataController();
                    $u_query = $user->getUserData("imie");
                    // show user name
                    echo $u_query[0]."!";
                ?>

            </span>
            <span>
                <?php
                $date = new DateTime();
                echo $date->format('H:i:s');
                ?>
            </span>
            <span>
                <a href="public/inc/destroySession.php">Wyloguj</a>
            </span>
        </div>
    </div>
</div>