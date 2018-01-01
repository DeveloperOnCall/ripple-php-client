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
 * Manejador de Ordenes en la red Ripple
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
     * Obtiene todas las ordenes de una wallet
     * /order/{wallet}
     * 
     * @return array
     */
    public function getOrders() : array {

    }

    /**
     * Prepara y crea una orden
     * /order/create
     * 
     * @return array
     */
    public function createOrder() : array {

    }

    /**
     * Cancela una orden existente
     * /order/cancel
     * 
     * @return array
     */
    public function cancelOrder() : array {

    }

}