<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Adding calories...</title>
        <meta http-equiv = "refresh" content = "1; url = index.php" />
    </head>
    <body>
        
        <?php


            $dataType = $_POST['add'];
            $input = $_POST['foodCalories'];

            


            if ($dataType == 'calories'){


            }elseif ($dataType == 'food'){

                $delimiter = ' ';
                $query = "";
                $words = explode($delimiter, $input);
                
                foreach($words as $word){
                    $query = $query . $word . '%20';
                }

                

                $curl = curl_init();

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

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    echo $response;
                }

            }



            

            


        ?>

    </body>
</html>