<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/car.php";
    $app = new Silex\Application();
    $app->get("/", function() {
        return
             "<!DOCTYPE html>
             <html>
             <head>
                <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css' type='text/css'>
                <title>Find a Car</title>
             </head>
             <body>
                <div class='container'>
                    <h1>Find a Car!</h1>
                    <form action='/car'>
                        <div class='form-group'>
                            <label for='price'>Enter Maximum Price:</label>
                            <input id='price' name='price' class='form-control' type='number'>
                            <label for='mileage'>Enter Max Miles:</label>
                            <input id='mileage' name='mileage' class='form-control' type='number'>
                        </div>
                        <button type='submit' class='btn-success'>Submit</button>
                    </form>
                </div>
             </body>
             </html>";
    });
$app->get("/car", function() {
    $new_car1 = new Car("Ford 2014",300000,5000,"ford.jpg");
    $new_car2 = new Car("Chevy 2014",250000,5600,"chevy.jpg");
    $new_car3 = new Car("Porsche 2014",36034,60093,"ford.jpg");
    $array = array($new_car1,$new_car2,$new_car3);
    $cars_matching_search = array();
foreach ($array as $car)
      {
          if($car->worthBuying($_GET['price'],$_GET['mileage'])){
              array_push($cars_matching_search, $car);
          }
      }
    $output="";
    if(empty($cars_matching_search)){
        return "Error please fill feilds that are empty";
    }
    else{ foreach($cars_matching_search as $car){
            $price=$car->getPrice();
            $miles=$car->getMiles();
            $model=$car->getMake_model();
            $output .= "Price is"."<br/>". $price. " <br/> Miles are"."<br/>". $miles." <br/> Miles are"."<br/>". $model;
        }
    }
    return $output;
});
return $app;
?>
