<?php

/*
	* This is Dominotron.
	* If you can read this in your web browser, your web server is probably not
	* configured to correctly use PHP scripts.
	* If you are not the systems adminisistrator of the server,
	* contact your systems adminisistrator and describe the error.
	* Please be nice to them, they are probably having a bad day
	* if not even PHP is working. (And PHP ALWAYS works. Even on Mondays.)
	* If you are the systems administrator,
	* or otherwise can install PHP 7,
	* install PHP 7. See instructions
	* for how to install at php.net.
*/



define('DPTYPE',"index")
// We are going to dirname( __FILE__ ) here because __DIR__ is only in PHP5.3+.
// Yes. dirname(__FILE__) is a verb.
require dirname(__FILE__).'/domicode/Include'; // We need to find the master include file.

dCheckEntry(__FILE__); // We need to check if this is a webpage.

require dirname(__FILE__).'/domicode/beginWeb'; // We need to begin the webpage.
require __DIR__.'/domicode/includes/Header';
require __DIR__.'/domicode/includes/Sidebar';



$queryGetThreads = $conn->query('SELECT * FROM dThreads');
$rowGetThreads = $queryGetThreads->fetch_array();
$countGetThreads = $queryGetThreads->num_rows;
if($countGetThreads>0){
	while($rowGetThreads=$queryGetThreads->fetch_array(MYSQLI_BOTH)){
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
