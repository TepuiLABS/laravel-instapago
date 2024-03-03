<?php

namespace Tepuilabs\LaravelInstapago;

use GuzzleHttp\Exception\GuzzleException;
use Instapago\Instapago\Api;
use Instapago\Instapago\Exceptions\GenericException;
use Instapago\Instapago\Exceptions\InstapagoException;
use Instapago\Instapago\Exceptions\TimeoutException;
use Instapago\Instapago\Exceptions\ValidationException;

class LaravelInstapago
{
    protected Api $api;

    /**
     * @throws InstapagoException
     */
    public function __construct()
    {
        $this->api = new Api(
            config('laravel-instapago.key_id'),
            config('laravel-instapago.public_key_id')
        );
    }

    /**
     * Crear un pago directo.
     *
     * @param  array<string>  $fields  Los campos necesarios
     *                                 para procesar el pago.
     * @return array|string Respuesta de Instapago
     */
    public function directPayment(array $fields): array|string
    {
        return $this->api->directPayment($fields);
    }

    /**
     * Crear un pago diferido o reservado.
     *
     * @param  array<string>  $fields  Los campos necesarios
     *                                 para procesar el pago.
     * @return array<string> Respuesta de Instapago
     */
    public function reservePayment(array $fields): array
    {
        return $this->api->reservePayment($fields);
    }

    /**
     * Completar Pago
     * Este método funciona para procesar un bloqueo o pre-autorización
     * para así procesarla y hacer el cobro respectivo.
     *
     * @param  array<string>  $fields  Los campos necesarios
     *                                 para procesar el pago.
     */
    public function completePayment(array $fields): array|string
    {
        try {
            return $this->api->completePayment($fields);
        } catch (GuzzleException|GenericException|TimeoutException|ValidationException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Información/Consulta de Pago
     * Este método funciona para procesar un bloqueo o pre-autorización
     * para así procesarla y hacer el cobro respectivo.
     *
     * @param  string  $paymentId  ID del pago a consultar
     */
    public function query(string $paymentId): array|string
    {
        try {
            return $this->api->query($paymentId);
        } catch (GuzzleException|GenericException|TimeoutException|ValidationException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Cancelar Pago
     * Este método funciona para cancelar un pago previamente procesado.
     *
     * @param  string  $paymentId  ID del pago a cancelar
     *
     * @throws ValidationException
     */
    public function cancel(string $paymentId): array
    {
        return $this->api->cancel($paymentId);
    }
}
