<?php
namespace Sda\Testimonials\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Sda\Testimonials\Model\ResourceModel\Testimonial\CollectionFactory;

class CarouselData implements ArgumentInterface
{
    protected $testimonialCollectionFactory;

    public function __construct(
        CollectionFactory $testimonialCollectionFactory
    ) {
        $this->testimonialCollectionFactory = $testimonialCollectionFactory;
    }

    public function getCarouselItems()
    {
        $testimonials = $this->testimonialCollectionFactory->create();
        $testimonials->addFieldToSelect('*');
        $testimonials->addFieldToFilter('status', 1);
        $testimonials->setOrder('created_at', 'DESC');
        $testimonials->setPageSize(10);
        return $testimonials;
    }
}
