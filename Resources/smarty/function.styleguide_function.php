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
    if (empty($params['function'])) {
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
    $functionName = $params['function'];
    $function = 'smarty_function_'.$params['function'];

    unset($params['assign']);
    unset($params['function']);
    unset($params['styleguide-preview']);
    unset($params['styleguide-doc']);
    unset($params['styleguide-html']);
    unset($params['styleguide-smarty']);

    $template->smarty->loadPlugin($function);

    // params for output tpl
    $templateParams = [];

    // prepare smarty output
    if ($showSmarty) {
        $includeParams = [$function];
        foreach ($params as $key => $value) {
            if (is_string($value)) {
                $includeParams[] = $key.'="'.$value.'"';
            } elseif (is_numeric($value)) {
                $includeParams[] = $key.'='.$value;
            } else {
                $includeParams[] = $key.'=$'.$key;
            }
        }
        $templateParams['source'] = sprintf('{%s}', implode(' ', $includeParams));
    }



    // prepare preview output
    if ($showPreview || $showHtml) {
        $html = $function($params, $template);
        if ($showPreview) {
            $templateParams['preview'] = trim($html);
        }

        if ($showHtml) {
            $templateParams['html'] = htmlentities(trim($html));
        }
    }

    if ($showDoc) {
        // Fetch documentation from reflection
        $refFunc = new ReflectionFunction($function);
        $doc = $refFunc->getDocComment();


        $template->smarty->loadPlugin('smarty_function_styleguide_doc');
        $templateParams['description'] = smarty_function_styleguide_doc(['source' => $doc], $template);




        /*
         * Get file based on Smarty.class.php loadPlugin
         */
        // Plugin name is expected to be: Smarty_[Type]_[Name]
//        $_plugin_filename = 'function.'.$functionName.'.php';
//        $_stream_resolve_include_path = function_exists('stream_resolve_include_path');
//
//        $docFile = '';
//
//        // loop through plugin dirs and find the plugin
//        foreach($template->smarty->getPluginsDir() as $_plugin_dir) {
//            $names = array(
//                $_plugin_dir . $_plugin_filename,
//                $_plugin_dir . strtolower($_plugin_filename),
//            );
//            foreach ($names as $file) {
//                if (file_exists($file)) {
//                    $docFile = $file;
//                    break(2);
//                }
//
//                if ($template->smarty->use_include_path && !preg_match('/^([\/\\\\]|[a-zA-Z]:[\/\\\\])/', $_plugin_dir)) {
//                    // try PHP include_path
//                    if ($_stream_resolve_include_path) {
//                        $file = stream_resolve_include_path($file);
//                    } else {
//                        $file = Smarty_Internal_Get_Include_Path::getIncludePath($file);
//                    }
//
//                    if ($file !== false) {
//                        $docFile = $file;
//                        break(2);
//                    }
//                }
//            }
//        }
//
//        $template->smarty->loadPlugin('smarty_function_styleguide_doc');
//        $templateParams['description'] = smarty_function_styleguide_doc(['source' => $docFile], $template);
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
