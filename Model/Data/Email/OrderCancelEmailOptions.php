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

namespace LucasSilva\OrderCancellationEmail\Model\Data\Email;

use LucasSilva\OrderCancellationEmail\Api\Data\Email\Data\OrderCancelEmailVariablesInterface;
use LucasSilva\OrderCancellationEmail\Api\Data\Email\OrderCancelEmailOptionsInterface;
use Magento\Framework\DataObject;

class OrderCancelEmailOptions extends DataObject implements OrderCancelEmailOptionsInterface
{

    /**
     * @inheritDoc
     */
    public function getTemplateId(): string
    {
        return (string) $this->getData('template_id');
    }

    /**
     * @inheritDoc
     */
    public function setTemplateId(string $templateId): void
    {
        $this->setData('template_id', $templateId);
    }

    /**
     * @inheritDoc
     */
    public function getTemplateOptions(): array
    {
        return (array) $this->getData('template_options');
    }

    /**
     * @inheritDoc
     */
    public function setTemplateOptions(array $templateOptions): void
    {
        $this->setData('template_options', $templateOptions);
    }

    /**
     * @inheritDoc
     */
    public function getTemplateVariables(): OrderCancelEmailVariablesInterface
    {
        return $this->getData('template_variables');
    }

    /**
     * @inheritDoc
     */
    public function setTemplateVariables(OrderCancelEmailVariablesInterface $orderVariables): void
    {
        $this->setData('template_variables', $orderVariables);
    }

    /**
     * @inheritDoc
     */
    public function getFromByScope(): string
    {
        return (string) $this->getData('from_by_scope');
    }

    /**
     * @inheritDoc
     */
    public function setFromByScope(string $from): void
    {
        $this->setData('from_by_scope', $from);
    }
}
