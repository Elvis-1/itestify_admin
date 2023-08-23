<?php

namespace App\Admin\Controllers;

use App\Models\WrittenTestimony;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WrittenTestimonyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'WrittenTestimony';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WrittenTestimony());
        $grid->column('title','Title');
        $grid->column('testimony','Testimony');
        $grid->column('categories_id','Category')->display(function($id){
            $categories = Category::where('id',$id)->first()->category;

             return $categories??'';});
        $grid->column('users_id','User')->display(function($id){
           $users = User::where('id',$id)->first();

            return $users->user_name;
        });


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
        $show = new Show(WrittenTestimony::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new WrittenTestimony());

        $users = User::pluck('user_name','id');
        $categories = Category::pluck('category','id');

        $form->select('users_id','Users')->options($users);
        $form->select('categories_id','Category')->options($categories);

        $form->text('title','Title')->required();
        $form->textarea('testimony','Your Testimony')->rows(5);




        return $form;
    }
}
