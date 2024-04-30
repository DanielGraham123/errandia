<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Region;
use App\Models\Town;
use App\Models\User;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Shop;

class ShopsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Shop';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Shop());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'))->display(function($description){
            return substr($description, 0, 20).'...';
        });
        $grid->column('user_id', __('User'))->display(function($user_id){
            return User::find($user_id)->name;
        });
        $grid->column('category_id', __('Category'))->display(function($category_id){
            return Category::find($category_id)->name;
        });
        $grid->column('image_path', __('Image'))->image(
            '',
            50,
            50

        );
        $grid->column('phone_verified', __('Verified'))->display(function($phone_verified){
            return $phone_verified == 1 ? 'Verified' : 'Not Verified';
        });
        $grid->column('region_id', __('Region'))->display(function($region_id){
            if (Region::find($region_id) == null) {
                return '';
            }
            return Region::find($region_id)->name;
        });
        $grid->column('town_id', __('Town id'))->display(function($town_id){
            if (Town::find($town_id) == null) {
                return '';
            }
            return Town::find($town_id)->name;
        });
        $grid->column('slogan', __('Slogan'))->display(function($slogan){
            return substr($slogan, 0, 30).'...';
        });
        $grid->column('street', __('Street'));

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
        $show = new Show(Shop::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('user_id', __('User id'));
        $show->field('category_id', __('Category id'));
        $show->field('image_path', __('Image path'));
        $show->field('status', __('Status'));
        $show->field('is_branch', __('Is branch'));
        $show->field('parent_id', __('Parent id'));
        $show->field('parent_slug', __('Parent slug'));
        $show->field('slug', __('Slug'));
        $show->field('region_id', __('Region id'));
        $show->field('town_id', __('Town id'));
        $show->field('slogan', __('Slogan'));
        $show->field('street', __('Street'));
        $show->field('phone_verified', __('Phone verified'));
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
        $form = new Form(new Shop());

        $form->text('name', __('Name'));
        $form->text('description', __('Description'));
        $form->number('user_id', __('User id'));
        $form->number('category_id', __('Category id'));
        $form->text('image_path', __('Image path'));
        $form->switch('status', __('Status'));
        $form->switch('is_branch', __('Is branch'));
        $form->number('parent_id', __('Parent id'));
        $form->text('parent_slug', __('Parent slug'));
        $form->text('slug', __('Slug'));
        $form->number('region_id', __('Region id'));
        $form->number('town_id', __('Town id'));
        $form->text('slogan', __('Slogan'));
        $form->text('street', __('Street'));
        $form->switch('phone_verified', __('Phone verified'));

        return $form;
    }
}
