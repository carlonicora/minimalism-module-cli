<?php
namespace carlonicora\minimalism\modules\cli;

use carlonicora\minimalism\core\bootstrapper;
use carlonicora\minimalism\core\modules\abstracts\controllers\abstractController;
use Exception;
use Throwable;

class CController extends abstractController {
    /**
     * @return string
     */
    public function render(): string {
        try {
            $this->model->preRender();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $this->model->run();

        if (bootstrapper::$servicesCache !== null){
            file_put_contents(bootstrapper::$servicesCache, serialize($this->services));
        }

        return '';
    }

    /**
     * @param array $parameterValueList
     * @param array $parameterValues
     * @throws Exception
     */
    protected function initialiseParameters(array $parameterValueList, array $parameterValues): void {
        if (isset($_SERVER['argv'][1]) && !isset($_SERVER['argv'][2])){
            $this->passedParameters = json_decode($_SERVER['argv'][1], true, 512, JSON_THROW_ON_ERROR);
        } elseif (count($_SERVER['argv']) > 1){
            for ($argumentCount = 1, $argumentCountMax = count($_SERVER['argv']); $argumentCount < $argumentCountMax; $argumentCount += 2){
                $this->passedParameters[substr($_SERVER['argv'][$argumentCount], 1)] = $_SERVER['argv'][$argumentCount + 1];
            }
        }
    }

    /**
     * @param Throwable $e
     * @param string $httpStatusCode
     */
    public function writeException(Throwable $e, string $httpStatusCode = '500'): void {
        echo $e->getMessage();
    }
}