<?php
namespace zorro909;

class HttpAPI
{

    private $ratelimitRemaining=30, $rateLimit, $ratelimitReset=0;
    
    function __construct()
    {}

    private $i = 0;
    
    function get($clientID, $url, $authenticationToken=null)
    {        
        $this->ratelimitRemaining--;
        if($this->ratelimitRemaining<0&&$this->ratelimitReset>time()){
            echo "Ratelimit ran out\nWaiting for " . ($this->ratelimitReset-time()+2) . "seconds\n";
            return null;
        }
        
        $curl = curl_init($url);
        $authentication = array(
            'Client-ID: ' . $clientID
        );
        if($authenticationToken!==null){
            $authentication[1] = "Authentication: Bearer " . $authenticationToken;
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $authentication);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = [];
        curl_setopt($curl, CURLOPT_HEADERFUNCTION,
            function($curl, $header) use (&$headers)
            {
                $len = strlen($header);
                $header = explode(':', $header, 2);
                if (count($header) < 2) // ignore invalid headers
                    return $len;
                    
                    $name = strtolower(trim($header[0]));
                    if (!array_key_exists($name, $headers))
                        $headers[$name] = [trim($header[1])];
                        else
                            $headers[$name][] = trim($header[1]);
                            
                            return $len;
        }
        );
        $data = curl_exec($curl);
        $json = json_decode($data);
        $this->ratelimitRemaining = $headers["ratelimit-remaining"][0];
        $this->rateLimit = $headers["ratelimit-limit"][0];
        $this->ratelimitReset = $headers["ratelimit-reset"][0];
        return $json;
    }
    
    function getRateLimitRemaining(){
        return $this->ratelimitRemaining;
    }
    
    function getRateLimitResetTime(){
        return $this->ratelimitReset;        
    }
    
    function waitForRateLimit(){
        if($this->getRateLimitRemaining()<=0&&time()-$this->getRateLimitResetTime()>0){
            sleep(time()-$this->getRateLimitResetTime());
        }
    }
}

?>