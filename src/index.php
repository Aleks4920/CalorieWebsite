<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="robots" content="noindex, nofollow">
        <meta charset="utf-8">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="./js/main.js"></script>
        <link rel="stylesheet" href="css/styles.css">
        <title>Calories</title>
    </head>
    <body>


        <!-- loader that plays while page is loading, credit to Nobuaki Honma-->
        <!-- codepen at https://codepen.io/nobuakihonma/pen/dYbqLQ  -->
        <div class="wrapper">
            <ul class="loader-list">
                <li>
                <div class="loader-5 center"><span></span></div>
            </li>
            </ul>
        </div>

        <!-- makes loader disappear after page is loaded-->
        <script>
            $(window).on('load', function(){
                $(".wrapper").fadeOut("fast");
            })
        </script>

        <!-- get the users -->
        <?php
            require 'db.php';
            
            if (array_key_exists('submit',$_POST)){

                if($_POST['submit'] == 'Add New User'){
                    $name = $_POST['name'];
                    $calorieGoal = $_POST['calorieGoal'];
                    
                    if(!is_numeric($name) ||strlen($name) >= 2 || is_numeric($calorieGoal)){
                        // set up & run query to get users calories and calorie goal
                        $sql = 'INSERT INTO CalorieAppUsers (name) VALUES ("' . $name . '");';
                        $cmd = $db->prepare($sql);
                        $cmd->execute();

                        $sql = 'SELECT userID FROM CalorieAppUsers where name = "' . $name . '" ;';
                        $cmd = $db->prepare($sql);
                        $cmd->execute();
                        $id = $cmd->fetch();


                        $sql = 'INSERT INTO UsersCalories (userID, UsersCalories) VALUES (' . $id . ',  "' . $name . '");';
                        $cmd = $db->prepare($sql);
                        $cmd->execute();
                    }
                }
                
                
            }

            
            
            $name = $_POST['name'];
            
            if(!isset($name)){
                header('Location:userSelect.php');
                exit();
            }
            
            
            
            



            
            
            //$name = "Philep";
            ?>
            
        <a href="userSelect.php" id="userSelect">Change User</a>

        <h1>Calories</h1>
            
        
        
        

        
        <?php
            
            $sql = 'SELECT userID FROM CalorieAppUsers where name = "' . $name . '" ;';
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $id = $cmd->fetch();

            // set up & run query to get users calories and calorie goal
            $sql = 'SELECT Calories, CalorieGoal FROM UsersCalories where userID =  "' . $id[0] . '";';
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $results = $cmd->fetchAll(PDO::FETCH_ASSOC);

            // get values from the table returned
            $calories = $results[0]['Calories'];
            $calorieGoal = $results[0]['CalorieGoal'];
            
            // calculate how much of the circle to fill (how close the user is to their goal)
            $precent = ($calories / $calorieGoal) * 100;
            
            // show users progress using a circle that fills up as they get closer to their goal
            echo '<div role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="6000" style="--filled: '. $precent . '; --number:'. $calories . '"></div>';
            
            // exit data base
            $db = null;
        ?>


        <!-- a form for the user to add their calories or what they ate -->
        <form method="post" action="addCalories.php" id="addCaloriesForm">
            <select name="add" id="add">
                <option value="food">Add Food</option>
                <option value="calories">Add calorie Amount</option>
            </select>
            <input type="text" id="foodCalories" name="foodCalories">
            <?php echo '<input type="hidden" id="name" name="name" value="' . $name . '">'?>
            <input type="submit" value="Add">
        </form>
        


        

    </body>

</html>
