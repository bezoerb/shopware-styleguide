<?php

use Styleguide\Struct\Component;

/**
 * Add code snippet for smarty function call
 *
 * @param $params
 * @param \Enlight_Template_Default $template
 * @return bool|mixed|string
 */
function smarty_function_styleguide_doc($params, $template)
{
    $input = false;
    $doc = '';
    if (isset($params['file']) && $params['file'] instanceof Component) {
        $input = $params['file']->getFile();
    } elseif (isset($params['file'])) {
        $input = $params['file'];
    } elseif (!isset($params['source'])) {
        return '';
    }

    //$searchRegex = '/^(\{\*\*(.*[\r\n])*\s+\*\})/';
    $searchRegex = '/^([\/\{]\*\*([\S\s]*)\s+\*[\/\}])/U';
    $replaceRegex = '/^\s*[\/\{]?\*+\}?\ *\/?(\r\n|\s|\})/m';

    $searchAltRegex = '/^\s*<!--\s*([\S\s]*)-->/U';
    $replaceAltRegex = '/^\ */m';

    $file = '';
    $useIncludePath = $template->smarty->getUseIncludePath();

    if ($input) {
        if (file_exists($input)) {
            $file = $input;
        } else {
            // try to find the file on the filesystem
            foreach ($template->smarty->getTemplateDir() as $dir) {
                if (file_exists($dir . $input)) {
                    $file = Enlight_Loader::realpath($dir) . DS . str_replace('/', DS, $input);
                    break;
                }
                if ($useIncludePath) {
                    if ($dir === '.' . DS) {
                        $dir = '';
                    }
                    if (($check = Enlight_Loader::isReadable($dir . $input)) !== false) {
                        $file = $check;
                        break;
                    }
                }
            }
        }
    }


    if ($file && $raw = trim(file_get_contents($file))) {
        // smarty
        if (preg_match($searchRegex, $raw, $matches)) {
            $doc = preg_replace($replaceRegex, '', $matches[1]);
        }
    } elseif (isset($params['source'])) {
        if (preg_match($searchAltRegex, $params['source'], $matches)) {
            $doc = preg_replace($replaceAltRegex, '', $matches[1]);
        }
        if (preg_match($searchRegex, $params['source'], $matches)) {
            $doc = preg_replace($replaceRegex, '', $matches[1]);
        }
    }


    // remove @returns @param @throws as we only want the description
    $doc = preg_replace('/(^|[\r\n])\s*@param.*($|[\r\n])/m', '$2', $doc);
    $doc = preg_replace('/(^|[\r\n])\s*@return.*($|[\r\n])/m', '$2', $doc);
    $doc = preg_replace('/(^|[\r\n])\s*@throw.*($|[\r\n])/m', '$2', $doc);

    // fix missing line breaks
    $doc = preg_replace('/(\s*[*,-].*[\r\n])(\s*[^\*])/m', '$1'.PHP_EOL.'$2', $doc);


    $parsedown = new Parsedown();
    $compiled = $parsedown->text(trim($doc));

    $result = trim(str_replace('<code>', '<code class="language-smarty">', $compiled));

    if (!empty($assign)) {
        $template->assign($assign, $result);
        return '';
    } else {
        return $result;
    }
}
