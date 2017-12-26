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
 * Manipula el tipo de dato Amount
 *
 * @author Brayan Narváez <princk093@gmail.com>
 */

class Amount {
    
    /**
     * Listado de monedas permitidas en la red Ripple
     * 
     * @var array
     */
    const CURRENCIES = [
        'AFA',        'AWG',        'AUD',
        'ARS',        'AZN',        'BSD',
        'BDT',        'BBD',        'BYR',
        'BOB',        'BRL',        'GBP',
        'BGN',        'KHR',        'CAD',
        'KYD',        'CLP',        'CNY',
        'COP',        'CRC',        'HRK',
        'CPY',        'CZK',        'DKK',
        'DOP',        'XCD',        'EGP',
        'ERN',        'EEK',        'EUR',
        'GEL',        'GHC',        'GIP',
        'GTQ',        'HNL',        'HKD',
        'HUF',        'ISK',        'INR',
        'IDR',        'ILS',        'JMD',
        'JPY',        'KZT',        'KES',
        'KWD',        'LVL',        'LBP',
        'LTL',        'MOP',        'MKD',
        'MGA',        'MYR',        'MTL',
        'BAM',        'MUR',        'MXN',
        'MZM',        'NPR',        'ANG',
        'TWD',        'NZD',        'NIO',
        'NGN',        'KPW',        'NOK',
        'OMR',        'PKR',        'PYG',
        'PEN',        'PHP',        'QAR',
        'RON',        'RUB',        'SAR',
        'CSD',        'SCR',        'SGD',
        'SKK',        'SIT',        'ZAR',
        'KRW',        'LKR',        'SRD',
        'SEK',        'CHF',        'TZS',
        'THB',        'TTD',        'TRY',
        'AED',        'USD',        'UGX',
        'UAH',        'UYU',        'UZS',
        'VEB',        'VND',        'AMK',
        'ZWD',        'XRP',        'BTC'
    ];

    /**
     * Tipo de dato con la estructura para un monto
     * 
     * @var array
     */
    public $amount = [];

    /**
     * Construye un objeto dirección de wallet
     * 
     * @param float $value : Valor del monto
     * @param string $currency : Currency del monto
     * @param Address $counterparty : Dirección de wallet en caso de que $currency != 'XRP'
     * 
     * @throws ParamException cuando $address no tiene un formáto válido
     * @return void
     */
    public function __construct(float $value, string $currency, Address $counterparty = null) {
        if(!in_array($currency,self::CURRENCIES)) {
            throw new ParamException('El currency '. $currency . ' no existe');
        }
        $this->amount['currency'] = $currency;

        if($currency != 'XRP') {
            if(!$counterparty instanceof Address) {
                throw new ParamException('Se debe especificar un counterparty para el currency '. $currency);
            }

            if($value <= 0) {
                throw new ParamException('El valor del monto '. $value . '-'. $currency.' debe ser mayor a 0');
            }

            $this->amount['counterparty'] = $counterparty->address;
            $this->amount['value'] = sprintf("%.16f", $value);
        } else {

            if($value < 0.000001 || $value > 100000000000) {
                throw new ParamException('El valor del monto '. $value . '-XRP debe ser mayor a 0.000001 y menor a 100000000000');
            }

            $this->amount['value'] = sprintf("%.6f", $value);
        }        
    }
}