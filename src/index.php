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

        <div role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="6000" style="--filled: 60; --number:1500"></div>
        
        
        <?php
            require 'db.php';

            
            // set up & run query
            $sql = "SELECT * FROM relatives";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $relatives = $cmd->fetchAll();
                

            $APIURL = 'https://api.calorieninjas.com/v1/nutrition?query=';
            $query = array('3lb carrots and a chicken sandwich');
            $token= 'WsuXZ4DxNiOMxogK3U7xig==zR210Rbuk8WIDnJK';
            

            
            $curl = curl_init();

            curl_setopt_array($curl, [
            CURLOPT_URL => "https://calorieninjas.p.rapidapi.com/v1/nutrition?query=1%20glass%20of%20skimmed%20milk.%20",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: calorieninjas.p.rapidapi.com",
                "x-rapidapi-key: ce19d0164fmsh3d383efc0e85ce5p16dcb1jsnb1a4a3c79541"
            ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
            echo "cURL Error #:" . $err;
            } else {
                json_decode($response);
                echo $response;
            }
            


            $db = null;
        ?>
        


        

    </body>

</html>
