<?php

namespace Neutron\Core\Controller;


use Neutron\Core\Form\ThemeEditor;
use Phpfox\View\ViewModel;

class AdminThemeController extends AdminController
{
    public function actionIndex()
    {
        $request = \Phpfox::get('mvc.request');

        $cmd = $request->get('cmd');
        $id = $request->get('id');

        if ($id) {
            switch ($cmd) {
                case 'default':
                    \Phpfox::get('core.themes')
                        ->setDefault($id);
                    break;
                case 'active':
                    \Phpfox::get('core.themes')
                        ->active($id);
                    break;
                case 'inactive':
                    \Phpfox::get('core.themes')
                        ->inactive($id);
                    break;
                case 'rebuild-main':
                    \Phpfox::get('core.themes')
                        ->rebuildMain($id);
                    break;
                case 'rebuild-files':
                    \Phpfox::get('core.themes')
                        ->rebuildFiles($id);
            }
        }

        $items = \Phpfox::getModel('core_theme')
            ->select('*')
            ->execute()
            ->all();

        $vm = new ViewModel([
            'items' => $items,
        ]);

        $vm->setTemplate('core.admin-theme.index');

        return $vm;
    }

    /**
     * Edit theme
     */
    public function actionEdit()
    {
        $vm = new ViewModel();
        $form = new ThemeEditor();
        $request = \Phpfox::get('mvc.request');
        $id = $request->get('id');


        $params = [];
        $custom = \Phpfox::get('db')
            ->select('*')
            ->from(':core_theme_setting')
            ->where('theme_id=?', $id)
            ->execute()
            ->first();

        if ($custom) {
            $params = json_decode($custom['params'], true);
        }

        $form->populate($params);

        $vm->assign([
            'heading' => '',
            'form'    => $form,
        ]);

        $vm->setTemplate('layout.admin-edit');

        return $vm;
    }

    public function actionDebug()
    {
        $vm = new ViewModel();

        $request = \Phpfox::get('mvc.request');
        $id = $request->get('id');

        $vm->setTemplate('core.admin-theme.debug');

        $themes = \Phpfox::get('core.themes');

        $tempFiles = $themes->getRebuildFiles($id);
        $main = $themes->getMainSource();
        $paths = $themes->getImportPaths($id);
        $variables = $themes->getSassVariables($id);

        $files = [];

        foreach ($tempFiles as $key => $value) {
            $key = str_replace(PHPFOX_DIR, '/', $key);
            $value = str_replace(PHPFOX_DIR, '/', $value);

            $files[$key] = $value;
        }

        foreach ($paths as $index => $value) {
            $paths[$index] = str_replace(PHPFOX_DIR, '/', $value);
        }

        $vm->assign([
            'files'     => $files,
            'main'      => $main,
            'paths'     => $paths,
            'variables' => $variables,
        ]);

        return $vm;
    }
}