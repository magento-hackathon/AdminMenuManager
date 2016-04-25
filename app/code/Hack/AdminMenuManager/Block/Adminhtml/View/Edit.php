<?php
namespace Hack\AdminMenuManager\Block\Adminhtml\View;

/**
 * Admin Menu Action Edit Container
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var int
     */
    protected $_actionId;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @param mixed $actionId
     */
    public function setActionId($actionId)
    {
        $this->_actionId = $actionId;
    }

    /**
     * Getter
     *
     * @return \Magento\Variable\Model\Variable
     */
    public function getActionId()
    {
        return $this->_actionId;
    }

    /**
     * Internal constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'variable_id';
        $this->_blockGroup = 'Magento_Variable';
        $this->_controller = 'system_variable';

        parent::_construct();
    }

    /**
     * Prepare layout.
     * Adding save_and_continue button
     *
     * @return $this
     */
    protected function _preparelayout()
    {
        $this->addButton(
            'save_and_edit',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form']],
                ]
            ],
            100
        );
        if (!$this->getActionId()) {
            $this->removeButton('delete');
        }
        return parent::_prepareLayout();
    }

    /**
     * @return string
     */
    public function getFormHtml()
    {
        $this->getChildBlock('form')
            ->setData('action', $this->getSaveUrl())
            ->setActionId($this->getActionId());
        return $this->getChildHtml('form');
    }

    /**
     * Return translated header text depending on creating/editing action
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->getActionId()) {
            return __('Admin Menu Action "%1"', $this->escapeHtml($this->getActionId()));
        } else {
            return __('New Admin Menu Action');
        }
    }

    /**
     * Return validation url for edit form
     *
     * @return string
     */
    public function getValidationUrl()
    {
        return $this->getUrl('adminhtml/*/validate', ['_current' => true]);
    }

    /**
     * Return save url for edit form
     *
     * @return string
     */
    public function getSaveUrl()
    {
        return $this->getUrl('adminhtml/*/save', ['_current' => true, 'back' => null]);
    }

    /**
     * Return save and continue url for edit form
     *
     * @return string
     */
    public function getSaveAndContinueUrl()
    {
        return $this->getUrl('adminhtml/*/save', ['_current' => true, 'back' => 'edit']);
    }
}
