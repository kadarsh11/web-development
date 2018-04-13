<?php 
$temp=0;
$temp_min=0;
$temp_max=0;
$city="City Name";
$main="feature";
$wind_speed=0;
$wind_deg=0;
$pressure=0;
$visibility=0;
try {
  if (isset($_POST['submit'])) {
     $city=$_POST['city'];
    $key=['035025b8d9b6d76ad59bfa1a22f0ba00','84397a4e3bf950b868d80ae4f0710407','b3b8134d3dea2e0683a595224c21f436','3c57f00b7bfea0a1501d863ce578cb1a','869adb7ab2f2d75ed025f461c7c612c5']; 
    $url = "http://api.openweathermap.org/data/2.5/weather?q=".$city."&APPID=".$key[mt_rand(0,4)]; 
    $curl=curl_init($url); 
    curl_setopt($curl,CURLOPT_POST,false); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
    $json=curl_exec($curl); 
    curl_close($curl); 
    $arr=json_decode($json,true); 
    if ($arr['cod']==404) {
      $temp=0;
      $temp_min=0;
      $temp_max=0;
      $city="City not found";
      $main="";
      $wind_speed=0;
      $wind_deg=0;
      $pressure=0;
      $visibility=0;
    }
    else{
     
    $temp=$arr['main']['temp']-273.15; 
    $temp_min=$arr['main']['temp_min']-273.15;
    $temp_max=$arr['main']['temp_max']-273.15;
    $main=$arr['weather']['0']['main'];
    $wind_speed=$arr['wind']['speed'];
    $wind_deg=$arr['wind']['deg'];
    $pressure=$arr['main']['pressure'];
    $visibility=$arr['visibility']/1000;
    }
  }
} 
catch (Exception $e) {
  $temp=0;
}
 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <title>Weather App</title>
  </head>
  <body>
   <header class="mt-5">
      <div class="container-header">
         <form action="" method="post">
            <div class="input-group input-group-lg ">
              <input type="text" class="form-control" placeholder="City Name" name="city" autocomplete="off">
              <span class="input-group-btn">
                <button class="btn btn-lg btn-primary"  type="submit" name="submit">Report</button>
              </span>
            </div>
       </form>
       <h1 class="display-1 mt-5 text-white text-uppercase"><?php echo $city; ?></h1>
      </div>
   </header>
  <section>
    <div class="container">
          <div class="row">
            <div class="col-sm  col-height round-border bg-custom-1 mr-3">
              <div class="vert">
                <div class="vert-main">
                  <i class="far fa-sun icon-main mt-5"></i>
                  <h2 class="display-1 mt-3"><?php echo round($temp,2); ?> &deg;C</h2>
                </div>
                <div class="vert-sub">
                  <div class="row height">
                    <div class="col clearfix ">
                     <span class="font-italic vert-sub-heading d-block mb-4">Min Temp.</span>
                     <i class="fab fa-cloudversify float-left icon-sub mt-2"></i>
                     <h2 class="display-4 float-right mt-2 mr-2"><?php echo round($temp_min,1); ?>&deg;C</h2>
                   </div>
                    <div class="col">
                       <span class="font-italic vert-sub-heading d-block mb-4">Max Temp.</span>
                     <i class="fas fa-thermometer-three-quarters float-left icon-sub mt-2"></i>
                     <h2 class="display-4 float-right mt-2 mr-2"><?php echo round($temp_max,1); ?>&deg;C</h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm  col-height round-border bg-custom-2 mr-3">
              <div class="vert">
                <div class="vert-main">
                  <img src="img/wind-turbine.png" class="mt-5 custom-icon">
                  <h2 class="display-1 mt-3"><?php echo $main; ?></h2>
                </div>
                <div class="vert-sub">
                  <div class="row height">
                    <div class="col clearfix ">
                     <span class="font-italic vert-sub-heading d-block mb-4">Speed</span>
                    <!--  <i class="fab fa-cloudversify float-left icon-sub mt-2"></i> -->
                    <img src="img/breeze.png" class="float-left mt-2 custom-icon-pre">
                     <h2 class="display-4 float-left mt-4 ml-4 custom-font"><?php echo $wind_speed." m/s"; ?></h2>
                   </div>
                    <div class="col">
                       <span class="font-italic vert-sub-heading d-block mb-4">Degree</span>
                     <i class="fas fa-compass float-left icon-sub mt-2"></i>
                     <h2 class="display-4 float-left mt-2 ml-5"><?php echo round($wind_deg,1); ?>&deg;</h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm  col-height round-border bg-custom-3 mr-3">
              <div class="vert">
                <div class="vert-main">
                  <!-- <i class="far fa-sun icon-main mt-5"></i> -->
                  <img src="img/pressure.png" class="custom-icon mt-5">
                  <h2 class="display-3 mt-5"><?php echo $pressure; ?> hPa</h2>
                </div>
                <div class="vert-sub">
                  <div class="row height">
                    <div class="col clearfix ">
                     <span class="font-italic vert-sub-heading d-block mb-4">Humidity</span>
                     <img src="img/humidity.png" class="float-left mt-2 custom-icon-pre" style="height: 30%;">
                     <h2 class="display-4 float-left mt-2 ml-4"><?php echo round($temp_min,1); ?>&deg;C</h2>
                   </div>
                    <div class="col">
                       <span class="font-italic vert-sub-heading d-block mb-4">Visibility</span>
                     <i class="fab fa-cloudversify float-left icon-sub mt-2 pr-4" style="font-size: 4.5rem;"></i>
                     <h2 class="display-3 float-left mt-4 custom-font"><?php echo $visibility; ?>Km/h</h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
  </section>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </body>
</html>
