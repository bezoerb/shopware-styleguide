<?php

use Styleguide\Struct\Component;

/**
 * Add code snippet for template include
 *
 * @param $params
 * @param \Enlight_Template_Default $template
 * @return bool|mixed|string
 */
function smarty_function_styleguide_include($params, $template)
{
    if (empty($params['file'])) {
        return false;
    }

    $params = array_merge([
        'styleguide-preview' => true,
        'styleguide-doc' => true,
        'styleguide-html' => false,
        'styleguide-smarty' => true,
        'assign' => false,
    ], $params);

    $assign = $params['assign'];
    $showPreview = $params['styleguide-preview'];
    $showDoc = $params['styleguide-doc'];
    $showHtml = $params['styleguide-html'];
    $showSmarty = $params['styleguide-smarty'];

    if ($params['file'] instanceof Component) {
        $input = $params['file']->getFile();
    } else {
        $input = $params['file'];
    }

    unset($params['file']);
    unset($params['styleguide-preview']);
    unset($params['styleguide-doc']);
    unset($params['styleguide-html']);
    unset($params['styleguide-smarty']);


    // params for output tpl
    $templateParams = [];

    // prepare smarty output
    if ($showSmarty) {
        $includeParams = [];
        foreach ($params as $key => $value) {
            if (is_string($value)) {
                $includeParams[] = $key.'="'.$value.'"';
            } elseif (is_numeric($value)) {
                $includeParams[] = $key.'='.$value;
            } else {
                $includeParams[] = $key.'=$'.$key;
            }
        }
        $templateParams['source'] = sprintf('{include file="%s" %s}', $input, implode(' ', $includeParams));
    }

    // prepare preview output
    if ($showPreview || $showHtml) {
        $template->assign($params);
        if ($data = trim($template->fetch($input))) {
            if ($showPreview) {
                $templateParams['preview'] = $data;
            }

            if ($showHtml) {
                $templateParams['html'] = htmlentities($data);;
            }
        }
    }

    if ($showDoc) {
        $template->smarty->loadPlugin('smarty_function_styleguide_doc');
        $templateParams['description'] = smarty_function_styleguide_doc(['file' => $input], $template);
    }

    $renderer = clone $template;
    $renderer->clearAllAssign();
    $renderer->assign($templateParams);
    $result = trim($renderer->fetch('frontend/styleguide/component.tpl'));

    if (!empty($assign)) {
        $template->assign($assign, $result);
        return '';
    } else {
        return $result;
    }
}
