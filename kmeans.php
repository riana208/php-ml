
<?php


/*
There are n observations.  X = { x_1,...,x_n }
Each observation is a d-dimensional vector.

The k-means algorithm attempts to partition these N observations
into k sets, S = {s_1,...,s_k}, k<=n, or clusters such that the 
clusters' means, m_i where 1<=i<=k, on the whole,
provide the smallest total sum-of-squares.

1) A value for k must be chosen
2) Some method must be used to get k different means to start the partitioning process.
	a) The Forgy Method
	
		The Forgy method randomly chooses k obersavtions from the n oberservations
		and uses these as the means for the partitioning process.

3) Assignment step: Assign each observation to the cluster with the closest mean.
					Since  each observation is not necessarily one dimensional
					and not necessarily an integer, some distance function, d(x,m)
					where x is the observation and m is the mean of a cluster,
					must be defined.

4) For each cluster created by the assignment step, a new mean must be found.
	the new mean is found by the sum of the observations in the cluster divided by 
	the number of items in the cluster. Since the observations in the cluster may have
	more than one dimension and they may not all necessarily be integers, it should
	be possible for the user to sepcify a sum function for the integers.

The algorithm should terminate when the clusters generated by the assignment step
are identical to the clusters before the assignment step was reached. If the clusters aren't
identical, the new means should be found and the algorithm should return to the assignment
step.
*/



class KMeansClustering
{


	function __construct()
	{
		$this->observations_changed = true;
	}

	

	//function setClusterCount
	//Description: used to set how many clusters the observations should be paritioned into.
	//The cluster_count should be an integer, and it should be less than the number of
	//observations ( you can't group m items into n groups, where n > m )
	public function setClusterCount( $cluster_count )
	{
		if( !is_int($cluster_count) || ($cluster_count > $this->observations) ) 
			return false;
		$this->k = $cluster_count;
		return true;
	}


	//function setDistanceFunction
	//Description: used to set the distance function which operates
	//on the observations during the assignment step. More specifically,
	//it's used to find the difference between the observation in question
	//and the mean of a particular cluster.
	public function setDistanceFunction( $distance_func_name )
	{
		if( !function_exists($distance_func_name) ) return false;
		$this->distance_func = $distance_func_name;
		return true;
	}



	//function setSumFunction
	//Description: used to set the sum function which operates
	//on the observations during the process where the new means
	//are found.
	public function setSumFunction( $sum_func_name )
	{
		if( !function_exists($sum_func_name) ) return false;
		$this->sum_func = $sum_func_name;
		return true;
	}



	//function setObservations
	//Description: used to set the observations that will be clustered.
	//It's the caller's responsibility to ensure that the $observations array is uniform.
	public function setObservations( array $observations )
	{
		if( !count($observations) ) return false;
		$this->observations = array_values( $observations );
		$this->observations_changed = true;
		return true;
	}


	//function addObservations
	//Description: used to add observations to the previous array of observations.
	public function addObservations(  array $new_observations )
	{
		if( !count($observations) ) return false;
		if( !isset( $this->observations ) ) $this->setObservations( $new_observations );
		$merged_array = array_merge( $this->observations, $new_observations );
		$this->setObservations( $merged_array );	
		return true;
	}

	


	//function Forgy
	//Description: used for randomly selecting k observations to be used as means.
	//Note: There is no need to seed the random number generator, this is done
	//automatically in php as of version 4.2.0.
	private function Forgy()
	{
		if( !isset($this->oberservations)  ||
		    !is_array($this->observations) ||
		    !isset($this->k) 
		  )
		   return false;

		//So after I write like 10 lines of code to find k distinct valid
		//array indexes, I read about array_rand..

		$random_indexes = array_rand( $this->observations, $this->k );

		$this->k_means = array();

		//Set initial k-means
		foreach( $random_indexes as $index )
			$this->k_means[] = $this->observations[ $index ];
		
		retrun true;
	}



	private $observations_changed; //If set to true then the values should be recalculated

	private $distance_func; //function for finding the distance or difference between two observations
	private $sum_func;	//function for finding the sum of two observations

	private $observations; //a number of d-dimensional observations, guaranteed to have integer indexes
	private $k; //number of clusters
	private $k_means; //k mean values used in the assignment step
	private $k_clusters; //k clusters of d-dimensional objects

}


 ?>