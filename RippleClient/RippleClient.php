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
     * Inicializa la conexion con el servidor
     * 
     * @param string $ocrendAPI_KEY : API KEY para autenticacion con la api de Ocrend
     * 
     * @return void
     */
    public function __construct(string $ocrendAPI_KEY) {
        $this->ocrendAuth = $ocrendAPI_KEY;
    }
    
    /**
     * Envia una peticion POST al nodo
     * 
     * @param array $data : todos los datos a enviar
     * 
     * @return array con respuesta del servidor
     */
    public function post(array $data) : array {

    }

    /**
     * Envia una peticion GET al nodo
     * 
     * @param array $data : todos los datos a enviar
     * 
     * @return array con respuesta del servidor
     */
    public function get(array $data) : array {

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