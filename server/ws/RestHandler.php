<?php

class RestHandler {
    private $httpVersion = "HTTP/1.1";
    
    private $httpStatuses = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',  
        400 => 'Bad Request',  
        401 => 'Unauthorized',  
        402 => 'Payment Required',  
        403 => 'Forbidden',  
        404 => 'Not Found',  
        405 => 'Method Not Allowed',  
        406 => 'Not Acceptable',  
        407 => 'Proxy Authentication Required',  
        408 => 'Request Timeout',  
        409 => 'Conflict',  
        410 => 'Gone',  
        411 => 'Length Required',  
        412 => 'Precondition Failed',  
        413 => 'Request Entity Too Large',  
        414 => 'Request-URI Too Long',  
        415 => 'Unsupported Media Type',  
        416 => 'Requested Range Not Satisfiable',  
        417 => 'Expectation Failed',  
        500 => 'Internal Server Error',  
        501 => 'Not Implemented',  
        502 => 'Bad Gateway',  
        503 => 'Service Unavailable',  
        504 => 'Gateway Timeout',  
        505 => 'HTTP Version Not Supported'
    ];
    
    private function setHttpHeaders($contentType, $statusCode) {
        $statusMessage = $this->getHttpStatusMessage($statusCode);
        header($this->httpVersion . " " . $statusCode . " " . $statusMessage);
        header("Content-Type:" . $contentType);
    }
    
    private function getHttpStatusMessage($statusCode) {
        return $this->httpStatuses[$statusCode] ? $this->httpStatuses[$statusCode] : $this->httpStatuses[500];
    }
    
    private function encodeJson($data) {
        $jsonResponse = json_encode($data);
        return $jsonResponse;
    }
    
    private function decodeJson($data) {
        $rawData = json_decode($data);
        return $rawData;
    }
    
    private function encodeHtml($data) {
        $htmlResponse = "<table border='5'>";
        $this->array2html($htmlResponse, $data);
        $htmlResponse .= "</table>";
        return $htmlResponse;
    }
    
    private function decodeHtml($data) {
        // Not implemented
    }
    
    
    private function encodeXml($data) {
        $xmlResponse = new SimpleXMLElement('<root/>');
        $this->array2xml($xmlResponse, $data);
        return $xmlResponse->asXML();
    }
    
    private function decodeXml($data) {
        // Not implemented
    }
    
    private function array2xml($obj, $arr) {
        foreach ($arr as $key=>$value) {
            if (is_numeric($key)) {
                $key = 'item' . $key;
            }
            if (is_array($value)) {
                $node = $obj->addChild($key);
                $this->array2xml($node, $value);
            } else {
                $obj->addChild($key, htmlspecialchars($value));
            }
        }
    }
    
    private function array2html(&$obj, $arr) {
        foreach ($arr as $key=>$value) {
            if (is_numeric($key)) {
                $key = 'item' . $key;
            }
            if (is_array($value)) {
                $obj .= "<tr><td>$key</td>";
                $obj .= "<td><table border='2'>";
                $this->array2html($obj, $value);
                $obj .= "</table></td></tr>";
            } else {
                $obj .= "<tr><td>" . $key . "</td><td>" . htmlspecialchars($value) . "</td></tr>";
            }
        }
    }
    
    public function packData($requestContentType, $data) {
        if (empty($data)) {
            $statusCode = 404;
            $data = ['error' => "No data found"];
        } else {
            $statusCode = 200;
        }
        
        $this->setHttpHeaders($requestContentType, $statusCode);
        
        $response = "";
        if (strpos($requestContentType, 'application/json') !== false) {
            $response = $this->encodeJson($data);
        } else if (strpos($requestContentType, 'text/html') !== false) {
            $response = $this->encodeHtml($data);
        } else if(strpos($requestContentType, 'application/xml') !== false) {
            $response = $this->encodeXml($data);
        }
        return $response;
    }
    
    public function unpackData($requestContentType, $data) {
        if (strpos($requestContentType, 'application/json') !== false) {
            $request = $this->decodeJson($data);
        } else if (strpos($requestContentType, 'text/html') !== false) {
            $request = $this->decodeHtml($data);
        } else if(strpos($requestContentType, 'application/xml') !== false) {
            $request = $this->decodeXml($data);
        }
        return $request;
    }
}
