<?php


include("./LinearRegression.php");


$test = new LinearRegression();

$x_dataset = array(60, 61, 62, 63, 65);
$y_dataset = array(3.1, 3.6, 3.8, 4.0, 4.1);

$test->set_data( $x_dataset, $y_dataset );

echo "Mean of x: ".$test->get_x_mean()."\n";
echo "Mean of y: ".$test->get_y_mean()."\n";

echo "Variance of X: ".$test->get_x_variance()."\n";
echo "Variance of Y: ".$test->get_y_variance()."\n";

echo "XY mean: ".$test->get_xy_mean()."\n";
echo "XY covariance: ".$test->get_xy_covariance()."\n";

echo "Gradient: ".$test->get_gradient()."\n";
echo "Intercept: ".$test->get_intercept()."\n";
echo "Coefficient: ".$test->get_correlation_coefficient()."\n\n";



?>