<?php


/* Simple Linear Regression


*/



class LinearRegression
{
 function __construct(  )
 {
    //Set all *.prev_calculated members to false.
    $this->reset();
 }
 
 
 /* APPARENTLY PHP WON'T LET ME OVERLOAD METHODS >_>
 //Overloaded constructor that will accept datasets
 //upon creation of the object.
 function __construct( array $x, array $y  )
 { 
   $this->x_dataset = $x;
   $this->y_dataset = $y;
   $this->__construct();
 }
  */
  
  
 
 
 //REDUNDANT CODE EXISTS PURELY FOR PERFORMANCE PURPOSES 
  
 public function extrapolate_y_using_x( $x )
 {
   return (($this->get_gradient() * $this->get_x_mean()) + $this->get_intercept());
 }

 public function extrapolate_x_using_y( $y )
 {
   return (($this->get_y_mean() - $this->get_intercept()) / $this->get_gradient());
 }
 
 
 public function set_data( array $x, array $y )
 {
  $this->x_dataset = $x;
  $this->x_size = count($x);
  $this->y_dataset = $y;
  $this->y_size = count($y);
  
  $this->reset();
 }
 
 public function get_x_mean()
 {
   //If the mean has already been calculated
   //just return the mean.
   if( $this->x_mean_prev_calculated )
	 return $this->x_mean;
   
   //Mean hasn't been calculated, calculate it.
   $this->x_mean = 0;
   foreach( $this->x_dataset as $x_i ) 
		$this->x_mean += $x_i;
   
   $this->x_mean /= $this->x_size;		
   
   //Mean has been calculated
   $this->x_mean_prev_calculated = true;   
   return $this->x_mean;
 }

 
 
 public function get_y_mean()
 {
    //If the mean has already been calculated
   //just return the mean.
   if( $this->y_mean_prev_calculated )
	 return $this->y_mean;
   
   //Mean hasn't been calculated, calculate it.
   $this->y_mean = 0;
   foreach( $this->y_dataset as $y_i ) 
		$this->y_mean += $y_i;
   
   $this->y_mean /= $this->y_size;		
   
   //Mean has been calculated
   $this->y_mean_prev_calculated = true;   
   return $this->y_mean;
 }

 
 
 public function get_x_variance()
 {
  if( $this->x_variance_prev_calculated )
	return $this->x_variance;
	
  $average = $this->get_x_mean();
  
  $this->x_variance = 0;
  foreach( $this->x_dataset as $x_i )
	$this->x_variance += pow(($x_i - $average),2);
  
  $this->x_variance /= $this->x_size;
  $this->x_variance_prev_calculated = true;
  return $this->x_variance;  
 }
 
 

 public function get_y_variance()
 {
  if( $this->y_variance_prev_calculated )
     return $this->y_variance;
	
  $average = $this->get_y_mean();
  $this->y_variance = 0;
  foreach( $this->y_dataset as $y_i )
	$this->y_variance += pow(($y_i - $average),2);
  
  $this->y_variance /= $this->y_size;
  $this->y_variance_prev_calculated = true;
  return $this->y_variance; 
 } 
 
 
 public function get_xy_mean()
 {
  if( $this->xy_mean_prev_calculated )
		return $this->xy_mean;
		
   
  $xy_dataset = array_combine( $this->x_dataset, $this->y_dataset );
  $this->xy_mean = 0;
  foreach( $xy_dataset as $x_i=>$y_i )
    $this->xy_mean += ($x_i * $y_i);
  
  $this->xy_mean /= $this->x_size;
  
  $this->xy_mean_prev_calculated = true;
  return $this->xy_mean;
 
 }
 
 
 public function get_xy_covariance()
 {
  if( $this->xy_covariance_prev_calculated )
		return $this->xy_covariance;
		
  $this->xy_covariance = $this->get_xy_mean() - ($this->get_x_mean() * $this->get_y_mean());
  $this->xy_covariance_prev_calculated = true;
  return $this->xy_covariance;
 }
 
  
 public function get_x_stddev()
 {
   if( $this->x_stddev_prev_calculated )
		return $this->x_stddev;
	
    $this->x_stddev = sqrt( $this->get_x_variance() );
	$this->x_stddev_prev_calculated = true;
	
    return $this->x_stddev;
 }


 public function get_y_stddev()
 {
   if( $this->y_stddev_prev_calculated )
		return $this->y_stddev;
	
    $this->y_stddev = sqrt( $this->get_y_variance() );
	$this->y_stddev_prev_calculated = true;
	
    return $this->y_stddev;
 } 
  
  
 public function get_correlation_coefficient()
 {
  if( $this->correlation_coefficient_prev_calculated )
	return $this->correlation_coefficient;
	
  $this->correlation_coefficient = $this->get_xy_covariance() / $this->get_x_variance();
  $this->correlation_coefficient *= ($this->get_x_stddev() / $this->get_y_stddev());
  $this->correlation_coefficient_prev_calculated = true;
  return $this->correlation_coefficient_prev_calculated;
 }  
 
 
 
 public function get_intercept()
 {
	if( $this->intercept_prev_calculated )
		return $this->intercept;
		
	$this->intercept = $this->get_y_mean() - ($this->get_gradient() * $this->get_x_mean());
	$this->intercept_prev_calculated = true;
	return $this->intercept;
 }
 
 
 
 public function get_gradient()
 {
   if( $this->gradient_prev_calculated )
		return $this->gradient;
		
   $this->gradient = ($this->get_xy_covariance() / $this->get_x_variance());
   $this->gradient_prev_calculated = true;
   return $this->gradient;
 }
 
 
  
  
 private function reset()
 {

   //Set all *.prev_calculated variables to false
   $this->x_mean_prev_calculated = false; 
   $this->x_variance_prev_calculated = false; 
   $this->x_stddev_prev_calculated = false; 
   
   $this->y_mean_prev_calculated = false; 
   $this->y_variance_prev_calculated = false; 
   $this->y_stddev_prev_calculated = false; 
   
   $this->xy_covariance_prev_calculated = false; 
   $this->correlation_coefficient_prev_calculated = false; 
   
   
   $this->xy_mean_prev_calculated = false; 
   
   $this->intercept_prev_calculated = false;
   
   $this->gradient_prev_calculated = false;
 } 
  
  
  
  
 //VARIABLES 
 

  
 //Purpose of the *.prev_calcuated variables
 //Since this class is may be expected to operate
 //on large sets of data where some of the properties
 //than it *can* calculate may not be needed, and also
 //certain values may be requested more than once,
 //it does everything "lazily".
 
 //(i.e) It will calculate properties of the datasets upon
 //request. For the first request of a certain property,
 //its actual value with be calculated and its corresponding  
 //prev_calculated member will be set to true.
 //( They are initially set to false in the constructor )
 
 //For successive calculations, assuming the dataset hasn't been changed
 //(This is the only time the *.prev_calculated variables will be reset to false)
 //their values will have already been calculated and will just be returned 
 //without doing any redundant calculations. 

 //This should help to maximise performance for cases where the datasets are very large
 //There will however be overhead for small datasets.
 

 
 
 
 private $x_dataset;
 private $x_size;
  
 private $y_dataset;
 private $y_size;
 
 //The gradient of the line of best fit 
 //using the method of least squares. 
 private $gradient;
 private $gradient_prev_calculated;
 
 
 //The value of y( the depdendant variable )
 //when x = 0. (i.e) Where the line cuts the y-axis
 private $intercept; 
 private $intercept_prev_calculated;
 

 
  
 //X DATASET PROPERTIES
  
 //The average value of the members of
 //the controlled dataset. 
 private $x_mean;
 private $x_mean_prev_calculated;
 
 
 //Variance of the controlled dataset.
 private $x_variance;
 private $x_variance_prev_calculated;
 
 private $x_stddev;
 private $x_stddev_prev_calculated;
 
 //Y DATASET PROPERTIES
 
 //The average value of the members of
 //the dependant dataset.
 private $y_mean; 
 private $y_mean_prev_calculated;
 
 //Variance of the depdendant dataset.
 private $y_variance;
 private $y_variance_prev_calculated; 
 
 private $y_stddev;
 private $y_stddev_prev_calculated;
 
 
 //COMBINED PROPERTIES
 private $xy_mean;
 private $xy_mean_prev_calculated;
 
 private $xy_covariance;
 private $xy_covariance_prev_calculated;

 
 private $correlation_coefficient;
 private $correlation_coefficient_prev_calculated; //oh god...name way too long
  
}



?>