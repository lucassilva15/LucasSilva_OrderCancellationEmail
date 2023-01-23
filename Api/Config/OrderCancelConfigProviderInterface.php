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

namespace LucasSilva\OrderCancellationEmail\Api\Config;

interface OrderCancelConfigProviderInterface
{
    const CONFIG_XML_PATH = 'sales_email/cancel_order/';

    /**
     * Get Config Value.
     *
     * @param string $fieldId
     * @param int    $storeId
     *
     * @return mixed
     */
    public function getConfigValue(string $fieldId, int $storeId);

    /**
     * Is Module Enable Method.
     *
     * @param int $storeId
     *
     * @return bool
     */
    public function isModuleEnable(int $storeId): bool;
}
