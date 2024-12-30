<?php
class CoreFunctionModel 
{
    public function traitColumn($items)
    {
        $content = "";
        for ($i = 1; $i <= count($items); $i++) {
            $content .= ($i == count($items) ? '' : ', ');
            
        }
        return $content;
    }
}