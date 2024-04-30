<?php

namespace App\Admin\Controllers;

use App\Models\Region;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Town;

class TownsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Town';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Town());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('region_id', __('Region'))->display(function($region_id){
            return Region::find($region_id)->name;
        });
        $grid->column('created_at', __('Created at'))->display(
            function ($created_at) {
                return date('D dS M Y');
            }
        );
        $grid->column('updated_at', __('Updated at'))->display(
            function ($updated_at) {
                return date('D dS M Y');
            }
        );

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Town::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('region_id', __('Region id'));
        $show->field('name', __('Name'));
        $show->field('status', __('Status'));
        $show->field('deleted_at', __('Deleted at'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Town());

        $form->number('region_id', __('Region id'));
        $form->text('name', __('Name'));
        $form->switch('status', __('Status'));

        return $form;
    }
}
