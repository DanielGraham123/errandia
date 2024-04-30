<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\User;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Users';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('photo', __('Photo'))->image(
            '',
            50,
            50
        );
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('phone', __('Phone'));
        $grid->column('phone_country_code', __('Country code'));
        $grid->column('whatsapp_number', __('Whatsapp number'));
        $grid->column('address', __('Address'));
        $grid->column('google_id', __('Google id'));
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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('phone', __('Phone'));
        $show->field('phone_country_code', __('Phone country code'));
        $show->field('photo', __('Photo'));
        $show->field('active', __('Active'));
        $show->field('address', __('Address'));
        $show->field('street_id', __('Street id'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
        $show->field('google_id', __('Google id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('whatsapp_number', __('Whatsapp number'));
        $show->field('deleted', __('Deleted'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->phonenumber('phone', __('Phone'));
        $form->text('phone_country_code', __('Phone country code'));
        $form->text('photo', __('Photo'));
        $form->switch('active', __('Active'));
        $form->text('address', __('Address'));
        $form->number('street_id', __('Street id'));
        $form->number('email_verified_at', __('Email verified at'));
        $form->password('password', __('Password'));
        $form->text('remember_token', __('Remember token'));
        $form->text('google_id', __('Google id'));
        $form->text('whatsapp_number', __('Whatsapp number'));
        $form->switch('deleted', __('Deleted'));

        return $form;
    }
}
