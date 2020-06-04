<?php
namespace Shellpea\MultiSelect\Model\Attribute\Frontend;

class Material extends \Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend
{
    public function getValue(\Magento\Framework\DataObject $object)
    {
        $result = "";
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        $options = $this->getOption($value);
        if (is_array($options) == true) {
            foreach ($options as $option) {
                $result = $result . '<li>' . $option . '</li>';
            }
        } else {
            $result = $options;
        }
        
        return '<ul>' . $result . '</ul>';
    }
}
