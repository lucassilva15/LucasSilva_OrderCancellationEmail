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

namespace LucasSilva\OrderCancellationEmail\Model\Email;

use LucasSilva\OrderCancellationEmail\Api\Config\OrderCancelConfigProviderInterface;
use LucasSilva\OrderCancellationEmail\Api\Email\GetOrderCancelTemplateOptionsInterface;
use LucasSilva\OrderCancellationEmail\Api\Email\GetOrderCancelTransportInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Mail\TransportInterface;
use Magento\Sales\Api\Data\OrderInterface;

class GetOrderCancelTransport implements GetOrderCancelTransportInterface
{
    /** @var GetOrderCancelTemplateOptionsInterface */
    private $getOrderCancelTemplateOptions;

    /** @var OrderCancelConfigProviderInterface */
    private $orderCancelConfigProvider;

    /** @var TransportBuilder */
    private $transportBuilder;

    /**
     * GetOrderCancelTransport constructor.
     *
     * @param GetOrderCancelTemplateOptionsInterface $getOrderCancelTemplateOptions
     * @param OrderCancelConfigProviderInterface $orderCancelConfigProvider
     * @param TransportBuilder $transportBuilder
     */
    public function __construct(
        GetOrderCancelTemplateOptionsInterface $getOrderCancelTemplateOptions,
        OrderCancelConfigProviderInterface     $orderCancelConfigProvider,
        TransportBuilder                       $transportBuilder

    ) {
        $this->getOrderCancelTemplateOptions = $getOrderCancelTemplateOptions;
        $this->orderCancelConfigProvider = $orderCancelConfigProvider;
        $this->transportBuilder = $transportBuilder;
    }

    /**
     * @inheirtDoc
     * @throws MailException|LocalizedException
     */
    public function execute(OrderInterface $order): TransportInterface
    {
        $templateOptions = $this->getOrderCancelTemplateOptions->execute($order);
        $templateVariables = $templateOptions->getTemplateVariables();

        $this->transportBuilder->setTemplateVars($templateVariables->getData());
        $this->transportBuilder->setTemplateIdentifier($templateOptions->getTemplateId());
        $this->transportBuilder->setTemplateOptions($templateOptions->getTemplateOptions());
        $this->transportBuilder->setFromByScope($templateOptions->getFromByScope());
        $this->transportBuilder->addTo($order->getCustomerEmail(), $order->getCustomerFirstname());

        $emailsCopy = $this->orderCancelConfigProvider->getConfigValue('copy_to', (int) $order->getStoreId());

        if (!empty($emailsCopy)) {
            $this->transportBuilder->addBcc(explode(',', $emailsCopy));
        }

        return $this->transportBuilder->getTransport();
    }
}
