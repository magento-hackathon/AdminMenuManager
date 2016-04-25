<?php
namespace  Hack\AdminMenuManager\Helper;

class Action extends \Magento\Framework\App\Helper\AbstractHelper   implements \Magento\Framework\Data\OptionSourceInterface {
    const ACTION_CREATE = 1;
    const ACTION_MOVE = 2;
    const ACTION_RENAME = 3;
    const ACTION_HIDE = 4;

    public function getOptions()
    {
        $res = [];

        $res[] = ['value' => self::ACTION_CREATE, 'label' => 'Create'];
        $res[] = ['value' => self::ACTION_MOVE, 'label' => 'Move'];
        $res[] = ['value' => self::ACTION_RENAME, 'label' => 'Rename'];
        $res[] = ['value' => self::ACTION_HIDE, 'label' => 'Hide'];

        return $res;
    }

    public function toOptionArray()
    {
        return $this->getOptions();
    }
}
