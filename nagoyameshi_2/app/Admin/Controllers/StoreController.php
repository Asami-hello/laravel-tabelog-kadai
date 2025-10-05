<?php

namespace App\Admin\Controllers;

use App\Models\Store;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Extensions\Tools\CsvImport;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;
use Illuminate\Http\Request;

class StoreController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Store';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Store());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('category.category_name', __('Category Name'));
        $grid->column('store_name', __('Store name'));
        $grid->column('store_description', __('Store description'));
        $grid->column('address', __('Address'));
        $grid->column('postal_code', __('Postal code'));
        $grid->column('tel', __('Tel'));
        $grid->column('business_hours', __('Business hours'));
        $grid->column('holiday', __('Holiday'));
        $grid->column('price', __('Price'))->sortable();
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function ($filter) {
            $filter->like('store_name', '店舗名');
            $filter->kike('store_description', '店舗紹介');
            $filter->between('price', '価格帯');
            $filter->in('category_id', 'カテゴリー')->multipleSelect(Category::all()->pluck('category_name', 'id'));
        });

        $grid->tools(function ($tools) {
            $tools->append(new CsvImport());
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
        $show = new Show(Store::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('category.category_name', __('Category Name'));
        $show->field('store_name', __('Store name'));
        $show->field('store_description', __('Store description'));
        $show->field('address', __('Address'));
        $show->field('postal_code', __('Postal code'));
        $show->field('tel', __('Tel'));
        $show->field('business_hours', __('Business hours'));
        $show->field('holiday', __('Holiday'));
        $show->field('price', __('Price'));
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
        $form = new Form(new Store());

        $form->select('category_id', __('Category Name'))->options(Category::all()->pluck('category_name', 'id'));
        $form->text('store_name', __('Store name'));
        $form->textarea('store_description', __('Store description'));
        $form->text('address', __('Address'));
        $form->text('postal_code', __('Postal code'));
        $form->text('tel', __('Tel'));
        $form->text('business_hours', __('Business hours'));
        $form->text('holiday', __('Holiday'));
        $form->select('price', __('Price'))->options([
            '500' => '500',
            '1000' => '1,000',
            '1500' => '1,500',
            '2000' => '2,000',
            '2500' => '2,500',
            '3000' => '3,000',
            '3500' => '3,500',
            '4000' => '4,000',
            '4500' => '4,500',
            '5000' => '5,000',
            '5500' => '5,500',
            '6000' => '6,000',
            '6500' => '6,500',
            '7000' => '7,000',
            '7500' => '7,500',
            '8000' => '8,000',
            '8500' => '8,500',
            '9000' => '9,000',
            '9500' => '9,500',
            '10000' => '10,000',
            '15000' => '15,000',
            '20000' => '20,000',
            '30000' => '30,000',
         ]);

        return $form;
    }

    
    public function csvImport(Request $request)
    {
        $file = $request->file('file');
        $lexer_config = new LexerConfig();
        $lexer = new Lexer($lexer_config);

        $interpreter = new Interpreter();
        $interpreter->unstrict();

        $rows = array();
        $interpreter->addObserver(function (array $row) use (&$rows) {
            $rows[] = $row;
        });

        $lexer->parse($file, $interpreter);
        foreach ($rows as $key => $value) {

            if (count($value) == 11) {
                Store::create([
                    'category_id' => $value[1],
                    'store_name' => $value[2],
                    'store_description' => $value[4],
                    'address' => $value[5],
                    'postal_code' => $value[6],
                    'tel' => $value[7],
                    'business_hours' => $value[8],
                    'holiday' => $value[9],
                    'price' => $value[10],
                ]);
            }
        }

        return response()->json(
            ['data' => '成功'],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }
}
