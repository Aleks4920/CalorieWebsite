<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Adding calories...</title>
    </head>
    <body>
        
        

        <?php
            // takes user back to homepage if error occures
            function error($msg, $name){
                echo '<input type="hidden" id="name" name="name" value="' . $name . '">';
                echo '<input type="hidden" id="msg" name="msg" value="' . $msg . '">';
                echo "<script>
                        window.onload = function(){
                        document.forms['passName'].submit();
                        }
                    </script>";
            }

            try{
                // get all data from form submission
                $dataType = $_POST['add'];
                $input = $_POST['foodCalories'];
                $name = $_POST['name'];

                if(!isset($name)){
                    error("invalid user", $name);
                }
                

                // check input to see if user is inputing a food or specific calorie amount
                if ($dataType == 'calories'){
                    // make sure that input is a validnumber
                    if (is_numeric($input)){
                        $calories = $input;
                    }
                    else{
                        error("calories must be number", $name);
                    }
                        
                }elseif ($dataType == 'food'){
                    if (is_numeric($input)){
                        error("invalid Type", $name);
                    }
                    
                    // change string to an array
                    $delimiter = ' ';
                    $query = "";
                    $words = explode($delimiter, $input);
                    
                    // add array to query string
                    foreach($words as $word){
                        $query = $query . $word . '%20';
                    }
                        
                    // use curl to send request to api
                    $curl = curl_init();


                    // set up api call 
                    curl_setopt_array($curl, [
                        CURLOPT_URL => "https://calorieninjas.p.rapidapi.com/v1/nutrition?query=" . $query,
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
                    // if api request is successful decode the json and parse out calories
                    if ($err) {
                        error("invalid Input", $name);
                    } else {
                        $data = json_decode($response);
                        $calories = $data->items[0]->calories;
                    }

                    

                    

                    
                } else {
                    error("invalid Input", $name);
                }
                
                // attempt to update users calorie amount from the data above
                // if anything failed the program will trow an error and exit
                try {
                    require 'db.php';

                    echo $calories;

                    $sql = 'SELECT userID FROM CalorieAppUsers where name = "' . $name . '" ;';
                    $cmd = $db->prepare($sql);
                    $cmd->execute();
                    $id = $cmd->fetch();

                    $sql = 'UPDATE UsersCalories set Calories = Calories +' . $calories . ' where userID = ' . $id[0] . ';';
                    $cmd = $db->prepare($sql);
                    $cmd->execute();
                } catch (Exception $e) {
                    error("invalid Input", $name);
                }
            } catch (Exception $e) {
                error($e, $name);
            }

            
            
            


        ?>
        
        <form method="post" action="index.php" name="passName">
            <?php echo '<input type="hidden" id="name" name="name" value="' . $name . '">';?>
        </form>

        <script>
            window.onload = function(){
                document.forms['passName'].submit();
                }
        </script>

    </body>
</html>