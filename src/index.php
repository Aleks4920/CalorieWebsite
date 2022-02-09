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

        <script>
            $(window).on('load', function(){
                $(".wrapper").fadeOut("slow");
            })
        </script>

        


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
        <div role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="6000" style="--filled: 60; --number:1500"></div>
        
        
        <?php
            require 'db.php';


            function debug_to_console($data) {
                $output = $data;
                if (is_array($output))
                    $output = implode(',', $output);
            
                echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
            }
            
            // set up & run query
            $sql = 'SELECT userID, Calories, CalorieGoal FROM CalorieAppUsers where name = "Kyle";';
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $results = $cmd->fetchAll();
            debug_to_console($results);
            foreach($results as $result){
                foreach($result as $i){
                    echo $i . "\n";
                }
                
            }
            // $precent = ($calories / $calorieGoal) * 100;
            // echo $precent;

            
            $db = null;
        ?>
        


        

    </body>

</html>
