<?php

namespace App\core\form;

use App\core\Model;

class Form {

    public static function begin($action, $method) {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end() {
        echo '</form>';
    }

    public function field(Model $model, $attribute) {
        return new Field($model, $attribute);
    }

    // public function textarea(Model $model, $attribute) {
    //     return new TextareaField($model, $attribute);
    // }

    // public function select(Model $model, $attribute, $options) {
    //     return new SelectField($model, $attribute, $options);
    // }

    // public function submit($label) {
    //     return new SubmitButton($label);
    // }
}