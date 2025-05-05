<?php
namespace Sda\Testimonials\Controller\Adminhtml\TestimonialAdmin;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Sda\Testimonials\Model\TestimonialFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class Delete extends Action
{
    const ADMIN_RESOURCE = 'Sda_Testimonials::testimonials';

    /** @var TestimonialFactory */
    private $testimonialFactory;

    /** @var JsonFactory */
    private $resultJsonFactory;

    public function __construct(Context $context, TestimonialFactory $testimonialFactory, JsonFactory $resultJsonFactory ) {
        parent::__construct($context);
        $this->testimonialFactory = $testimonialFactory;
        $this->resultJsonFactory = $resultJsonFactory;
    }

    public function execute()
    {
        $id = (int)$this->getRequest()->getParam('id');

        try {
            $testimonial = $this->testimonialFactory->create()->load($id);
            if (!$testimonial->getId()) {
                throw new NoSuchEntityException(__('No testimonial with ID %1', $id));
            }
            $testimonial->delete();

            /** @var \Magento\Framework\Controller\Result\Json $json */
            $json = $this->resultJsonFactory->create();
            return $json->setData([
                'success' => true,
                'message' => __('Testimonial deleted successfully.')
            ]);
        } catch (\Exception $e) {
            $json = $this->resultJsonFactory->create();
            return $json->setData([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
