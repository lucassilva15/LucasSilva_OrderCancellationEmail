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

namespace LucasSilva\OrderCancellationEmail\Model\Email\Template;

use LucasSilva\OrderCancellationEmail\Api\Config\OrderCancelConfigProviderInterface;
use LucasSilva\OrderCancellationEmail\Api\Data\Email\OrderCancelEmailOptionsInterface;
use LucasSilva\OrderCancellationEmail\Api\Data\Email\OrderCancelEmailOptionsInterfaceFactory;
use LucasSilva\OrderCancellationEmail\Api\Email\GetOrderCancelTemplateOptionsInterface;
use LucasSilva\OrderCancellationEmail\Api\Email\GetOrderCancelTemplateVariablesInterface;
use Magento\Framework\App\Area;
use Magento\Sales\Api\Data\OrderInterface;

class GetOrderCancelTemplateOptions implements GetOrderCancelTemplateOptionsInterface
{
    /** @var OrderCancelEmailOptionsInterfaceFactory */
    private $orderCancelEmailOptionsFactory;

    /** @var GetOrderCancelTemplateVariablesInterface */
    private $getOrderCancelTemplateVariables;

    /** @var OrderCancelConfigProviderInterface */
    private $orderCancelConfigProvider;

    /**
     * GetOrderCancelTemplateOptions constructor.
     *
     * @param OrderCancelEmailOptionsInterfaceFactory $orderCancelEmailOptionsFactory
     * @param GetOrderCancelTemplateVariablesInterface $getOrderCancelTemplateVariables
     * @param OrderCancelConfigProviderInterface $orderCancelConfigProvider
     */
    public function __construct(
        OrderCancelEmailOptionsInterfaceFactory  $orderCancelEmailOptionsFactory,
        GetOrderCancelTemplateVariablesInterface $getOrderCancelTemplateVariables,
        OrderCancelConfigProviderInterface       $orderCancelConfigProvider
    ) {
        $this->getOrderCancelTemplateVariables = $getOrderCancelTemplateVariables;
        $this->orderCancelEmailOptionsFactory = $orderCancelEmailOptionsFactory;
        $this->orderCancelConfigProvider = $orderCancelConfigProvider;
    }

    /**
     * @inheirtDoc
     */
    public function execute(OrderInterface $order): OrderCancelEmailOptionsInterface
    {
        $orderCancelEmailOptions = $this->orderCancelEmailOptionsFactory->create();
        $orderCancelEmailVariables = $this->getOrderCancelTemplateVariables->execute($order);

        $orderCancelEmailOptions->setTemplateVariables($orderCancelEmailVariables);
        $orderCancelEmailOptions->setTemplateId(
            $this->orderCancelConfigProvider->getConfigValue('template', (int) $order->getStoreId())
        );

        if ($order->getCustomerIsGuest()) {
            $orderCancelEmailOptions->setTemplateId(
                $this->orderCancelConfigProvider->getConfigValue('guest_template', (int) $order->getStoreId())
            );
        }

        $orderCancelEmailOptions->setFromByScope(
            $this->orderCancelConfigProvider->getConfigValue('identity', (int) $order->getStoreId())
        );

        $orderCancelEmailOptions->setTemplateOptions(['area' => Area::AREA_FRONTEND, 'store' => $order->getStoreId()]);

        return $orderCancelEmailOptions;
    }
}
