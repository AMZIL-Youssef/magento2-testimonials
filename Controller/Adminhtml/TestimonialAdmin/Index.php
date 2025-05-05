<?php
namespace Sda\Testimonials\Controller\Adminhtml\TestimonialAdmin;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Sda_Testimonials::testimonial_root');
        $resultPage->addBreadcrumb(__('Testimonials'), __('Testimonials'));
        $resultPage->getConfig()->getTitle()->prepend(__('Customer Testimonials'));
        return $resultPage;
    }
}