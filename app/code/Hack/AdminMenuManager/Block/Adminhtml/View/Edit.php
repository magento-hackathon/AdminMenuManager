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
     * @var \Hack\AdminMenuManager\Model\Action
     */
    protected $_action;

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
     * @param \Hack\AdminMenuManager\Model\Action $action
     */
    public function setAction(\Hack\AdminMenuManager\Model\Action $action)
    {
        $this->_action = $action;
    }

    /**
     * Getter
     *
     * @return \Hack\AdminMenuManager\Model\Action
     */
    public function getAction()
    {
        return $this->_action;
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
        if (!$this->getAction()->getId()) {
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
            ->setAction($this->getAction());
        return $this->getChildHtml('form');
    }

    /**
     * Return translated header text depending on creating/editing action
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->getAction()->getId()) {
            return __('Admin Menu Action "%1"', $this->escapeHtml($this->getAction()->getId()));
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
