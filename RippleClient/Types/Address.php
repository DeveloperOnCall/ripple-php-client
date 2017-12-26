<?php

/*
 * This file is part of the Ripple PHP Client
 *
 * Developed by (c) Ocrend Software <info@ocrend.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ocrend\RippleClient\Types;
use Ocrend\RippleClient\Exceptions\ParamException;

/**
 * Manipula el tipo de dato Address
 *
 * @author Brayan Narváez <princk093@gmail.com>
 */

class Address {
    
    /**
     * Dirección de monedero XRP
     * Cumple con el patrón ^r[1-9A-HJ-NP-Za-km-z]{25,34}$
     * 
     * @var string
     */
    public $address;

    /**
     * Secret del monedero XRP
     * 
     * @var string
     */
    public $secret;

    /**
     * Construye un objeto dirección de wallet
     * 
     * @param string $address : Dirección de XRP
     * @param string $secret : Secret asociado a esa dirección de XRP  
     * 
     * @throws ParamException cuando $address no tiene un formáto válido
     * @return void
     */
    public function __construct(string $address, string $secret = null) {
        $this->secret = null == $secret ? '' : $secret;
        $this->setAddress($address);
    }

    /**
     * Establece una dirección de wallet
     *
     * @param string $address
     * 
     * @throws ParamException cuando $address no tiene un formáto válido
     * @return void
     */
    private function setAddress(string $address) {
        if(!preg_match('/^r[1-9A-HJ-NP-Za-km-z]{25,34}$/',$address)) {
            throw new ParamException('La dirección ' . $address . ' no corresponde con el patrón ^r[1-9A-HJ-NP-Za-km-z]{25,34}$');
        }

        $this->address = $address;
    }
}