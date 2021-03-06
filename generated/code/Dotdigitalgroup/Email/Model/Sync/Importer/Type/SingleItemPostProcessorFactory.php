<?php
namespace Dotdigitalgroup\Email\Model\Sync\Importer\Type;

/**
 * Factory class for @see \Dotdigitalgroup\Email\Model\Sync\Importer\Type\SingleItemPostProcessor
 */
class SingleItemPostProcessorFactory
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Instance name to create
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Factory constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Dotdigitalgroup\\Email\\Model\\Sync\\Importer\\Type\\SingleItemPostProcessor')
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \Dotdigitalgroup\Email\Model\Sync\Importer\Type\SingleItemPostProcessor
     */
    public function create(array $data = [])
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
