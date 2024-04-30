<?php

namespace App\Admin\Controllers;

use App\Models\Country;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Region;

class RegionsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Region';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Region());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('country_id', __('Country'))->display(function($country_id){
            return Country::find($country_id)->name;
        });
        $grid->column('created_at', __('Created at'))->display(function($created_at){
            return date('D dS M Y');
        });
        $grid->column('updated_at', __('Updated at'))->display(
            function($updated_at){
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
        $show = new Show(Region::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('country_id', __('Country id'));
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
        $form = new Form(new Region());

        $form->number('country_id', __('Country id'));
        $form->text('name', __('Name'));
        $form->switch('status', __('Status'));

        return $form;
    }
}
