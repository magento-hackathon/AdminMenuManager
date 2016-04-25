<?php
namespace  Hack\AdminMenuManager\Helper;

class TargetType extends \Magento\Framework\App\Helper\AbstractHelper   implements \Magento\Framework\Data\OptionSourceInterface {
    const TYPE_HEADING = 0;
    const TYPE_LINK = 1;

    public function getOptions()
    {
        $res = [];

        $res[] = ['value' => self::TYPE_HEADING, 'label' => 'Heading'];
        $res[] = ['value' => self::TYPE_LINK, 'label' => 'Link'];

        return $res;
    }

    public function toOptionArray()
    {
        return $this->getOptions();
    }
}
