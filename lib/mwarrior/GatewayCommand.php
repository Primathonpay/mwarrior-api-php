<?php
namespace mwarrior;

class GatewayCommand {

    public static function submit($url, $postData) {
        $process = curl_init();

        curl_setopt($process, CURLOPT_HEADER, false);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($process, CURLOPT_URL, $url);
        curl_setopt($process, CURLOPT_POST, true);
        curl_setopt($process, CURLOPT_POSTFIELDS, http_build_query($postData, '', '&'));

        $response['data'] = curl_exec($process);
        $response['err'] = curl_error($process);

        curl_close($process);

        if ($response === false) {
          throw new \Exception("cURL error " . $response['err']);
        }

        Logger::getInstance()->write("Response" . $response['data'], Logger::DEBUG, get_class() );
        return $response;
    }
}
?>
