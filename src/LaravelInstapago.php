<?php

namespace Tepuilabs\LaravelInstapago;

use Instapago\Instapago\Api;
use Instapago\Instapago\Exceptions\InstapagoException;

class LaravelInstapago
{
    protected string $key_id;
    protected string $public_key_id;

    protected Api $api;

    /**
     *
     * @psalm-suppress PossiblyInvalidCast
     * @psalm-suppress PossiblyInvalidArgument
     */
    public function __construct()
    {
        $this->key_id = config('laravel-instapago.key_id');
        $this->public_key_id = config('laravel-instapago.public_key_id');

        if (empty($this->key_id) || empty($this->public_key_id)) {
            throw new InstapagoException('Los parámetros "keyId" y "publicKeyId" son requeridos para procesar la petición.');
        }

        $this->api = new Api($this->key_id, $this->public_key_id);
    }

    /**
     * Crear un pago directo.
     *
     * @param array<string> $fields Los campos necesarios
     *                              para procesar el pago.
     *
     * @throws \Instapago\Instapago\Exceptions\InstapagoException
     *
     * @return array<string> Respuesta de Instapago
     */
    public function directPayment(array $fields)
    {
        return $this->api->directPayment($fields);
    }

    /**
     * Crear un pago diferido o reservado.
     *
     * @param array<string> $fields Los campos necesarios
     *                              para procesar el pago.
     *
     * @throws \Instapago\Instapago\Exceptions\InstapagoException
     *
     * @return array<string> Respuesta de Instapago
     */
    public function reservePayment(array $fields)
    {
        return $this->api->reservePayment($fields);
    }

    /**
     * Completar Pago
     * Este método funciona para procesar un bloqueo o pre-autorización
     * para así procesarla y hacer el cobro respectivo.
     *
     * @param array<string> $fields Los campos necesarios
     *                              para procesar el pago.
     *
     * @throws \Instapago\Instapago\Exceptions\InstapagoException
     *
     * @return array<string> Respuesta de Instapago
     */
    public function continuePayment(array $fields)
    {
        return $this->api->continuePayment($fields);
    }

    /**
     * Información/Consulta de Pago
     * Este método funciona para procesar un bloqueo o pre-autorización
     * para así procesarla y hacer el cobro respectivo.
     *
     * @param string $paymentId ID del pago a consultar
     *
     * @throws \Instapago\Instapago\Exceptions\InstapagoException
     *
     * @return array<string> Respuesta de Instapago
     */
    public function query(string $paymentId)
    {
        return $this->api->query($paymentId);
    }

    /**
     * Cancelar Pago
     * Este método funciona para cancelar un pago previamente procesado.
     *
     * @param string $paymentId ID del pago a cancelar
     *
     * @throws \Instapago\Instapago\Exceptions\InstapagoException
     *
     * @return array<string> Respuesta de Instapago
     */
    public function cancel($paymentId)
    {
        return $this->api->cancel($paymentId);
    }
}
