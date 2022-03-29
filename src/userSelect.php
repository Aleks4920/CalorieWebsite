<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="robots" content="noindex, nofollow">
        <meta charset="utf-8">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <link rel="stylesheet" href="css/styles.css">
        <title>Calories</title>
    </head>
    <body>

        <div class="wrapper">
            <div class="loader center"><span></span></div>
            
        </div>
        

        

        <script>
            $(window).on('load', function(){
                $(".wrapper").fadeOut("slow");
            })
        </script> 

        <h1>Welcome, whats your name?</h1>
        <div>
            <label>already a user</label>
            <form method="post" action="index.php">
                <select name="name">
                <?php
                    require 'db.php';

                    // set up & run query
                    $sql = "SELECT * FROM CalorieAppUsers";
                    $cmd = $db->prepare($sql);
                    $cmd->execute();
                    $users = $cmd->fetchAll();

                    foreach ($users as $user){
                        echo'<option value="'.  $user["name"] . '">' . $user["name"] . '</option>';
                    }


                    $db = null;
                ?>
                
                </select>
                <input type="submit" name="submit" value="Choose user">
            </form>
        </div>

        <div>
            <label>Not a user? add yourself</label>
            <form method="post" action="index.php">
                <input type="text" name="name" minlength="2" placeholder="Name" required>
                <input type="number" name="calorieGoal" minlength="3"  placeholder="Calories" required>
                <input type="submit" name="submit" value="Add New User">
            </form>
        </div>


        

    </body>

</html>
