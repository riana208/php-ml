<?



function generate_candidates( $L, $k )
{
 
 	$candidates = array();
  	$num_items_to_match = $k-2;
    
    $array_size = count($L[$k-1]);
  	for( $i = 0; $i < $array_size; ++$i )
  	{
  		$temp_array1 = $L[$k-1][$i];
  		$slice1 = array_slice( $temp_array1, 0, $num_items_to_match);
  		for( $j = $i+1; $j < $array_size; ++$j )
  		{
  		  $temp_array2 = $L[$k-1][$j];
  		  $slice2 = array_slice( $temp_array2, 0, $num_items_to_match );
  		  if( $slice1 == $slice2 )
  		  	{
  		  		$temp_array1[$k-1] = $temp_array2[$k-2];
  		  	    $candidates[] = $temp_array1;
  		  	}	
  		}
  	}

  	return $candidates;
}




function get_valid_candidates( array $transactions, array $candidates, $minimum_support )
{
	$valid_candidates = array();

	foreach( $candidates as $candidate )
	{
	   $count = 0;
	   foreach( $transactions as $transaction )
	   {

	   	 if(  count(array_intersect($candidate,$transaction)) == count($candidate)   ) 
	   	 	{
	   	 		++$count;
	   	 		if( $count >= $minimum_support ) 
	   	 			{
	   	 				$valid_candidates[] = $candidate;
	   	 				break;
	   	 			}
	   	 	}
	   }
	}
	return $valid_candidates;
}




function apriori( array $transactions, $minimum_support )
{

  $L = array();
  $k = 1;
  $temp_array = array();

  $L[$k] = array();

  $universal_set = array();
  foreach( $transactions as $transaction ) 
  	$universal_set = array_merge( $universal_set, $transaction );

  $universal_set = array_values( array_unique( $universal_set ) );
  
  $candidates = array();

  foreach( $universal_set as $element )
  	$candidates[] = array($element);
  
  $L[$k++] = get_valid_candidates( $transactions, $candidates, $minimum_support );

  while( count($L[$k-1]) != 0 )
  {
  	 $candidates  = generate_candidates( $L, $k );
     $L[$k] = get_valid_candidates( $transactions, $candidates, $minimum_support );
  	 ++$k;
  }

 unset( $L[$k-1] );

 return $L;
}


/*
$transactions = array( array(1,2,3), array(7,7,1), array(2,4,5,3), array(7,6,1,2), array(8,4,9,1) );
$minimum_support = 2;

$frequent_combinations = apriori( $transactions, $minimum_support );

print_r( $frequent_combinations );
*/

?>