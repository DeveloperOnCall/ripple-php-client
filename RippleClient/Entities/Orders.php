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

/**
 * Intermediaro para interactuar con ordenes en la red de Ripple
 *
 * @author Brayan Narváez <princk093@gmail.com>
 */
class Orders extends AbstractEntity implements IEntity {

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
     * Obtiene una orden especificada
     * 
     * @return array
     */
    public function getOrder() : array {

    }

    /**
     * Obtiene todas las ordenes de una wallet
     * 
     * @return array
     */
    public function getOrders() : array {

    }

    /**
     * Genera una orden
     * 
     * @return array
     */
    public function setOrder() : array {

    }

}