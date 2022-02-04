<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="robots" content="noindex, nofollow">
        <meta charset="utf-8">
        <script src='./config.js'></script>
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
        <p id="calories">

        <div role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="6000" style="--filled: 60; --number:1500"></div>
        <?php
            require 'db.php';

            // set up & run query
            $sql = "SELECT * FROM relatives";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $relatives = $cmd->fetchAll();


            $db = null;
        ?>



        

    </body>

</html>
