<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Shop;
use App\Models\User;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Product;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Products/Services';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('shop_id', __('Shop Name'))->display(function($shop_id){
            return Shop::find($shop_id)->name;
        });
        $grid->column('description', __('Description'))->display(function($description){
            return substr($description, 0, 20).'...';
        });
        $grid->column('unit_price', __('Unit price'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('featured_image', __('Featured image'))->image(
            '',
            50,
            50);
        $grid->column('category_id', __('Category'))->display(function($category_id){
            if (Category::find($category_id) == null) {
                return '';
            }
            return Category::find($category_id)->name;
        });
        $grid->column('user_id', __('User'))->display(function($user_id){
            return User::find($user_id)->name;
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
        $grid->column('service', __('Service'))->display(function($service){
            return $service == 1 ? 'Service' : 'Product';
        });
        $grid->column('tags', __('Tags'));

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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('shop_id', __('Shop id'));
        $show->field('description', __('Description'));
        $show->field('unit_price', __('Unit price'));
        $show->field('slug', __('Slug'));
        $show->field('status', __('Status'));
        $show->field('featured_image', __('Featured image'));
        $show->field('quantity', __('Quantity'));
        $show->field('category_id', __('Category id'));
        $show->field('user_id', __('User id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));
        $show->field('service', __('Service'));
        $show->field('search_index', __('Search index'));
        $show->field('views', __('Views'));
        $show->field('tags', __('Tags'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product());

        $form->text('name', __('Name'));
        $form->number('shop_id', __('Shop id'));
        $form->textarea('description', __('Description'));
        $form->number('unit_price', __('Unit price'));
        $form->text('slug', __('Slug'));
        $form->switch('status', __('Status'));
        $form->text('featured_image', __('Featured image'));
        $form->number('quantity', __('Quantity'));
        $form->number('category_id', __('Category id'));
        $form->number('user_id', __('User id'));
        $form->switch('service', __('Service'));
        $form->textarea('search_index', __('Search index'));
        $form->number('views', __('Views'));
        $form->textarea('tags', __('Tags'));

        return $form;
    }
}
