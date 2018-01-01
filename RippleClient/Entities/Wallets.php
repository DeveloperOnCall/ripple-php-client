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
use Ocrend\RippleClient\Types\Address;
use Ocrend\RippleClient\Exceptions\ParamException;


/**
 * Manejador de carteras en la red Ripple
 *
 * @author Brayan Narváez <princk093@gmail.com>
 */
class Wallets extends AbstractEntity implements IEntity {

    /**
     * Dirección de la cartera
     * 
     * @var Address|NULL
     */
    private $wallet = null;

    /**
     * Revisa si la wallet actual tiene una dirección antes de realiza una acción
     * 
     * @throws ParamException si existe algún problema
     * @return void
     */
    private function checkAddress()  {
        if(!$this->wallet instanceof Address) {
            throw new ParamException('Debe establecer una dirección para esta wallet con setAddress()');
        }
    }

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
     * Establece la dirección de la wallet
     * 
     * @param Address $address
     * 
     * @return void
     */
    public function setAddress(Address $address) {
        $this->wallet = $address;
    }

    /**
     * Verifica si una cuenta está fundada antes de solicitar su balance, información o intentar
     * hacer una transferencia desde esa cuenta hacia otra en la red Ripple
     * 
     * @return bool
     */
    public function checkFoundAddress() : bool {
        $this->checkAddress();
        $balances = $this->getBalances();

        return !array_key_exists('error', $balances);
    }
    
    /**
     * Obtiene información de la cartera
     * NOTA: Es recomendable utilizar checkFoundAddress() ante de utilizar este método.
     * NOTA 2: Es necesario establecer primero una address con setAddres()
     * 
     * @return array con información
     */
    public function getInfo() : array {
        $this->checkAddress();
        return $this->client->get('account/balances/' . $this->wallet->address);
    }
    
    /**
     * Obtiene todos los balances de la cartera
     * NOTA: Es recomendable utilizar checkFoundAddress() ante de utilizar este método.
     * NOTA 2: Es necesario establecer primero una address con setAddres()
     * 
     * @param int $limit : El límite de balances a traer (mientras menos, más rápida será la respuesta)
     * Si se indica 1, el balance que se obtendrá será sólamente el de XRP
     * 
     * @return array
     */
    public function getBalances(int $limit = 1) : array {
        $this->checkAddress();
        return $this->client->get('balances/' . $this->wallet->address . '/' . $limit);
    }

    /**
     * Genera una nueva wallet y devuelve su dirección en un objeto
     * 
     * @return Address con la dirección y el secret 
     */
    public function generateWallet() : Address {
        $w = $this->client->post([],'account/create');
        return new Address($w['address'],$w['secret']);
    }

}