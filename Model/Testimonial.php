<?php
namespace Sda\Testimonials\Model;

use Magento\Framework\Model\AbstractModel;
use Sda\Testimonials\Model\ResourceModel\Testimonial as ResourceModel;

class Testimonial extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}