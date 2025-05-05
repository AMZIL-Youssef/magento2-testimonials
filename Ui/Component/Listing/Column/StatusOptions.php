<?php
namespace Sda\Testimonials\Ui\Component\Listing\Column;

use Magento\Framework\Data\OptionSourceInterface;

class StatusOptions implements OptionSourceInterface
{
    /**
     * Return value–label pairs for the grid’s select filter
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => 0, 'label' => __('En attente')],
            ['value' => 1, 'label' => __('Approuvé')],
            ['value' => 2, 'label' => __('Rejeté')],
        ];
    }
}
