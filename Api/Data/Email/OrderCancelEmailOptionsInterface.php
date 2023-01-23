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

namespace LucasSilva\OrderCancellationEmail\Api\Data\Email;

use LucasSilva\OrderCancellationEmail\Api\Data\Email\Data\OrderCancelEmailVariablesInterface;

interface OrderCancelEmailOptionsInterface
{
    /**
     * GetTemplateId method
     *
     * @return string
     */
    public function getTemplateId(): string;

    /**
     * SetTemplateId method
     *
     * @param string $templateId
     *
     * @return void
     */
    public function setTemplateId(string $templateId): void;

    /**
     * GetTemplateOptions method
     *
     * @return array
     */
    public function getTemplateOptions(): array;

    /**
     * SetTemplateOptions method
     *
     * @param array $templateOptions
     *
     * @return void
     */
    public function setTemplateOptions(array $templateOptions): void;

    /**
     * GetTemplateVariables method
     *
     * @return OrderCancelEmailVariablesInterface
     */
    public function getTemplateVariables(): OrderCancelEmailVariablesInterface;

    /**
     * SetTemplateVariables method
     *
     * @param OrderCancelEmailVariablesInterface $orderVariables
     *
     * @return void
     */
    public function setTemplateVariables(OrderCancelEmailVariablesInterface $orderVariables): void;

    /**
     * GetFromByScope method
     *
     * @return string
     */
    public function getFromByScope(): string;

    /**
     * SetFromByScope method
     *
     * @param string $from
     *
     * @return void
     */
    public function setFromByScope(string $from): void;
}
