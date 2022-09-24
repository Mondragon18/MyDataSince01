<?php

    namespace App\Libraries\ApiMercadoLibre;

    class ConnectionPais {

        protected $client;
        protected $token;
        protected $haeders;
    
        public function __construct()
        {
            $this->client = \Config\Services::curlrequest([
                'baseURI' => 'https://api.mercadolibre.com',
            ]);
            $this->token = "Bearer APP_USR-4332857485021545-092112-923d6e4b439a5a93c209a294d99beea1-833930674";
            $this->haeders = [
                'Accept'        => 'application/json',
                'Authorization' => $this->token,
                'Content-Type' => 'application/json',
            ];
        }

        public function getPaises(){
            $url = "sites";
            $datos['paises'] = json_decode($this->client->get($url)->getBody());
            return $datos['paises'];
        }

        public function getPais($id){
            $url = 'sites/' . $id;
            $datos['item'] = json_decode($this->client->get($url, ['haeders' => $this->haeders])->getBody());
            return $datos['item'];
        }

    }