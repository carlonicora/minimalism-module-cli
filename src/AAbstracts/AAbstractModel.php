<?php
namespace carlonicora\minimalism\modules\cli\abstracts;

abstract class AAbstractModel extends \carlonicora\minimalism\core\modules\abstracts\models\abstractModel {
    /**
     * @return bool
     */
    abstract public function run(): bool;
}