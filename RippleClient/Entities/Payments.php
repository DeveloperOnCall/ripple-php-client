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
 * Manejador de Transacciones en la red Ripple
 *
 * @author Brayan Narváez <princk093@gmail.com>
 */
class Payments extends AbstractEntity implements IEntity {

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
     * Obtiene el detalle de una transacción según su ID
     */
    public function getTransaction() {

    }

    /**
     * Obtiene las transacciones de una wallet
     */
    public function getTransactions() {

    }

    /**
     * Crea una transacción desde una cuenta hacia otras dos
     * otorgando una comisión a uno de los dos destinos
     */
    public function createPaymentWithFee() {

    }

    /**
     * Crea una transacción desde una cuenta hacia otra
     */
    public function createPayment() {

    }

}