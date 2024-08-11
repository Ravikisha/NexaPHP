<?php

namespace ravikisha\nexaphp\form;

use ravikisha\nexaphp\Model;

class Field extends BaseField
{

    public Model $model;
    public string $attribute;
    public string $type;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = 'text';
        parent::__construct($model, $attribute);
    }


    public function renderInput()
    {
        return sprintf('<input type="%s" class="form-control%s" name="%s" value="%s">',
            $this->type,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->attribute,
            $this->model->{$this->attribute},
        );
    }

    public function passwordField()
    {
        $this->type = 'password';
        return $this;
    }

    public function emailField()
    {
        $this->type = 'email';
        return $this;
    }

    public function textField()
    {
        $this->type = 'text';
        return $this;
    }

    public function textareaField()
    {
        $this->type = 'textarea';
        return $this;
    }

    public function selectField($options)
    {
        $this->type = 'select';
        return $this;
    }

    public function radioField()
    {
        $this->type = 'radio';
        return $this;
    }

    public function checkboxField()
    {
        $this->type = 'checkbox';
        return $this;
    }

    public function submitField()
    {
        $this->type = 'submit';
        return $this;
    }

    public function fileField()
    {
        $this->type = 'file';
        return $this;
    }

    public function numberField()
    {
        $this->type = 'number';
        return $this;
    }

    public function dateField()
    {
        $this->type = 'date';
        return $this;
    }

    public function timeField()
    {
        $this->type = 'time';
        return $this;
    }

    public function datetimeField()
    {
        $this->type = 'datetime-local';
        return $this;
    }

    public function monthField()
    {
        $this->type = 'month';
        return $this;
    }

    public function weekField()
    {
        $this->type = 'week';
        return $this;
    }

    public function rangeField()
    {
        $this->type = 'range';
        return $this;
    }

    public function colorField()
    {
        $this->type = 'color';
        return $this;
    }

    public function telField()
    {
        $this->type = 'tel';
        return $this;
    }

    public function urlField()
    {
        $this->type = 'url';
        return $this;
    }

    public function searchField()
    {
        $this->type = 'search';
        return $this;
    }

    public function hiddenField()
    {
        $this->type = 'hidden';
        return $this;
    }

    public function resetField()
    {
        $this->type = 'reset';
        return $this;
    }

    public function buttonField()
    {
        $this->type = 'button';
        return $this;
    }

    public function imageField()
    {
        $this->type = 'image';
        return $this;
    }
}
