<?php

/*
	* This is Dominotron.
	* If you can read this in your web browser, your web server is probably not
	* configured to correctly use PHP scripts.
	* If you are not the systems adminisistrator of the server,
	* contact your systems adminisistrator.
	* If you are, or otherwise can install PHP 7, install PHP 7.
*/

//require dirname( __FILE__ ) . '/*/Include'; // We need to find the master include file.

set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] );

$dpType = "index";
// We are going to dirname( __FILE__ ) here because __DIR__ is only in PHP5.3+.
// Yes. dirname(__FILE__) is a verb.
require dirname(__FILE__).'/domicode/Include'; // We need to find the master include file.

dCheckEntry(__FILE__); // We need to check if this is a webpage.

require dirname(__FILE__).'/domicode/beginWeb'; // We need to begin the webpage.
include __DIR__.'/domicode/includes/Header';
include __DIR__.'/domicode/includes/Sidebar';

// TODO: Change the IF to something different, maybe?
/*if(isset($dpType) && $dpType === "index"){
	$queryGetThreads = $conn->query("SELECT thread_id, thread_id2, thread_subject, thread_date, thread_realm, thread_by, thread_flair, thread_flair_id FROM dThreads");
	$rowGetThreads=$queryGetThreads->fetch_array();
	$countGetThreads = $queryGetThreads->num_rows; // if email/password are correct returns must be 1 row
	if($countGetThreads===1){
		echo 'yes';
	}
}*/


$queryGetThreads = $conn->query('SELECT * FROM dThreads');
$rowGetThreads = $queryGetThreads->fetch_array();
$countGetThreads = $queryGetThreads->num_rows;
if($countGetThreads>1){
	while($rowGetThreads=$queryGetThreads->fetch_array(MYSQLI_BOTH)){
		//$tcRow['comment_by'] = $cmtCA['u_name'];
		$buildThreads = $rowGetThreads;
		if(isset($dUserWorking)){
			$buildThreads['u_lvl'] = $u_lvl;
			$buildThreads['u_id'] = $u_id;
			$buildThreads['u_id2'] = $u_id2;
			$buildThreads['u_sfun'] = $u_sfun;
			$buildThreads['u_name'] = $u_name;
			$buildThreads['u_pw'] = $u_pw;
		}
		echo buildThread($buildThreads);
	}
}else{
	echo 'Nothing is here.';
}


require __DIR__.'/domicode/includes/Footer';
// And we're off.
