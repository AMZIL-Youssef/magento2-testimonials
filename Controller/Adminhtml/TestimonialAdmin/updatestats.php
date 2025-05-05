<?php
namespace Sda\Testimonials\Controller\Adminhtml\TestimonialAdmin;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Sda\Testimonials\Model\ResourceModel\Testimonial\CollectionFactory;

class Updatestats extends Action
{
    /** @var CollectionFactory */
    private $collectionFactory;

    /** @var JsonFactory */
    private $resultJsonFactory;

    public function __construct(Context $context, CollectionFactory $collectionFactory, JsonFactory $resultJsonFactory) {
        parent::__construct($context);
        $this->collectionFactory   = $collectionFactory;
        $this->resultJsonFactory   = $resultJsonFactory;
    }

    public function execute()
    {

        $data = [
            'total'    => $this->collectionFactory->create()->getSize(),
            'approved' => $this->collectionFactory->create()->addFieldToFilter('status', 1)->getSize(),
            'pending'  => $this->collectionFactory->create()->addFieldToFilter('status', 0)->getSize(),
            'rejected' => $this->collectionFactory->create()->addFieldToFilter('status', 2)->getSize(),
            'average'  => $this->calculateAverage( $this->collectionFactory->create())
        ];
        

        $result = $this->resultJsonFactory->create();
        return $result->setData($data);
    }

    private function calculateAverage($collection)
    {
        $sum   = 0;
        $count = 0;
        foreach ($collection as $item) {
            if ($r = (float)$item->getRating()) {
                $sum   += $r;
                $count++;
            }
        }
        return $count ? round($sum / $count, 2) : 0;
    }
}