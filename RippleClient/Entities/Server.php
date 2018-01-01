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
     */
    public function getInfo() : array {
        return $this->client->get('server/info');
    }

}