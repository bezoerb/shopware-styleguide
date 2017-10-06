<?php
/**
 * Smarty plugin to format text blocks
 *
 * @package Smarty
 * @subpackage PluginsBlock
 */

/**
 * Smarty {styleguide_markup}{/styleguide_markup} block plugin
 *
 * Type:     block function<br>
 * Name:     styleguide<br>
 * Purpose:  format code for the styleguide<br>
 * Params:
 * <pre>
 * - style         - string (email)
 * - indent        - integer (0)
 * - wrap          - integer (80)
 * - wrap_char     - string ("\n")
 * - indent_char   - string (" ")
 * - wrap_boundary - boolean (true)
 * </pre>
 *
 * @param array                    $params   parameters
 * @param string                   $content  contents of the block
 * @param Smarty_Internal_Template $template template object
 * @return string content re-formatted
 * @author Monte Ohrt <monte at ohrt dot com>
 */
function smarty_block_styleguide_html($params, $content, $template)
{
    if (is_null($content)) {
        return '';
    }

    $params = array_merge([
        'styleguide-preview' => true,
        'styleguide-doc' => true,
        'styleguide-html' => true,
        'assign' => false,
    ], $params);

    $assign = $params['assign'];
    $showPreview = $params['styleguide-preview'];
    $showDoc = $params['styleguide-doc'];
    $showHtml = $params['styleguide-html'];

    unset($params['assign']);
    unset($params['styleguide-preview']);
    unset($params['styleguide-doc']);
    unset($params['styleguide-html']);

    $template->smarty->loadPlugin('smarty_function_styleguide_doc');

    // params for output tpl (smarty is not possible here as it
    // gets parsed before the content is passed in here
    $templateParams = ['source' => ''];

    // strip comment bloc
    if (preg_match('/^\s*<!--\s*([\S\s]*)-->/U', $content, $matches)) {
        $content = str_replace($matches[0], '', $content);

        if ($showDoc) {
            $templateParams['description'] = smarty_function_styleguide_doc(['source' => $matches[0]], $template);
        }
    }

    if ($showPreview) {
        $templateParams['preview'] = trim($content);
    }

    if ($showHtml) {
        $templateParams['html'] = trim(htmlentities($content));
    }

    $renderer = clone $template;
    $renderer->clearAllAssign();
    $renderer->assign($templateParams);
    $result = trim($renderer->fetch('frontend/styleguide/component.tpl'));

    if ($assign) {
        $template->assign($assign, $result);
        return '';
    } else {
        return $result;
    }
}