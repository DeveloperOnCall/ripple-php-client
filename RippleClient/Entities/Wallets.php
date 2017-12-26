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
        {   
            * Establece si se ha conseguido el recurso solicitado, si es 0, estará acompañado de un atributo message del servidor
            "success" => 1,
            * El siguiente número de secuencia (el más pequeño sin usar) para esta cuenta.
            "sequence" => 23, 
            * El balance total en XRP.
            "xrpBalance" => "922.913243",
            * Número de otras entradas contables (específicamente, líneas de confianza y ofertas) atribuidas a esta cuenta. 
            * Esto se usa para calcular la reserva total requerida para usar la cuenta.
            "ownerCount" => 1,
            * Valor hash que representa la transacción más reciente que afectó directamente a este nodo de cuenta.
            * Nota: Esto no incluye cambios en las líneas de confianza y ofertas de la cuenta.
            "previousAffectingTransactionID" => "19899273706A9E040FDB5885EE991A1DC2BAD878A0D6E7DBCFB714E63BF737F7",
            * La versión del Ledger en la que se validó la transacción identificada por el identificador de transacción anterior.
            "previousAffectingTransactionLedgerVersion" => 6614625
        }
     */
    public function getInfo() : array {
        $this->checkAddress();
        return $this->client->get('account/' . $this->wallet->address);
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
     [
        * Establece si se ha conseguido el recurso solicitado, si es 0, estará acompañado de un atributo message del servidor
        "success" => 1,
        "balances" => [
            * Arreglo con la estructura de Amount, el primer resultado siempre será el Amount en XRP
            {
                "value" => "922.913243",
                "currency" => "XRP"
            },
            * Ofrece todos los balances de todas las monedas y los correspndientes a la contraparte de la wallet solicitada
            * que debe o le debe fondos a la wallet solicitada
            {
                * Este valor puede ser negativo (eso es en el caso de que la wallet solicitada deba los fondos a la contraparte)
                * Si el valor es positivo, el que debe es la contraparte
                "value" => "100.5",
                "currency" => "USD",
                "counterparty" => "r3vi7mWxru9rJCxETCyA1CHvzL96eZWx5z"
            },
            {...}
        ]
     ]
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
        $w = $this->client->post(array(
            'not_found_wallet' => true
        ),'create');
        return new Address($w['address'],$w['secret']);
    }

}