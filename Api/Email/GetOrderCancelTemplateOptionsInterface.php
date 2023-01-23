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

namespace LucasSilva\OrderCancellationEmail\Api\Email;

use LucasSilva\OrderCancellationEmail\Api\Data\Email\OrderCancelEmailOptionsInterface;
use Magento\Sales\Api\Data\OrderInterface;

interface GetOrderCancelTemplateOptionsInterface
{
    /**
     * Execute method
     *
     * @param OrderInterface $order
     *
     * @return OrderCancelEmailOptionsInterface
     */
    public function execute(OrderInterface $order): OrderCancelEmailOptionsInterface;
}
