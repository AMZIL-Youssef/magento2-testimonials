<?php
namespace Sda\Testimonials\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Sda\Testimonials\Model\ResourceModel\Testimonial\CollectionFactory;

class Stats extends Template
{
    protected $testimonialCollectionFactory;

    public function __construct(
        Context $context,
        CollectionFactory $testimonialCollectionFactory,
        array $data = []
    ) {
        $this->testimonialCollectionFactory = $testimonialCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getTotalCount()
    {
        return $this->testimonialCollectionFactory->create()->getSize();
    }

    public function getApprovedCount()
    {
        return $this->testimonialCollectionFactory->create()
            ->addFieldToFilter('status', ['eq' => 1])
            ->getSize();
    }

    public function getPendingCount()
    {
        return $this->testimonialCollectionFactory->create()
            ->addFieldToFilter('status', ['eq' => 0])
            ->getSize();
    }

    public function getRejectedCount()
    {
        return $this->testimonialCollectionFactory->create()
            ->addFieldToFilter('status', ['eq' => 2])
            ->getSize();
    }

    public function getAverageRating()
    {
        $testimonials = $this->testimonialCollectionFactory->create();
        $totalRating = 0;
        $count = 0;

        foreach ($testimonials as $testimonial) {
            if ($testimonial->getRating()) {
                $totalRating += $testimonial->getRating();
                $count++;
            }
        }

        return $count ? round($totalRating / $count, 2) : 0;
    }
}
