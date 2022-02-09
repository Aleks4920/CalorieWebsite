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

        <div class="wrapper">
            <div class="loader center"><span></span></div>
            
        </div>

        

        


        <h1>Calories</h1>
        <p id="calories"></p>

        <form method="post" action="addCalories.php">
            <select name="add" id="add">
                <option value="food">Add Food</option>
                <option value="calories">Add calorie Amount</option>
            </select>

            <input type="text" id="foodCalories" name="foodCalories">
            <input type="submit" value="Add">
        </form>
        
        

        
        <?php
            require 'db.php';
            
            // set up & run query
            $sql = 'SELECT Calories, CalorieGoal FROM CalorieAppUsers where name = "Philep";';
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $results = $cmd->fetchAll(PDO::FETCH_ASSOC);


            $calories = $results[0]['Calories'];
            $calorieGoal = $results[0]['CalorieGoal'];
            

            $precent = ($calories / $calorieGoal) * 100;
            

            echo '<div role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="6000" style="--filled: '. $precent . '; --number:'. $calories . '"></div>';
            $db = null;
        ?>


        


        <script>
            $(window).on('load', function(){
                $(".wrapper").fadeOut("slow");
            })
        </script>

    </body>

</html>
