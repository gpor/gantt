<?php

namespace Gpor\Gantt;


class GporBase {

    public function __set($name, $val)
    {
        $classname = get_class($this);
        throw new \Exception("trying to set {$classname}->$name to '$val' but `$name` is not a property");
    }

    public function defaultTemplate()
    {
        return 'default';
    }

    public function __toString()
    {
        return $this->templated('templates/' . $this->defaultTemplate() . '.php');
    }

    public function templated($template)
    {
        ob_start();
        include($template);
        return ob_get_clean();
    }
}