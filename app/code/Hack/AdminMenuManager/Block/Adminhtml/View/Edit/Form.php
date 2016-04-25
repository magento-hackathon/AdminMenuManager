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

        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'title' => __('Title'),
                'required' => false,
            ]
        );

        $fieldset->addField(
            'icon',
            'file',
            [
                'name' => 'icon',
                'label' => __('Icon'),
                'title' => __('Icon'),
                'required' => false,
                'class' => 'input-file'
            ]
        );

        $fieldset->addField(
            'sort_order',
            'text',
            [
                'name' => 'sort_order',
                'label' => __('Sort order'),
                'title' => __('Sort order'),
                'required' => false,
            ]
        );

        $form->setValues($this->getAction()->getData())->addFieldNameSuffix('action')->setUseContainer(true);

        $this->setForm($form);
        return parent::_prepareForm();
    }
}
