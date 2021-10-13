<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param Request $request
     * @return array
     */
    protected function getData(Request $request): array
    {
        $content = json_decode($request->getContent(), true);
        $data = [];
        foreach($content as $fieldName=>$fieldValue) {
            $this->cleanJotFormFieldName($fieldName);
            if (in_array($fieldName, array_keys($this->rules)))
                $data[$fieldName] = $fieldValue;
        }

        return $data;
    }

    /**
     * @param string $fieldName
     */
    protected function cleanJotFormFieldName(string &$fieldName)
    {
        $fieldName = preg_replace("/.+?_/", '', $fieldName);
    }
}
