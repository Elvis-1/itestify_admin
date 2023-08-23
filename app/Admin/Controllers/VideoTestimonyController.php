<?php

namespace App\Admin\Controllers;

use App\Models\VideoTestimony;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class VideoTestimonyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'VideoTestimony';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new VideoTestimony());

        // get all categories
        $cat = 1;
        // Category::all();
        // $map = [];
        // foreach($ca)
        // dd($categories->video_testimonies);
       $grid->column('id','Id')->sortable();
       $grid->title('Title');
       $grid->description('Description');
       $grid->column('categories_id','Category')->display(function($id){
           // this should be optimized. Querying db repeatedly is not the best for performance
           $categories = Category::find($id)->first()->category;

           return $categories??'';
       });
       $grid->column('thumbnail','Thumbnail')->image('',50,50);


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
        $show = new Show(VideoTestimony::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new VideoTestimony());
        $categories = Category::pluck('category','id');
        $form->select('categories_id','Categories')->options($categories);
        $form->text('title','Title')->required();
        $form->textarea('description','Description')->rows(5);
        $form->file('video_testimonies', 'Video')->uniqueName();
        $form->image('thumbnail','Thumbnail')->uniqueName();



        return $form;
    }
}
