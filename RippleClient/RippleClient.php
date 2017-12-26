<?php

/*
 * This file is part of the Ripple PHP Client
 *
 * Developed by (c) Ocrend Software <info@ocrend.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ocrend\RippleClient;
use Ocrend\RippleClient\Exceptions\ApiError;

/**
 * Establece la conexion con el nodo de Ripple en el servidor de Ocrend
 * Provee de herramientas a la libreria para toda la comunicacion
 *
 * @author Brayan Narváez <princk093@gmail.com>
 */

class RippleClient {

    /**
     * Direccion del nodo de conexion
     * 
     * @var string
     */
    const serverApiNode = 'https://ripple.ocrend.com/';

    /**
     * Ruta de certificado de seguridad
     * 
     * @var string
    */
    const sslRoute = '/ssl/ca-bundle.crt';

    /**
     * API KEY de Ocrend
     * 
     * @var string
     */
    private $ocrendAuth;

    /**
     * Conexion persistente
     * 
     * @var curl_init()
     */
    private $connect;   

    /**
     * Establece las cabeceras de la petición
     * 
     * @param array $headers : Listado de cabeceras
     * 
     * @return void
     */
    private function setHeaders(array $headers = []) {
        curl_setopt($this->connect, CURLOPT_HEADER, false);
        curl_setopt($this->connect, CURLOPT_HTTPHEADER, array_merge(
            array(
                'api-key-ocrend: ' . $this->ocrendAuth,
                'request-ini-time: ' . time()
            ),
            $headers
        ));
    }

    /**
     * Ejecuta la petición a la red de nodos
     * 
     * @throws ApiError si hay algún problema en la llamada 
     * @return array
    */
    private function execute() : array {
        $primitiveResponse = curl_exec($this->connect);

        # Verificar si hay error en la llamada
        if(curl_error($this->connect)) {
            $info = curl_getinfo($this->connect);
            throw new ApiError('Llamada a ' . $info['url'] . ' fallida: ' . curl_error($this->connect));
        }

        # Dar formato a la respuesta
        $response = json_decode($primitiveResponse, true);
        if(null === $response) {
            $response = json_decode(str_replace(',', '', $primitiveResponse), true);
            if (null === $response) {
                throw new ApiError('No podemos decodificar la respuesta JSON de Ocrend: ' . $primitiveResponse);
            }   
        }

        return $response;
    }

    /**
     * Inicializa la conexion con el servidor
     * 
     * @param string $ocrendAPI_KEY : API KEY para autenticacion con la api de Ocrend
     * 
     * @return void
     */
    public function __construct(string $ocrendAPI_KEY) {
        $this->ocrendAuth = $ocrendAPI_KEY;
        $this->connect = curl_init();
        curl_setopt($this->connect, CURLOPT_USERAGENT, 'ripple-client-php-by-ocrend/1.0');
        curl_setopt($this->connect, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->connect, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($this->connect, CURLOPT_TIMEOUT, 60);
        curl_setopt($this->connect, CURLOPT_CAINFO,  dirname(__FILE__) . self::sslRoute);   
    }
    
    /**
     * Envia una peticion POST al nodo
     * 
     * @param array $data : todos los datos a enviar
     * @param string $endpoint : endpoint de la api
     * 
     * @return array con respuesta del servidor
     */
    public function post(array $data, string $endpoint) : array {
        $data_json = json_encode($data);
        $this->setHeaders(array(
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_json)
        ));
        curl_setopt($this->connect, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($this->connect, CURLOPT_POSTFIELDS, $data_json); 
        
        return $this->execute();
    }

    /**
     * Envia una peticion GET al nodo
     * 
     * @param string $endpoint : endpoint de la api
     * 
     * @return array con respuesta del servidor
     */
    public function get(string $endpoint) : array {
        $this->setHeaders();
        curl_setopt($this->connect, CURLOPT_POST, false);
        curl_setopt($this->connect, CURLOPT_URL, self::serverApiNode . $endpoint);

        return $this->execute();
    }

    /**
     * Cierra la conexion con el servidor
     * 
     * @return void
     */
    public function __destruct() {
        curl_close($this->connect);
    }
}