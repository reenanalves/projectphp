<?php

class HttpRequest{
    public static function request($url, $method = 'POST', $params = null, $headers = null)
    {
        $ch = curl_init();

        if ($headers != null) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        if ($params !== null) {            
            if ($method == 'POST' or $method == 'PUT') {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
                curl_setopt($ch, CURLOPT_POST, true);
            } else if ($method == 'GET' or $method == 'DELETE') {
                $url .= '?' . http_build_query($params);
            }
        }

        $defaults = array(
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_HEADER => 1
        );

        curl_setopt_array($ch, $defaults);
        $output = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($output, 0, $header_size);
        $body = substr($output, $header_size);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        $header = str_replace("\r", "", $header);
        $header = explode("\n", $header);
        $headertemp = $header;
        $headertemp2 = array();

        //Organiza o ResponseHeader em um array
        foreach ($headertemp as $key => $value) {
            $headertempline = explode(": ", $headertemp[$key]);
            $headertemp2[$key] = $headertempline['0'];

            if (strpos($value, ": ") <> false) {
                unset($headertemp2[$key]);
                $headertemp2[$headertempline['0']] = $headertempline['1'];
                $header = $headertemp2;
            }
        };

        $response =
            [
                "Body" => json_decode($body),
                "Header" => $header,
                "Code" => $httpcode
            ];


        return $response;
    }
}