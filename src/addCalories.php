<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Adding calories...</title>
    </head>
    <body>
        
        

        <?php

            // get all data from form submission
            $dataType = $_POST['add'];
            $input = $_POST['foodCalories'];
            $name = $_POST['name'];
            

            // check input to see if user is inputing a food or specific calorie amount
            if ($dataType == 'calories'){
                // make sure that input is a validnumber
                if (is_numeric($input)){
                    $calories = $input;
                }
                else{
                    throw new Exception("invalid input");
                    exit();
                }
                    
            }elseif ($dataType == 'food'){
                if (is_numeric($input)){
                    throw new Exception("invalid input");
                    break;
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
                    throw new Exception("cURL Error #:". $err);
                    exit();
                } else {
                    $data = json_decode($response);
                    $calories = $data->items[0]->calories;
                }

                

                

                
            }
            
            // attempt to update users calorie amount from the data above
            // if anything failed the program will trow an error and exit
            try {
                require 'db.php';

                echo $calories;

                $sql = 'UPDATE CalorieAppUsers set Calories = Calories +' . $calories . ' where name = "' . $name . '";';
                $cmd = $db->prepare($sql);
                $cmd->execute();
            } catch {
                throw new Exception('Cant update database');
                exit();
            }
            

            

            


        ?>

        <form method="post" action="index.php" name="passName">
            <?php echo '<input type="hidden" id="name" name="name" value="' . $name . '">'?>
        </form>

        <script>
            window.onload = function(){
                document.forms['passName'].submit();
                }
        </script>

    </body>
</html>