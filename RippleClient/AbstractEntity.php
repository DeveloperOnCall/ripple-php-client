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
 * Abstraccion de la entidad
 *
 * @author Brayan Narváez <princk093@gmail.com>
 */
abstract class AbstractEntity {

    /**
     * Instancia del cliente
     * 
     * @var RippleClient
     */
    protected $client;

    /**
     * Establece el cliente para la entidad
     * 
     * @param RippleClient $client : instancia del cliente
     * 
     * @return void
     */
    public function __construct(RippleClient $client) {
        $this->client = $client;
    }
}