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

namespace LucasSilva\OrderCancellationEmail\Observer;

use LucasSilva\OrderCancellationEmail\Api\Config\OrderCancelConfigProviderInterface;
use LucasSilva\OrderCancellationEmail\Api\Email\GetOrderCancelTransportInterface;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;

class SalesOrderCancelAfter implements \Magento\Framework\Event\ObserverInterface
{
    /** @var OrderCancelConfigProviderInterface */
    private $orderCancelConfigProvider;

    /** @var GetOrderCancelTransportInterface */
    private $getOrderCancelTransport;

    /** @var LoggerInterface */
    private $logger;

    /**
     * SalesOrderCancelAfter constructor.
     *
     * @param OrderCancelConfigProviderInterface $orderCancelConfigProvider
     * @param GetOrderCancelTransportInterface $getOrderCancelTransport
     * @param LoggerInterface $logger
     */
    public function __construct(
        OrderCancelConfigProviderInterface $orderCancelConfigProvider,
        GetOrderCancelTransportInterface   $getOrderCancelTransport,
        LoggerInterface                    $logger
    ) {
        $this->orderCancelConfigProvider = $orderCancelConfigProvider;
        $this->getOrderCancelTransport = $getOrderCancelTransport;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        try {
            $order = $observer->getOrder();

            if ($this->orderCancelConfigProvider->isModuleEnable((int) $order->getStoreId()) === false) {
                return $this;
            }

            $transport = $this->getOrderCancelTransport->execute($order);

            $transport->sendMessage();
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        return $this;
    }
}
