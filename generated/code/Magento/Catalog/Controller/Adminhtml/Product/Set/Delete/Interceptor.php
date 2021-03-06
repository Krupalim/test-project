<?php
namespace Magento\Catalog\Controller\Adminhtml\Product\Set\Delete;

/**
 * Interceptor class for @see \Magento\Catalog\Controller\Adminhtml\Product\Set\Delete
 */
class Interceptor extends \Magento\Catalog\Controller\Adminhtml\Product\Set\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry, \Magento\Eav\Api\AttributeSetRepositoryInterface $attributeSetRepository)
    {
        $this->___init();
        parent::__construct($context, $coreRegistry, $attributeSetRepository);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }
}
