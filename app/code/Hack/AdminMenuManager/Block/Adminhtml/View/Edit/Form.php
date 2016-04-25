<?php
namespace Hack\AdminMenuManager\Block\Adminhtml\View\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Hack\AdminMenuManager\Helper\Action
     */
    protected $_actionValues;

    /**
     * @var \Hack\AdminMenuManager\Helper\TargetType
     */
    protected $_targetTypeValues;

    /**
     * @var  \Magento\Backend\Model\Menu\Builder
     */
    protected $_builder;

    /**
     * @var \Magento\Backend\Model\Menu\Config
     */
    protected $_menuConfig;

    /**
     * @param \Hack\AdminMenuManager\Helper\Action $actionValues
     * @param \Hack\AdminMenuManager\Helper\TargetType $targetTypeValues
     * @param \Magento\Backend\Model\Menu\Builder $builder
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        \Hack\AdminMenuManager\Helper\Action $actionValues,
        \Hack\AdminMenuManager\Helper\TargetType $targetTypeValues,
        \Magento\Backend\Model\Menu\Builder $builder,
        \Magento\Backend\Model\Menu\Config $menuConfig,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
        $this->_actionValues = $actionValues;
        $this->_targetTypeValues = $targetTypeValues;
        $this->_builder = $builder;
        $this->_menuConfig = $menuConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     *
     */
    protected function _construct(){
        parent::_construct();
        $this->setId('amm_action');
    }
    /**
     * Getter
     *
     * @return \Hack\AdminMenuManager\Model\Action
     */
    public function getAction()
    {
        return $this->_coreRegistry->registry('current_amm_action');
    }

    protected function _getSourceTree()
    {
        $menu = $this->_menuConfig->getMenu();
        $result = $this->_builder->getResult($menu);

        return array();
    }

    /**
     * Prepare form before rendering HTML
     *
     * @return \Magento\Variable\Block\System\Variable\Edit\Form
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('amm_');

        $fieldset = $form->addFieldset('base', ['legend' => __('Action'), 'class' => 'fieldset-wide']);

        $fieldset->addField(
            'mapping',
            'select',
            [
                'name' => 'mapping',
                'label' => __('Mapping'),
                'title' => __('Mapping'),
                'required' => true,
                'values' => $this->_actionValues->getOptions()
            ]
        );

        $fieldset->addField(
            'target_type',
            'select',
            [
                'name' => 'target_type',
                'label' => __('Target Type'),
                'title' => __('Target Type'),
                'required' => true,
                'values' => $this->_targetTypeValues->getOptions()
            ]
        );

        $fieldset->addField(
            'source',
            'select',
            [
                'name' => 'source',
                'label' => __('Source'),
                'title' => __('Source'),
                'required' => true,
                'values' => $this->_getSourceTree()
            ]
        );

        $fieldset->addField(
            'target',
            'select',
            [
                'name' => 'target',
                'label' => __('Target'),
                'title' => __('Target'),
                'required' => true,
                'values' => array()
            ]
        );

        $useDefault = false;
        if ($this->getAction()->getId() && $this->getAction()->getStoreId()) {
            $useDefault = !(bool)$this->getAction()->getStoreHtmlValue();
            $this->getAction()->setUseDefaultValue((int)$useDefault);
            $fieldset->addField(
                'use_default_value',
                'select',
                [
                    'name' => 'use_default_value',
                    'label' => __('Use Default Variable Values'),
                    'title' => __('Use Default Variable Values'),
                    'onchange' => 'toggleValueElement(this);',
                    'values' => [0 => __('No'), 1 => __('Yes')]
                ]
            );
        }

        $fieldset->addField(
            'html_value',
            'textarea',
            [
                'name' => 'html_value',
                'label' => __('Variable HTML Value'),
                'title' => __('Variable HTML Value'),
                'disabled' => $useDefault
            ]
        );

        $fieldset->addField(
            'plain_value',
            'textarea',
            [
                'name' => 'plain_value',
                'label' => __('Variable Plain Value'),
                'title' => __('Variable Plain Value'),
                'disabled' => $useDefault
            ]
        );

        $form->setValues($this->getAction()->getData())->addFieldNameSuffix('action')->setUseContainer(true);

        $this->setForm($form);
        return parent::_prepareForm();
    }
}
