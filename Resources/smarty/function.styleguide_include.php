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
        'preview'   => true,
        'doc'       => true,
        'html'      => true,
        'smarty'    => true,
        'arguments' => [],
        'assign'    => false,
        'grid'      => '',
        'align'      => '',
        'justify'      => '',
    ], $params);

    if ($params['file'] instanceof Component) {
        $input = $params['file']->getFile();
    } else {
        $input = $params['file'];
    }

    // check for single arguments array and make an array of argument arrays
    $arguments = $params['arguments'];
    if (array_values($arguments) !== $arguments || !count($arguments)) {
        $arguments = [$arguments];
    }

    // params for output tpl
    $templateParams = ['grid' => $params['grid'], 'align' => $params['align'], 'justify' => $params['justify']];

    // prepare smarty output
    if ($params['smarty']) {
        $includeParams = [];
        $templateParams['source'] = [];
        foreach ($arguments as $index => $args) {
            $includeParams[$index] = [];
            foreach ($args as $key => $value) {
                if ($key == 'assign') {
                    continue;
                }
                if (is_string($value)) {
                    $includeParams[$index][] = $key.'="'.$value.'"';
                } elseif (is_numeric($value)) {
                    $includeParams[$index][] = $key.'='.$value;
                } elseif (is_array($value)) {
                    $val = var_export($value, true);
                    $val = preg_replace('/array\s*\(\s*/', '[', $val);
                    $val = preg_replace('/\s*,\s*\)/', ']', $val);

                    $keys = array_keys($value);
                    if (array_keys($keys) == $keys) {
                        $val = preg_replace('/\d+\s*=>\s*/', '', $val);
                    }
                    $includeParams[$index][] = $key.'='.$val;
                } else {
                    $includeParams[$index][] = $key.'=$'.$key;
                }
            }

            $templateParams['source'][] = sprintf(
                '{include file="%s" %s}',
                $input,
                implode(' ', $includeParams[$index])
            );
        }
    }

    // prepare preview output
    if ($params['preview'] || $params['html']) {
        $templateParams['preview'] = [];
        $templateParams['html'] = [];
        foreach ($arguments as $index => $args) {
            $renderer = clone $template;
            $renderer->clearAllAssign();
            $renderer->assign($args);

            try {
                $data = trim($renderer->fetch($input));
            } catch (\Exception $e) {
                $data = 'Error: '.$e->getMessage();
            }

            if ($data && $params['preview']) {
                $templateParams['preview'][] = trim($data);
            }

            if ($data && $params['html']) {
                $markup = htmlentities(trim($data));
                $templateParams['html'][] = $markup;
            }
        }
    }

    if ($params['doc']) {
        try {
            $template->smarty->loadPlugin('smarty_function_styleguide_doc');
            $templateParams['description'] = smarty_function_styleguide_doc(['file' => $input], $template);
        } catch (\SmartyException $e) {
            $templateParams['description'] = 'Error: '.$e->getMessage();
        }

    }


    try {
        $renderer = clone $template;
        $renderer->clearAllAssign();
        $renderer->assign($templateParams);
        $result = trim($renderer->fetch('frontend/styleguide/component.tpl'));
    } catch (\Exception $e) {
        $result = 'Error: '.$e->getMessage();
    }

    if (!empty($params['assign'])) {
        $template->assign($params['assign'], $result);
        return '';
    } else {
        return $result;
    }
}
