<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\CatalogUrlRewrite\Test\Unit\Model\Category\Plugin;

use Magento\CatalogUrlRewrite\Model\Category\Plugin\Storage as CategoryStoragePlugin;
use Magento\CatalogUrlRewrite\Model\Category\Product;
use Magento\CatalogUrlRewrite\Model\ResourceModel\Category\Product as ProductResourceModel;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\UrlRewrite\Model\StorageInterface;
use Magento\UrlRewrite\Model\UrlFinderInterface;
use Magento\UrlRewrite\Service\V1\Data\UrlRewrite;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class StorageTest extends TestCase
{
    /**
     * @var CategoryStoragePlugin
     */
    private $plugin;

    /**
     * @var UrlFinderInterface|MockObject
     */
    private $urlFinder;

    /**
     * @var StorageInterface|MockObject
     */
    private $storage;

    /**
     * @var Product|MockObject
     */
    private $product;

    /**
     * @var ProductResourceModel|MockObject
     */
    private $productResourceModel;

    /**
     * @var UrlRewrite|MockObject
     */
    private $urlRewrite;

    protected function setUp(): void
    {
        $this->storage = $this->getMockBuilder(StorageInterface::class)
            ->getMockForAbstractClass();
        $this->urlFinder = $this->getMockBuilder(UrlFinderInterface::class)
            ->getMockForAbstractClass();
        $this->product = $this->getMockBuilder(Product::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->productResourceModel = $this->getMockBuilder(ProductResourceModel::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->urlRewrite = $this->getMockBuilder(UrlRewrite::class)
            ->disableOriginalConstructor()
            ->setMethods(['getMetadata', 'getEntityType', 'getIsAutogenerated', 'getUrlRewriteId', 'getEntityId'])
            ->getMock();

        $this->plugin = (new ObjectManager($this))->getObject(
            CategoryStoragePlugin::class,
            [
                'urlFinder' => $this->urlFinder,
                'productResource' => $this->productResourceModel
            ]
        );
    }

    /**
     * test AfterReplace method
     */
    public function testAfterReplace()
    {
        $this->urlRewrite->expects(static::any())->method('getMetadata')->willReturn(['category_id' => '5']);
        $this->urlRewrite->expects(static::once())->method('getEntityTYpe')->willReturn('product');
        $this->urlRewrite->expects(static::once())->method('getIsAutogenerated')->willReturn(1);
        $this->urlRewrite->expects(static::once())->method('getUrlRewriteId')->willReturn('4');
        $this->urlRewrite->expects(static::once())->method('getEntityId')->willReturn('2');
        $this->urlRewrite->setData('request_path', 'test');
        $this->urlRewrite->setData('store_id', '1');
        $productUrls = ['targetPath' => $this->urlRewrite];

        $this->urlFinder->expects(static::once())->method('findAllByData')->willReturn([$this->urlRewrite]);

        $this->productResourceModel->expects(static::once())->method('saveMultiple')->willReturnSelf();

        $this->plugin->afterReplace($this->storage, $productUrls, $productUrls);
    }

    /**
     * test BeforeDeleteByData method
     */
    public function testBeforeDeleteByData()
    {
        $data = [1, 2, 3];
        $this->productResourceModel->expects(static::once())
            ->method('removeMultipleByProductCategory')
            ->with($data)->willReturnSelf();
        $this->plugin->beforeDeleteByData($this->storage, $data);
    }
}