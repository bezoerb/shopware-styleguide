<?php

/**
 * Add code snippet for smarty function call
 *
 * @param $params
 * @param \Enlight_Template_Default $template
 * @return bool|mixed|string
 */
function smarty_function_styleguide_function($params, $template)
{
    if (empty($params['name'])) {
        return false;
    }

    $params = array_merge([
        'preview'   => true,
        'doc'       => true,
        'html'      => true,
        'smarty'    => true,
        'variation' => '',
        'arguments' => [],
        'assign'    => false,
        'grid'      => '',
        'align'      => '',
        'justify'      => '',
    ], $params);

    $function = 'smarty_function_'.$params['name'];

    try {
        $template->smarty->loadPlugin($function);
    } catch (\SmartyException $e) {
        return 'Error: '.$e->getMessage();
    }

    // check for single arguments array and make an array of argument arrays
    $arguments = $params['arguments'];
    if (array_values($arguments) !== $arguments) {
        $arguments = [$arguments];
    }

    // params for output tpl
    $templateParams = ['variation' => $params['variation'],'grid' => $params['grid'], 'align' => $params['align'], 'justify' => $params['justify']];

    // prepare smarty output
    if ($params['smarty']) {
        $encoder = new \Riimu\Kit\PHPEncoder\PHPEncoder();
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
                    $val = $encoder->encode($value, [
                        'array.indent' => 2,
                        'array.align' => true,
                    ]);
                    $includeParams[$index][] = $key.'='.$val;
                } else {
                    $includeParams[$index][] = $key.'=$'.$key;
                }
            }

            $tmp = sprintf('{%s}', implode(' ', $includeParams[$index]));
            $templateParams['source'][] = str_replace(' ','&nbsp;',$tmp);
        }
    }

    // prepare preview output
    if ($params['preview'] || $params['html']) {
        $indenter = new \Gajus\Dindent\Indenter(['indentation_character' => '  ']);
        $templateParams['preview'] = [];
        $templateParams['html'] = [];
        foreach ($arguments as $index => $args) {
            try {
                $html = $function($args, $template);
            } catch (\Exception $e) {
                $html = 'Error: '.$e->getMessage();
            }

            if ($html && $params['preview']) {
                $templateParams['preview'][] = trim($html);
            }

            if ($html && $params['html']) {
                $pretty = $indenter->indent(trim($html));
                $markup = htmlentities($pretty);
                $markup = str_replace(' ','&nbsp;',$markup);
                $templateParams['html'][] = $markup;
            }
        }
    }


    if ($params['doc']) {
        try {
            // Fetch documentation from reflection
            $refFunc = new ReflectionFunction($function);
            $doc = $refFunc->getDocComment();
            $template->smarty->loadPlugin('smarty_function_styleguide_doc');
            $templateParams['description'] = smarty_function_styleguide_doc(['source' => $doc], $template);

        } catch (\Exception $e) {
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
