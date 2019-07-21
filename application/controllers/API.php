<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class API extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
    }
       
    
    // Api endpoint to recieve webhooks from azure devops
    function test_post() {

    $object = file_get_contents('php://input');
    $data = json_decode($object);
    $event = $data->eventType;
   
    $url = 'webhook url from hangout chat room';
    $headers = array ('Content-Type: application/json; charset=UTF-8');
    $json = new stdClass(); 
    if($event == 'build.complete'){
      $json->text = '*Build Completed* with Message:- ```'.$data->message->text.'```';
    }
    else if($event == 'ms.vss-release.deployment-started-event'){
      $json->text = '*Deployment Started* with Message:- ```'.$data->message->text.'```';
    } else if($event == 'ms.vss-release.deployment-completed-event'){
      $json->text = '*Deployment Completed* with Message:- ```'.$data->detailedMessage->text.'```';
    }

    $result = json_encode($json);
    $this->response($json, 200);  
   
    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POST, true );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $result );

    $response = curl_exec ( $ch );
  

  }


  function testcards_post() {

    $object = file_get_contents('php://input');
    $data = json_decode($object);
    $event = $data->eventType;
   
    $url = 'webhook url from hangout chat room';
    $headers = array ('Content-Type: application/json; charset=UTF-8');
    $json = new stdClass(); 
  
    if($event == 'build.complete'){
      $datetime1 = new DateTime($data->resource->startTime);
      $datetime2 = new DateTime($data->resource->finishTime);
      $time = $this->timeDiff($datetime1,$datetime2);
      $text = 'Build Completed';
      $card["cards"]["sections"]["widgets"]["textParagraph"]["text"]="".$data->detailedMessage->text ."\n<b>Time taken </b>- ".$time."";
    }
    else if($event == 'ms.vss-release.deployment-started-event'){
      $text = 'Deployment Started';
    } else if($event == 'ms.vss-release.deployment-completed-event'){
      $text = 'Deployment Completed';
      $card["cards"]["sections"]["widgets"]["buttons"]["textButton"]["text"]="Visit Website";
      $card["cards"]["sections"]["widgets"]["buttons"]["textButton"]["onClick"]["openLink"]["url"]="website url";
    }

    $card["cards"]["header"]["title"] = $text;
    $card["cards"]["header"]["imageUrl"] = "url of website image";
    $card["cards"]["header"]["imageStyle"]= "IMAGE";
    //$card["cards"]["sections"]["widgets"]["textParagraph"]["text"]='</b>'.$data->detailedMessage->text.'</b>';
    $result = json_encode($card);
    $this->response($json, 200);  
   
    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POST, true );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $result );

    $response = curl_exec ( $ch );
  

  }


  function splitexpress_post() {

    $object = file_get_contents('php://input');
    $data = json_decode($object);
    $event = $data->eventType;
    
    $url = 'webhook url from hangout chat room';
    $headers = array ('Content-Type: application/json; charset=UTF-8');
    $json = new stdClass(); 
  
    if($event == 'build.complete'){
      $datetime1 = new DateTime($data->resource->startTime);
      $datetime2 = new DateTime($data->resource->finishTime);
      $time = $this->timeDiff($datetime1,$datetime2);
      $text = 'Build Completed';
      $card["cards"]["sections"]["widgets"]["textParagraph"]["text"]="".$data->detailedMessage->text ."\n<b>Time taken </b>- ".$time."";
    }
    else if($event == 'ms.vss-release.deployment-started-event'){
      $text = 'Deployment Started';
      $card["cards"]["sections"]["widgets"]["textParagraph"]["text"]='</b>'.$data->detailedMessage->text.'</b>';
    } else if($event == 'ms.vss-release.deployment-completed-event'){
      $text = 'Deployment Completed';
      $card["cards"]["sections"]["widgets"]["buttons"]["textButton"]["text"]="Visit Website";
      $card["cards"]["sections"]["widgets"]["buttons"]["textButton"]["onClick"]["openLink"]["url"]="web site uel";
      $card["cards"]["sections"]["widgets"]["textParagraph"]["text"]='</b>'.$data->detailedMessage->text.'</b>';
    }

    $card["cards"]["header"]["title"] = $text;
    $card["cards"]["header"]["imageUrl"] = "website logo image ";
    $card["cards"]["header"]["imageStyle"]= "IMAGE";
    $result = json_encode($card);
    
   
    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POST, true );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $result );

    $response = curl_exec ( $ch );
    $this->response($response, 200);  
  

  }


  // Calculate time difference between build start and end time
  function timeDiff($firstTime,$lastTime)
  {

    $interval = $firstTime->diff($lastTime);
    $elapsed = $interval->format('%i minutes %s seconds');

    // return the difference
    return $elapsed;
  }

  
  
 
  
  
  
  
  
  
  
  

      
  
   
    	
}
