<?php

use OpenAdmin\Admin\Facades\Admin;

/**
 * Open-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * OpenAdmin\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * OpenAdmin\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Admin::js('/js/admin.js');
Admin::js('/vendor/chartjs/dist/chart.js');
OpenAdmin\Admin\Form::forget(['editor']);

