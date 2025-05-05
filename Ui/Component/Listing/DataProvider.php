<?php
declare(strict_types=1);

namespace Sda\Testimonials\Ui\Component\Listing;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Sda\Testimonials\Model\ResourceModel\Testimonial\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var \Sda\Testimonials\Model\ResourceModel\Testimonial\Collection
     */
    protected $collection;

    /**
     * @var array|null
     */
    protected $loadedData;

    /**
     * @param string            $name
     * @param string            $primaryFieldName
     * @param string            $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array             $meta
     * @param array             $data
     */
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }

    /**
     * Load and return data in the format UI expects.
     *
     * @return array
     */
    public function getData(): array
    {
        if ($this->loadedData !== null) {
            return $this->loadedData;
        }

        $items = [];
        foreach ($this->collection as $testimonial) {
            $items[] = $testimonial->getData();
        }

        $this->loadedData = [
            'totalRecords' => $this->collection->getSize(),
            'items'        => $items,
        ];

        return $this->loadedData;
    }
}
