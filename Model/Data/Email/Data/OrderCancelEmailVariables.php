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

namespace LucasSilva\OrderCancellationEmail\Model\Data\Email\Data;

use LucasSilva\OrderCancellationEmail\Api\Data\Email\Data\OrderCancelEmailVariablesInterface;
use Magento\Framework\DataObject;
use Magento\Sales\Api\Data\OrderAddressInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Store\Api\Data\StoreInterface;

class OrderCancelEmailVariables extends DataObject implements OrderCancelEmailVariablesInterface
{
    /**
     * @inheritDoc
     */
    public function getOrder(): OrderInterface
    {
        return $this->getData('order');
    }

    /**
     * @inheritDoc
     */
    public function setOrder(OrderInterface $order): void
    {
        $this->setData('order', $order);
    }

    /**
     * @inheritDoc
     */
    public function getBillingAddress(): OrderAddressInterface
    {
        return $this->getData('billing_address');
    }

    /**
     * @inheritDoc
     */
    public function setBillingAddress(OrderAddressInterface $address): void
    {
        $this->setData('billing_address', $address);
    }

    /**
     * @inheritDoc
     */
    public function getPaymentHtml(): string
    {
        return (string) $this->getData('payment_html');
    }

    /**
     * @inheritDoc
     */
    public function setPaymentHtml(string $payment): void
    {
        $this->setData('payment_html', $payment);
    }

    /**
     * @inheritDoc
     */
    public function getStore(): StoreInterface
    {
        return $this->getData('store');
    }

    /**
     * @inheritDoc
     */
    public function setStore(StoreInterface $store): void
    {
        $this->setData('store', $store);
    }

    /**
     * @inheritDoc
     */
    public function getFormattedShippingAddress(): string
    {
        return (string) $this->getData('formatted_shipping_address');
    }

    /**
     * @inheritDoc
     */
    public function setFormattedShippingAddress(string $shippingAddress): void
    {
        $this->setData('formatted_shipping_address', $shippingAddress);
    }

    /**
     * @inheritDoc
     */
    public function getFormattedBillingAddress(): string
    {
        return (string) $this->getData('formatted_billing_address');
    }

    /**
     * @inheritDoc
     */
    public function setFormattedBillingAddress(string $billingAddress): void
    {
        $this->setData('formatted_billing_address', $billingAddress);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAtFormatted(): string
    {
        return (string) $this->getData('created_at_formatted');
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAtFormatted(string $createdAt): void
    {
        $this->setData('created_at_formatted', $createdAt);
    }
}
