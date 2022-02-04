

// import api

var query = '3lb carrots'
$.ajax({
    method: 'GET',
    url: 'https://api.calorieninjas.com/v1/nutrition?query=' + query,
    headers: { 'X-Api-Key': process.env.APIKEY},
    contentType: 'application/json',
    success: function(result) {
        console.log(result);
        document.getElementById("calories").innerHTML = JSON.stringify(result.items[0].calories);

        // document.getElementById("food").innerHTML = JSON.parse(result);

    },
    error: function ajaxError(jqXHR) {
        console.error('Error: ', jqXHR.responseText);
    }
});



