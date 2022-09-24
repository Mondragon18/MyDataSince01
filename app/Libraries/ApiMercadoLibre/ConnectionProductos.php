<?php

    namespace App\Libraries\ApiMercadoLibre;

    class ConnectionProductos {

        protected $client;
        protected $token;
        protected $haeders;

        public function __construct()
        {
            $this->client = \Config\Services::curlrequest([
                'baseURI' => 'https://api.mercadolibre.com',
            ]);
            $this->token = "Bearer APP_USR-4332857485021545-092208-258500a1137fd25d288550de96ccdbc5-833930674";
            $this->haeders = [
                'Accept'        => 'application/json',
                'Authorization' => $this->token,
                'Content-Type' => 'application/json',
            ];
        }


        public function setItem($datos){
            $url = 'items';
            $item = json_decode($this->client->post($url, ['json' => $datos, 'headers' => $this->haeders, 'http_errors' => false])->getBody());
            return $item;
        }
    }