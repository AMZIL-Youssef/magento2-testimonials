<?php
namespace Sda\Testimonials\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class ToggleActions extends Column
{
    const URL_PATH_UPDATE = 'testimonial/testimonialadmin/updatestatus';
    const URL_PATH_DELETE = 'testimonial/testimonialadmin/delete';

    /** @var UrlInterface */
    private $urlBuilder;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (!empty($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $id         = $item['testimonial_id'];
                $approveUrl = $this->urlBuilder->getUrl(self::URL_PATH_UPDATE, ['id' => $id, 'status' => 1]);
                $rejectUrl  = $this->urlBuilder->getUrl(self::URL_PATH_UPDATE, ['id' => $id, 'status' => 2]);
                $deleteUrl  = $this->urlBuilder->getUrl(self::URL_PATH_DELETE, ['id' => $id]);

                $item['actions'] = sprintf(
                    '<button class="action-approve" data-action="approve" data-url="%1$s" title="%2$s">✔</button>
                     <button class="action-reject"  data-action="reject"  data-url="%3$s" title="%4$s">✘</button>
                     <button class="action-delete"  data-action="delete"  data-url="%5$s" title="%6$s">Delete</button>',
                    $approveUrl,
                    __('Approuver'),
                    $rejectUrl,
                    __('Rejeter'),
                    $deleteUrl,
                    __('Supprimer')
                );
                
            }
        }
        return $dataSource;
    }
}
