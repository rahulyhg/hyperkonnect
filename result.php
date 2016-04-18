
<?php
include_once("class/db.php");

$db = new db();

// Initialise variables
$city = '';
$today = "";
$sunrise = '';
$sunset = '';
$temp = "";
$retCity = '';
$output = '';
$err = '';

		if (isset($_GET["city"])){
			
		// Grab the city name	
		$city = preg_replace("#[^a-z0-9, ]#i", "", $db->cleanData($_GET["city"]));
		 
		// Api 
	     $curr = 'http://api.openweathermap.org/data/2.5/weather?q='.$city.'&APPID=4c33dd536aacf812d66b4038e677e71c&mode=json&units=metric';
 
	
		$grab = @file_get_contents($curr);
		 
		 if ($grab === false){
			 $err = '<h3 style="text-align:center"> No result obtained </h3>';
			 }
 		 
		$readFile = json_decode($grab, true); 
				
		if ($readFile){
			  
			 $retCity = $readFile["name"].", ".$readFile["sys"]["country"]; 
			 $sunrise =date("g:i a",  $readFile["sys"]["sunrise"]);
			 $sunset = date("g:i a",  $readFile["sys"]["sunset"]);
		 
		 	$temp = round ($readFile["main"]["temp"], 2);
			$today = date("l").", ".date("j").date("S")." ".date("F").", ".date("Y");
			
		////Insert db if this is the fisrt search for the day
		
		$currDate = date("Y m d");
		
		$query = $db->runQuery("SELECT * FROM searches WHERE city = '$retCity' ");
		/// If query is successful
		if ($query){
		
		////	
		$tot = $db->numRows();
		$get = $db->getData();
		
		$prevSunrise = $get["sunrise"];
		$prevSunset = $get["sunset"];
		$prevTemp = $get["temp"];
		 
		/// As far as the current weather data does not match or has changed for the same city, insert	
			
		if ( ($tot < 1) || ($prevTemp != $temp && $prevSunrise != $sunrise && $prevSunset != $sunset) ){	
			$db->runQuery("INSERT INTO searches 
			(city, temp, sunrise, sunset, date)
			VALUES('$retCity', '$temp', '$sunrise', '$sunset', now())
			");
		}
			
			} // if query is successful	
			
			} // if read file is successful
		  
		  
		  //// Loop all previous searches with modified values
		  
		  $query = $db->runQuery("SELECT * FROM searches WHERE 
		  city = '$retCity' AND  temp != '$temp'    ");
		  
		 if ($db->numRows() < 1){
			 $output = "<li> <h5 style='text-align:center'> No previous search for this city </h5> </li>";
			 }
			 else {
				
			while($row = $db->getData()){
				$output = ' <li> <div class="prev-date"> 
     				<h6 style=""> '.date( 'l', strtotime($row["date"]) ).' </h6>
					<h6 style=""> '.date( 'jS F, Y', strtotime($row["date"]) ).' </h6>
					<h6 style=""> '.date( 'g:i a', strtotime($row["date"]) ).' </h6>
     
   					 </div> 
    
   				 <div class="prev-info"> 
  				 <h5> Temperature was at <span class="prev-temp"> '.$prevTemp.'°C </span> </h5> 
   
   <span class="prev-set"> Sunrise <i class="dx"> '.$prevSunrise.' </i> </span> 
   <span class="prev-set"> Sunset  <i class="dx"> '.$prevSunset.' </i> </span>
   
    </div>  
    
    </li>
     ';
				}	 
				 
				 } 
		 
				
			} // if isset
 

// If no get request is received
			if (!isset($_GET["city"])){
				header("location: ".URL);
				exit();
				}
?>

<!DOCTYPE html>
<html>
<head>
	<title>HyperConnect | Home</title>
	<link rel="stylesheet" href="css/style.css">
	<link href='//fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,700,300,200' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/jquery.jqplot.min.css" />
	<!-- For-Mobile-Apps-and-Meta-Tags -->
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="HyperKonnect Weather Informant" />
		 
</head>

<body>
<div class="overlay">
    <h1>HyperKonnect Weather Informant</h1>
    <div class="wrap-left">
      <div class="top-info"> 
      
      <h3> <?php echo $retCity; ?> </h3>
      <?php echo $err; ?>
      
     <ul class="etal"> 
     <li> Sunrise at <span><?php echo $sunrise ?></span> </li>
     <li class="temp" style="text-align:center"> 
	 <?php  
	 //
	 echo '<img src="http://openweathermap.org/img/w/'.$readFile["weather"][0]["icon"].'.png">
	 <span class="temp-wru"> '.$temp.'°C</span>' ?> </li>
     
     <li> Sunset at <span> <?php echo $sunset ?></span> </li>
     
     <div style="clear:both"> </div>
     
     </ul> 
      
      </div>
	 
     <div class="bottom-info">
     <h4> <?php echo $today ?> </h4>
     </div>
     
	</div>
    <div class="wrap-right">
    
    <div class="top-info">
     <h3 style="font-size:19px"> PREVIOUS SEARCHES </h3>
    
    <ul class="dew"> 
   
     <?php echo  $output ?>
     
    <div style="clear:both"> </div>
    </ul> 
     
    </div>
    
    
    <div class="bottom-info">
      <a href="<?php echo URL ?>"><h4> Back to Home</h4></a>
     </div>
    </div>
    <div style="clear:both"> </div>
	<div class="footer">
		<p> Template by <a href="http://w3layouts.com">W3layouts</a></p>
	</div>
  
  
  </div>
</body>
</html>