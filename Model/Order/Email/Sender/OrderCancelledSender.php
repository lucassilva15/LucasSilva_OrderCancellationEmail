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

namespace LucasSilva\OrderCancellationEmail\Model\Order\Email\Sender;

use LucasSilva\OrderCancellationEmail\Model\Order\Email\Container\OrderCancelledIdentity;
use Magento\Framework\Event\ManagerInterface;
use Magento\Payment\Helper\Data as PaymentHelper;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\Order\Address\Renderer;
use Magento\Sales\Model\Order\Email\Container\Template;
use Magento\Sales\Model\Order\Email\NotifySender;
use Magento\Sales\Model\Order\Email\SenderBuilderFactory;
use Psr\Log\LoggerInterface;

class OrderCancelledSender extends NotifySender
{
    /** @var PaymentHelper */
    private $paymentHelper;

    /** @var Renderer */
    protected $addressRenderer;

    /** @var ManagerInterface */
    private $eventManager;

    /**
     * OrderCancelledSender constructor.
     *
     * @param Template $templateContainer
     * @param OrderCancelledIdentity $identityContainer
     * @param SenderBuilderFactory $senderBuilderFactory
     * @param LoggerInterface $logger
     * @param PaymentHelper $paymentHelper
     * @param Renderer $addressRenderer
     * @param ManagerInterface $eventManager
     */
    public function __construct(
        Template               $templateContainer,
        OrderCancelledIdentity $identityContainer,
        SenderBuilderFactory   $senderBuilderFactory,
        LoggerInterface        $logger,
        PaymentHelper          $paymentHelper,
        Renderer               $addressRenderer,
        ManagerInterface       $eventManager
    ) {
        parent::__construct($templateContainer, $identityContainer, $senderBuilderFactory, $logger, $addressRenderer);
        $this->paymentHelper = $paymentHelper;
        $this->addressRenderer = $addressRenderer;
        $this->eventManager = $eventManager;
    }

    /**
     * Send method
     *
     * @param Order $order
     * @param bool $notify
     *
     * @return bool
     * @throws \Exception
     */
    public function send(Order $order, bool $notify = true): bool
    {
        $transport = [
            'order' => $order,
            'billing' => $order->getBillingAddress(),
            'payment_html' => $this->getPaymentHtml($order),
            'store' => $order->getStore(),
            'formattedShippingAddress' => $this->getFormattedShippingAddress($order),
            'formattedBillingAddress' => $this->getFormattedBillingAddress($order),
        ];

        $this->eventManager->dispatch(
            'email_order_cancelled_set_template_vars_before',
            ['sender' => $this, 'transport' => $transport]
        );

        $this->templateContainer->setTemplateVars($transport);

        return $this->checkAndSend($order, $notify);
    }

    /**
     * GetPaymentHtml method
     *
     * @param Order $order
     *
     * @return string
     * @throws \Exception
     */
    protected function getPaymentHtml(Order $order): string
    {
        return $this->paymentHelper->getInfoBlockHtml(
            $order->getPayment(),
            $this->identityContainer->getStore()->getStoreId()
        );
    }
}
