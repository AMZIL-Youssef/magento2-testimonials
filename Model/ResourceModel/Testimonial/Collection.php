<?php
namespace Sda\Testimonials\Model\ResourceModel\Testimonial;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Sda\Testimonials\Model\Testimonial;
use Sda\Testimonials\Model\ResourceModel\Testimonial as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Testimonial::class, ResourceModel::class);
    }
}