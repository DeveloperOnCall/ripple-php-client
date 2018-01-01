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
     * Obtiene el fee de la network de Ripple
     * /payment/fee
     * 
     */
    public function getFee() : array {

    }

    /**
     * Obtiene el detalle de una transacción según su ID
     * /transaction/{id_transaction}
     * 
     */
    public function getTransaction() : array {

    }

    /**
     * Obtiene las transacciones de una wallet
     * /transactions/{wallet}/{limit}
     * 
     */
    public function getTransactions() : array {

    }

    /**
     * Crea una transacción desde una cuenta hacia otras dos
     * otorgando una comisión a uno de los dos destinos
     * /payment/many
     * 
     */
    public function createPaymentWithFee() : array {

    }

    /**
     * Crea una transacción desde una cuenta hacia otra
     * /payment
     * 
     */
    public function createPayment() : array {

    }

}