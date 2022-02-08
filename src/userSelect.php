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
        <ul>
        <?php
            require 'db.php';

            // set up & run query
            $sql = "SELECT * FROM CalorieAppUsers";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $users = $cmd->fetchAll();

            foreach ($users as $user){
                echo"<li>" . $user["name"] . "</li>";
            }


            $db = null;
        ?>
        </ul>



        

    </body>

</html>
