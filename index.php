<?php
function url_origin( $s, $use_forwarded_host = false )
{
    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $s['SERVER_PORT'];
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

function full_url( $s, $use_forwarded_host = false )
{
    return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}

$absolute_url = full_url( $_SERVER );


$classmonth = date('m');
$classyear  = date('y');
$Jan    = '01';
$May    = '05';
$Aug    = '08';
$Dec    = '12';

// echo '<pre>';
// echo $absolute_url . '<br/>';
// echo $classmonth . '<br/>';
// echo $classyear . '<br/>';

// echo 'Spring==>' . ($classmonth >= $Jan && $classmonth <= $May) . '<br/>';
// echo 'Fall==>' . ($classmonth >= $Aug && $classmonth <= $Dec) . '<br/>';
$semester = "F" . $classyear . '/iit';   // default to fall
if ($classmonth >= $Jan && $classmonth <= $May) {
   // echo 'Spring<br/>';
   $semester = "S" . $classyear . '/iit';
   // echo $absolute_url.$semester . '<br/>';
} 
// if ($classmonth >= $Aug && $classmonth <= $Dec) {
//    // echo 'Fall<br/>';
//    $semester = "F" . $classyear;
//    // echo $absolute_url.$semester . '<br/>';
// }

// echo '</pre>';

// update for consistent use with Github - letting github track the changes
// chage the semester to the repofolder
$semester='introRepo';

header('Location: '.$absolute_url.$semester);
?>