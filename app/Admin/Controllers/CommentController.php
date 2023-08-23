<?php

namespace App\Admin\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\VideoTestimony;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CommentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Comment';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Comment());


        $grid->column('comment','Comment');
        $grid->column('video_testimonies_id','Video Title')->display(function($id){
            $testimony = VideoTestimony::where('id',$id)->first()->title;

             return $testimony??'';});
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
        $show = new Show(Comment::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Comment());
        $users = User::pluck('user_name','id');
        $vid = VideoTestimony::pluck('title','id');

        $form->select('users_id','Users')->options($users);
        $form->select('video_testimonies_id','Video Testimony Title')->options($vid);


        $form->textarea('comment','Your Comment')->rows(5);


        return $form;
    }
}
