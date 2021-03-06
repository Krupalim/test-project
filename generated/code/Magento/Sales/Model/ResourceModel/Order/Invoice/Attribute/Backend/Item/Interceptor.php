<?php
namespace Magento\Sales\Model\ResourceModel\Order\Invoice\Attribute\Backend\Item;

/**
 * Interceptor class for @see \Magento\Sales\Model\ResourceModel\Order\Invoice\Attribute\Backend\Item
 */
class Interceptor extends \Magento\Sales\Model\ResourceModel\Order\Invoice\Attribute\Backend\Item implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct()
    {
        $this->___init();
    }

    /**
     * {@inheritdoc}
     */
    public function validate($object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'validate');
        return $pluginInfo ? $this->___callPlugins('validate', func_get_args(), $pluginInfo) : parent::validate($object);
    }
}
