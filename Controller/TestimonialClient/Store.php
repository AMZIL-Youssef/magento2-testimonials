<?php
declare(strict_types=1);

namespace Sda\Testimonials\Controller\TestimonialClient;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Sda\Testimonials\Model\TestimonialFactory;
use Sda\Testimonials\Model\ResourceModel\Testimonial as TestimonialResource;

class Store extends Action
{
    protected $jsonFactory;
    protected $testimonialFactory;
    protected $testimonialResource;

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        TestimonialFactory $testimonialFactory,
        TestimonialResource $testimonialResource
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->testimonialFactory = $testimonialFactory;
        $this->testimonialResource = $testimonialResource;
    }

    public function execute()
    {
        $result = $this->jsonFactory->create();
        $data = $this->getRequest()->getPostValue();

        if (empty($data)) {
            return $result->setData(['success' => false, 'message' => __('Submission error')]);
        }

        try {
            $testimonial = $this->testimonialFactory->create();
            $testimonial->setData([
                'name'    => $data['name'] ?? '',
                'email'   => $data['email'] ?? '',
                'rating'  => (int)($data['rating'] ?? 0),
                'comment' => $data['comment'] ?? '',
                'status'  => 0
            ]);
            $this->testimonialResource->save($testimonial);

            return $result->setData(['success' => true, 'message' => __('Testimonial submitted successfully')]);
        } catch (\Exception $e) {
            return $result->setData(['success' => false, 'message' => __('Error: %1', $e->getMessage())]);
        }
    }
}