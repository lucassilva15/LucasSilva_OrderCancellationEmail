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

namespace LucasSilva\OrderCancellationEmail\Model\Config;

use LucasSilva\OrderCancellationEmail\Api\Config\OrderCancelConfigProviderInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class OrderCancelConfigProvider implements OrderCancelConfigProviderInterface
{
    /** @var ScopeConfigInterface */
    private $scopeConfig;

    /**
     * OrderCancelConfigProvider constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @inheritDoc
     */
    public function getConfigValue(string $fieldId, int $storeId)
    {
        return $this->scopeConfig->getValue(
            self::CONFIG_XML_PATH . $fieldId,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @inheritDoc
     */
    public function isModuleEnable(int $storeId): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::CONFIG_XML_PATH . 'enabled',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
