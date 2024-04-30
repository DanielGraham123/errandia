<?php

namespace App\Admin\Controllers;

use App\Models\Region;
use App\Models\Town;
use App\Models\User;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Errand;

class ErrandController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Errand';

    protected $with = ['user','town'];

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Errand());

        $grid->column('id', __('Id'));
        $grid->column('user_id', __('User'))->display(function($user_id){
            return User::find($user_id)->name;
        });
        $grid->column('title', __('Title'));
        $grid->column('description', __('Description'))->display(function($description){
            return substr($description, 0, 20).'...';
        });
        $grid->column('region_id', __('Region'))->display(function($region_id){
            if (Region::find($region_id) == null) {
                return '';
            }
            return Region::find($region_id)->name;
        });
        $grid->column('town_id', __('Town'))->display(function($town_id){
             if (Town::find($town_id) == null) {
                 return '';
             }

            return Town::find($town_id)->name;
        });
        $grid->column('status', __('Status'))->display(function($status){
            return $status == 1 ? 'Active' : 'Inactive';
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
        $show = new Show(Errand::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('title', __('Title'));
        $show->field('description', __('Description'));
        $show->field('slug', __('Slug'));
        $show->field('sub_categories', __('Sub categories'));
        $show->field('read_status', __('Read status'));
        $show->field('region_id', __('Region id'));
        $show->field('town_id', __('Town id'));
        $show->field('street_id', __('Street id'));
        $show->field('visibility', __('Visibility'));
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
        $form = new Form(new Errand());

        $form->number('user_id', __('User id'));
        $form->text('title', __('Title'));
        $form->textarea('description', __('Description'));
        $form->text('slug', __('Slug'));
        $form->text('sub_categories', __('Sub categories'));
        $form->switch('read_status', __('Read status'));
        $form->number('region_id', __('Region id'));
        $form->number('town_id', __('Town id'));
        $form->number('street_id', __('Street id'));
        $form->text('visibility', __('Visibility'));
        $form->switch('status', __('Status'));

        return $form;
    }
}
