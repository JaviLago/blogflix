<?php

namespace App\Infrastructure\Repository;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Utils class
 */
class Utils 
{
    public function __construct()
    {
        $this->encoders = [new XmlEncoder(), new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($this->normalizers, $this->encoders);
    }

    /**
     * Get curl result
     *
     * @param [type] $url
     * @return void
     */
    public function curl( $url ){
        /*  cacert.pem file */
        $curl=curl_init();
        /*
        $cacert='c:/wwwroot/cacert.pem';
        if( parse_url( $url,PHP_URL_SCHEME )=='https' ){
            curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, true );
            curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, 2 );
            curl_setopt( $curl, CURLOPT_CAINFO, $cacert );
        }
        */
        curl_setopt( $curl, CURLOPT_URL,trim( $url ) );
        curl_setopt( $curl, CURLOPT_AUTOREFERER, true );
        curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt( $curl, CURLOPT_FAILONERROR, true );
        curl_setopt( $curl, CURLOPT_HEADER, false );
        curl_setopt( $curl, CURLINFO_HEADER_OUT, false );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36' );
        curl_setopt( $curl, CURLOPT_MAXREDIRS, 10 );
        curl_setopt( $curl, CURLOPT_ENCODING, '' );

        $res=(object)array(
            'response'  =>  curl_exec( $curl ),
            'info'      =>  (object)curl_getinfo( $curl ),
            'errors'    =>  curl_error( $curl )
        );
        curl_close( $curl );
        return $res;
    }
}
