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

namespace LucasSilva\OrderCancellationEmail\Model\Email\Template\Variables;

use LucasSilva\OrderCancellationEmail\Api\Data\Email\Data\OrderCancelEmailVariablesInterface;
use LucasSilva\OrderCancellationEmail\Api\Data\Email\Data\OrderCancelEmailVariablesInterfaceFactory;
use LucasSilva\OrderCancellationEmail\Api\Email\GetOrderCancelTemplateVariablesInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Model\Order\Email\Container\OrderIdentity;
use Magento\Sales\Model\Order\Address\Renderer;
use Magento\Payment\Helper\Data as PaymentHelper;

class GetOrderCancelTemplateVariables implements GetOrderCancelTemplateVariablesInterface
{
    /** @var OrderCancelEmailVariablesInterfaceFactory */
    private $orderCancelEmailVariablesFactory;

    /** @var PaymentHelper */
    private $paymentHelper;

    /** @var OrderIdentity */
    private $orderIdentity;

    /** @var Renderer */
    private $addressRenderer;

    /**
     * GetOrderCancelTemplateVariables constructor.
     *
     * @param OrderCancelEmailVariablesInterfaceFactory $orderCancelEmailVariablesFactory
     * @param PaymentHelper $paymentHelper
     * @param OrderIdentity $orderIdentity
     * @param Renderer $addressRenderer
     */
    public function __construct(
        OrderCancelEmailVariablesInterfaceFactory $orderCancelEmailVariablesFactory,
        PaymentHelper                             $paymentHelper,
        OrderIdentity                             $orderIdentity,
        Renderer                                  $addressRenderer
    ) {
        $this->orderCancelEmailVariablesFactory = $orderCancelEmailVariablesFactory;
        $this->paymentHelper = $paymentHelper;
        $this->orderIdentity = $orderIdentity;
        $this->addressRenderer = $addressRenderer;
    }

    /**
     * Execute Method.
     *
     * @param OrderInterface $order
     *
     * @return OrderCancelEmailVariablesInterface
     * @throws \Exception
     */
    public function execute(OrderInterface $order): OrderCancelEmailVariablesInterface
    {
        $orderCancelEmailVariables = $this->orderCancelEmailVariablesFactory->create();

        $orderCancelEmailVariables->setOrder($order);
        $orderCancelEmailVariables->setBillingAddress($order->getBillingAddress());
        $orderCancelEmailVariables->setPaymentHtml($this->getPaymentHtml($order));
        $orderCancelEmailVariables->setStore($order->getStore());
        $orderCancelEmailVariables->setFormattedShippingAddress($this->getFormattedShippingAddress($order));
        $orderCancelEmailVariables->setFormattedBillingAddress($this->getFormattedBillingAddress($order));
        $orderCancelEmailVariables->setCreatedAtFormatted($order->getCreatedAtFormatted(2));

        return $orderCancelEmailVariables;
    }

    /**
     * Get Payment Html Method.
     *
     * @param OrderInterface $order
     *
     * @return string
     * @throws \Exception
     */
    private function getPaymentHtml(OrderInterface $order): string
    {
        return (string) $this->paymentHelper->getInfoBlockHtml(
            $order->getPayment(),
            $this->orderIdentity->getStore()->getStoreId()
        );
    }

    /**
     * Get Formatted Shipping Address Method.
     *
     * @param OrderInterface $order
     *
     * @return string
     */
    private function getFormattedShippingAddress(OrderInterface $order): string
    {
        return $order->getIsVirtual()
            ? ''
            : (string) $this->addressRenderer->format($order->getShippingAddress(), 'html');
    }

    /**
     * Get Formatted Billing Address Method.
     *
     * @param OrderInterface $order
     *
     * @return string
     */
    private function getFormattedBillingAddress(OrderInterface $order): string
    {
        return (string) $this->addressRenderer->format($order->getBillingAddress(), 'html');
    }
}
