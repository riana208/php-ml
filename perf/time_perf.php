

<?php $UWI_ML_PERF_PHP_MICROTIME_0_BEGIN = microtime(); ?>

<?php

$start = microtime(true);
$end = microtime(true);

$duration = $end-$start;
echo "duration: $duration\n\n";

?>

<?php $UWI_ML_PERF_PHP_MICROTIME_0_END = microtime(); ?>



<?php $UWI_ML_PERF_PHP_FILE=fopen("uwi_ml_perf_php_log.txt","w"); ?>



<?php fprintf($UWI_ML_PERF_PHP_FILE,"TEST START"); ?>



<?php fprintf($UWI_ML_PERF_PHP_FILE,"TEST END"); ?>



<?php fclose($UWI_ML_PERF_PHP_FILE); ?>

