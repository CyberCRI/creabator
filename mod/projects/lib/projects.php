<?php
/**
 * projects helper functions
 *
 * @package projects
 */


/**
 * Prepare the add/edit form variables
 *
 * @param ElggObject $project A project object.
 * @return array
 */

function projects_prepare_form_vars($project = null) {
	// input names => defaults
	$values = array(
		'title' => get_input('title', ''), 
		'tagline' => get_input('tagline', ''),
		'briefdes' => get_input('briefdes', ''),		
		'plan' => get_input('plan', ''), 
		'videoid' => get_input('videoid', ''),
		'access_id' =>get_input('access_id', ''),
		'tags' => '',
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		'entity' => $project,
	);
		
	if ($project) {
		foreach (array_keys($values) as $field) {
			if (isset($project->$field)) {
				$values[$field] = $project->$field;
			}
		}
	}

	if (elgg_is_sticky_form('projects')) {
		$sticky_values = elgg_get_sticky_values('projects');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('projects');

	return $values;
}




//remain_days for the project to launch
function remain_days($project){
    
    
    $days=30;
    // only start when the user choese to get money
    $time=$project->start_time;
    $diff = time() - (int)$time;
    $day =86400;
    return $days-floor($diff/$day);
    
}

// freeze the project when the day less than 0
function freeze_project($project){
    $fund_exit=$project->fund_exit;
    $fund_num=$project->fund_num;
    $m_bp_total = $project->getAnnotationsSum('m_state');
    $m_proccess=number_format((($fund_exit+$m_bp_total)/$fund_num)*100);
    
    $remain_days=remain_days($project);
    if ($remain_days<0 && $m_proccess<100){
    //  frozen:3,
        $project->get_money = 3;
        return TRUE;
         
    }else{
        return false;
    }
    
}


// refresh project 
function refresh_project($project){
    if (isadminloggedin()){
        $project->refresh_time=time();
        //refresh:4
        $project->get_money = 4;
        if ($project->save()){
        system_message('Refresh Success!');
        }else{
            register_error('Refress Failed.');
        }
    }
    
}


/* Get related objects base on the tags
 * $guid the guid of the object
 * $vars array();
 */
function related_objects_base_on_tags($guid,$limit,$vars = array()){
	
	// set the random related tags
	$object_tags=elgg_get_metadata(array('guids'=>$guid,'metastring_names'=>'tags'));
	if ($object_tags) {
	
		foreach ($object_tags as $tag)
		{
			$tag_list[] .=$tag->value_id;
	
		}
		$random_tag_id = $tag_list[ mt_rand(0, count($tag_list) - 1) ];
	
		$ramtag=get_metastring($random_tag_id);
	    $object=get_entity($guid);
	    $type=$object->getType();
	    $subtype=$object->getSubtype();
	    $defaults=array(
	    
	    		'full_view'=>false,
	    		'pagination'=>false,
	    );
	    $vars = array_merge($defaults, $vars);
	    $limit=$limit+1;
		$sametag_objects=elgg_get_entities_from_metadata(array(
				'metadata_names' => 'tags',
				'metadata_values' => $ramtag,
				'type' => $type,
				'subtype'=>$subtype,
				'limit'=>$limit
				));

		// delete the same object form related object result
		foreach ($sametag_objects as $stp){
	
			$stpguids[] .=$stp->getGUID();
	
		}
		$srlt=array_search("$guid",$stpguids);
		array_splice($sametag_objects,$srlt,1);	
		
		 return  elgg_view_entity_list($sametag_objects,$vars);
		
	}
}

function Undone_contribute($guid,$name){

	$tasks=elgg_get_annotations(array(
			'type'=>'object',
			'subtype'=>'projects',
			'guid'=>$guid,
			'annotation_name'=>"{$name}",
			'limit'=>0
	));
	if(!$tasks){
		return false;
	}

	$project=get_entity($guid);
	$at_ids=array();
	foreach ($tasks as $task){
		$id=$task->id;
		$done=$project->$id;

		if($done!=1){
			$at_ids[].=$id;

		}
	}
	if(!$at_ids){
		return false ;
	}
	$undone_tasks=elgg_get_annotations(array(
			'type'=>'object',
			'subtype'=>'projects',
			'annotation_name'=>"{$name}",
			'annotation_ids'=>$at_ids,
			'limit'=>0
	));
	return $undone_tasks;
}

// function for the youtube api

$clientLibraryPath = '/home/wiseru/public_html/creabator.org/Zend/library/';
$oldPath = set_include_path(get_include_path() . PATH_SEPARATOR . $clientLibraryPath);
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata_YouTube');
Zend_Loader::loadClass('Zend_Gdata_AuthSub');
Zend_Loader::loadClass('Zend_Gdata_App_Exception');
session_start();
setLogging('on');
generateUrlInformation();
$_SESSION['developerKey'] = 'AI39si6kRKUia9pIa5shfm9ANGiq6H9vZw0rIcHnsyaGkShgmpgRYw47cH8UyhlCZ2bgwu2jjJi_4PunBTJG8OJ2RMr8MPrIcQ';
$_SESSION['sessionToken']='1/eBwlQ9TsrJ5mQ-BZTmE3NGa-ATGMSeyB3UykRm7yAIk';
function setLogging($loggingOption, $maxLogItems = 10)
{
    switch ($loggingOption) {
        case 'on' :
            $_SESSION['logging'] = 'on';
            $_SESSION['log_currentCounter'] = 0;
            $_SESSION['log_maxLogEntries'] = $maxLogItems;
            break;

        case 'off':
            $_SESSION['logging'] = 'off';
            break;
    }
}
function generateUrlInformation()
{
    if (!isset($_SESSION['operationsUrl']) || !isset($_SESSION['homeUrl'])) {
        $_SESSION['operationsUrl'] = 'http://'. $_SERVER['HTTP_HOST']
                                   . $_SERVER['PHP_SELF'];
        $path = explode('/', $_SERVER['PHP_SELF']);
        $path[count($path)-1] = 'index.php';
        $_SESSION['homeUrl'] = 'http://'. $_SERVER['HTTP_HOST']
                             . implode('/', $path);
    }
}
function loggingEnabled()
{
    if ($_SESSION['logging'] == 'on') {
        return true;
    }
}
function logMessage($message, $messageType)
{
    if (!isset($_SESSION['log_maxLogEntries'])) {
        $_SESSION['log_maxLogEntries'] = 20;
    }

    if (!isset($_SESSION['log_currentCounter'])) {
        $_SESSION['log_currentCounter'] = 0;
    }

    $currentCounter = $_SESSION['log_currentCounter'];
    $currentCounter++;

    if ($currentCounter > $_SESSION['log_maxLogEntries']) {
        $_SESSION['log_currentCounter'] = 0;
    }

    $logLocation = 'log_entry_'. $currentCounter . '_' . $messageType;
    $_SESSION[$logLocation] = $message;
    $_SESSION['log_currentCounter'] = $currentCounter;
}
function getAuthSubHttpClient()
{
    try {
        $httpClient = Zend_Gdata_AuthSub::getHttpClient($_SESSION['sessionToken']);
    } catch (Zend_Gdata_App_Exception $e) {
        print 'ERROR - Could not obtain authenticated Http client object. '
            . $e->getMessage();
        return;
    }
    $httpClient->setHeaders('X-GData-Key', 'key='. $_SESSION['developerKey']);
    return $httpClient;
}
function echoVideoPlayer($videoId)
		{
    $youTubeService = new Zend_Gdata_YouTube();

    try {
        $entry = $youTubeService->getVideoEntry($videoId);
    } catch (Zend_Gdata_App_HttpException $httpException) {
        print 'ERROR ' . $httpException->getMessage()
            . ' HTTP details<br /><textarea cols="100" rows="20">'
            . $httpException->getRawResponseBody()
            . '</textarea><br />'
            . '<a href="session_details.php">'
            . 'click here to view details of last request</a><br />';
        return;
    }

    $videoUrl = htmlspecialchars(findFlashUrl($entry));


    echo <<<HTML


        <param name="movie" value="${videoUrl}&autoplay=1"></param>
        <param name="wmode" value="transparent"></param>
        <embed src="${videoUrl}&autoplay=1" type="application/x-shockwave-flash" wmode="transparent"
        width="425" height="350"></embed>

HTML;

}

function createUploadForm($videoTitle, $videoDescription, $videoCategory, $videoTags, $nextUrl = null)
{
    $httpClient = getAuthSubHttpClient();
    $youTubeService = new Zend_Gdata_YouTube($httpClient);
    $newVideoEntry = new Zend_Gdata_YouTube_VideoEntry();

    $newVideoEntry->setVideoTitle($videoTitle);
    $newVideoEntry->setVideoDescription($videoDescription);

    //make sure first character in category is capitalized
    $videoCategory = strtoupper(substr($videoCategory, 0, 1))
        . substr($videoCategory, 1);
    $newVideoEntry->setVideoCategory($videoCategory);

    // convert videoTags from whitespace separated into comma separated
    $videoTagsArray = explode(' ', trim($videoTags));
    $newVideoEntry->setVideoTags(implode(', ', $videoTagsArray));

    $tokenHandlerUrl = 'http://gdata.youtube.com/action/GetUploadToken';
    try {
        $tokenArray = $youTubeService->getFormUploadToken($newVideoEntry, $tokenHandlerUrl);
        if (loggingEnabled()) {
            logMessage($httpClient->getLastRequest(), 'request');
            logMessage($httpClient->getLastResponse()->getBody(), 'response');
        }
    } catch (Zend_Gdata_App_HttpException $httpException) {
        print 'ERROR ' . $httpException->getMessage()
            . ' HTTP details<br /><textarea cols="100" rows="20">'
            . $httpException->getRawResponseBody()
            . '</textarea><br />'
            . '<a href="session_details.php">'
            . 'click here to view details of last request</a><br />';
        return;
    } catch (Zend_Gdata_App_Exception $e) {
        print 'ERROR - Could not retrieve token for syndicated upload. '
            . $e->getMessage()
            . '<br /><a href="session_details.php">'
            . 'click here to view details of last request</a><br />';
        return;
    }

    $tokenValue = $tokenArray['token'];
    $postUrl = $tokenArray['url'];

    // place to redirect user after upload
    if (!$nextUrl) {
        $nextUrl = $_SESSION['homeUrl'];
    }

    print <<< END
        <br /><form action="${postUrl}?nexturl=${nextUrl}"
        method="post" enctype="multipart/form-data">
        <input style="width:400px" name="file" type="file"/>
        <input  name="token" type="hidden" value="${tokenValue}"/>
        <input style="width:200px" value="Upload Video File" type="submit" />
        </form>
END;
}