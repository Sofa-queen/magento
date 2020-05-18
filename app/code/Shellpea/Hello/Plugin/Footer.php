<?php
namespace Shellpea\Hello\Plugin;

class Footer
{
    public function aroundGetCopyright($name)
    {
        $name = "“Customized copyright!”";
        return  $name ;
    }
}
