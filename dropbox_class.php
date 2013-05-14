<?php
class authentication {
protected $oauth;
protected $oauth_consumer_key;
protected $oauth_token;
protected $signature_method;
protected $oauth_access_token_secret;
protected $consumer_secret;
protected $signature;
protected $url;
protected $header;

   function getConsumberKey($key) {
   $this->oauth_consumer_key = $key;
   return $this->oauth_consumer_key;
   }
   
   function getConsumberSecret($secret) {
   $this->consumer_secret = $secret;
   return $this->consumer_secret;
   }
   
   function getAuthMethod($method) {
   $this->signature_method = $method;
   return $this->signature_method;
   }
   
   function getUrl($url) {
   return $this->url = $url;
   }
   
   function getAuthToken($authtoken) {
   return $this->oauth_token = $authtoken;   
   }
   function getAuthTokenSecret($authsecret) {
   return $this->oauth_access_token_secret = $authsecret;
   }
        
    function buildSignature() {
    
        if ($this->signature_method == "PLAINTEXT") {
        $this->signature = rawurlencode($this->consumer_secret) ."&". rawurlencode($this->oauth_access_token_secret);
                }
        
    }
    
      function buildAuthheader() {
             $r = "Authorization: OAuth ";
             foreach ($this->oauth as $key=>$value) {
             $v[]="$key=\"".rawurlencode($value)."\"";
             }
             $r .= implode(",",$v);
             return $r;
   }
   
   function autharray() {    
            $this->oauth = array(
            'oauth_consumer_key' => $this->oauth_consumer_key,
            'oauth_nonce' => time(),
            'oauth_timestamp' => time(),
            'oauth_token' => $this->oauth_token,
            'oauth_signature_method' => $this->signature_method,
            'oauth_signature' => $this->signature
            );
           
           $this->header = array($this->buildAuthheader(), 'Expect:'); 
            return $this->header;
    }
    
	function authRequest() {
	  $options = array(CURLOPT_HTTPHEADER => $this->header,
                       CURLOPT_HEADER => false,
                      CURLOPT_URL => $this->url,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_SSL_VERIFYPEER => false,
					  CURLOPT_AUTOREFERER => 'http://www.yoursite.com'
					  					  );
	$result = curl_init();
    curl_setopt_array($result, $options);
    $json = curl_exec($result);									  
	return $json;
	}
	
	function upload($url,$fp,$imagesize) {
	$options = array( CURLOPT_HTTPHEADER => $this->header,
                      CURLOPT_HEADER => false,
                      CURLOPT_URL => $url,
					  CURLOPT_PUT => true,
					  CURLOPT_CUSTOMREQUEST => "PUT",	
                      CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_BINARYTRANSFER=>true,
					  CURLOPT_INFILE=>$fp,
					  CURLOPT_INFILESIZE=>$imagesize);
					  
					  $result = curl_init();
					  curl_setopt_array($result,$options);
					  $output = curl_exec($result);
					  return $output;
                     
	}


}




?>
