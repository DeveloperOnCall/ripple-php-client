<?php

namespace Ocrend\RippleClient\Interfaces;

use Ocrend\RippleClient\RippleClient;

/**
 * Interfaz para todas las entidades
 */
interface IEntity {
    public function __construct(RippleClient $client);
}