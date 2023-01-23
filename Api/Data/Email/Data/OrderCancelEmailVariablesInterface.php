<?php
/**
 * PHP version 7
 *
 * @author      Lucas Silva DEV <lucas.silva15@universo.univates.br>
 * @copyright   2023 Lucas Silva (http://www.lucassilva.dev.br)
 * @license     http://www.lucassilva.dev.br  Copyright
 * @link        http://www.lucassilva.dev.br
 */

declare(strict_types=1);

namespace LucasSilva\OrderCancellationEmail\Api\Data\Email\Data;

use Magento\Sales\Api\Data\OrderAddressInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Store\Api\Data\StoreInterface;

interface OrderCancelEmailVariablesInterface
{
    /**
     * GetOrder method
     *
     * @return OrderInterface
     */
    public function getOrder(): OrderInterface;

    /**
     * SetOrder method
     *
     * @param OrderInterface $order
     *
     * @return void
     */
    public function setOrder(OrderInterface $order): void;

    /**
     * GetBillingAddress method
     *
     * @return OrderAddressInterface
     */
    public function getBillingAddress(): OrderAddressInterface;

    /**
     * SetBillingAddress method
     *
     * @param OrderAddressInterface $address
     *
     * @return void
     */
    public function setBillingAddress(OrderAddressInterface $address): void;

    /**
     * GetPaymentHtml method
     *
     * @return string
     */
    public function getPaymentHtml(): string;

    /**
     * SetPaymentHtml method
     *
     * @param string $payment
     *
     * @return void
     */
    public function setPaymentHtml(string $payment): void;

    /**
     * GetStore method
     *
     * @return StoreInterface
     */
    public function getStore(): StoreInterface;

    /**
     * SetStore method
     *
     * @param StoreInterface $store
     *
     * @return void
     */
    public function setStore(StoreInterface $store): void;

    /**
     * GetFormattedShippingAddress method
     *
     * @return string
     */
    public function getFormattedShippingAddress(): string;

    /**
     * SetFormattedShippingAddress method
     *
     * @param string $shippingAddress
     *
     * @return void
     */
    public function setFormattedShippingAddress(string $shippingAddress): void;

    /**
     * GetFormattedBillingAddress method
     *
     * @return string
     */
    public function getFormattedBillingAddress(): string;

    /**
     * SetFormattedBillingAddress method
     *
     * @param string $billingAddress
     *
     * @return void
     */
    public function setFormattedBillingAddress(string $billingAddress): void;

    /**
     * GetCreatedAtFormatted method
     *
     * @return string
     */
    public function getCreatedAtFormatted(): string;

    /**
     * SetCreatedAtFormatted method
     *
     * @param string $createdAt
     *
     * @return void
     */
    public function setCreatedAtFormatted(string $createdAt): void;
}
