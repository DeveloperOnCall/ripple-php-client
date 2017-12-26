<?php

/*
 * This file is part of the Ripple PHP Client
 *
 * Developed by (c) Ocrend Software <info@ocrend.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ocrend\RippleClient\Entities;

use Ocrend\RippleClient\RippleClient;
use Ocrend\RippleClient\AbstractEntity;
use Ocrend\RippleClient\Interfaces\IEntity;
use Ocrend\RippleClient\Exceptions\ParamException;

/**
 * Manejador de información acerca del servidor en la red Ripple
 *
 * @author Brayan Narváez <princk093@gmail.com>
 */
class Server extends AbstractEntity implements IEntity {

    /**
     * Establece el cliente para la entidad
     * 
     * @param RippleClient $client : instancia del cliente
     * 
     * @return void
     */
    public function __construct(RippleClient $client) {
        parent::__construct($client);
    }

    /**
     * Obtiene información acerca del servidor de la red ripple
     * 
     * @return array
     {
        * El número de la versión que está corriendo de Ripple
        "buildVersion" => "0.24.0-rc1",
        * Expresión de rango que indica la secuencua de números de ledger
        * que el servidor de Ripple tiene en su base de datos local
        "completeLedgers" => "32570-6595042",
        * Cantidad de tiempo dedicado a esperar que se realicen operaciones I/O
        * Si este número es muy bajo, entonces el servidor de Ripple probablemente tiene serios problemas de carga
        "ioLatencyMs" => 1,
        * Información sobre la última vez que el servidor Ripple cerró un Ledger
        "lastClose" => {
            "convergeTimeS" => 2.007,
            "proposers" => 4
        },
        * A cuántos servidores de Ripple está conectado actualmente el Nodo
        "peers" => 53
    }
     */
    public function getInfo() : array {
        return $this->client->get('server/info');
    }

}