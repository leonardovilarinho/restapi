<?php

namespace Objects;


use LegionLab\Rest\Persistence\Object;

class Client extends Object
{
    protected $id, $name, $age;

    public function __construct()
    {
        parent::__construct('clients');
    }

    public function id($id = '@')
    {
        return $this->field($id, 'id', 'numeric|min:0', 'ID inavlid');
    }

    public function name($name = '@')
    {
        return $this->field($name, 'name', 'stringType|length:2:20', 'Name invalid');
    }

    public function age($age = '@')
    {
        return $this->field($age, 'age', 'numeric|length:0:99', 'Age invalid');
    }
}