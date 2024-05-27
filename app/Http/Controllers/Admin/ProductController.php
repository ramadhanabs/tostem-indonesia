<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Response\PublicResponse;
use App\Product;
use Litepie\Theme\ThemeAndViews;
use Litepie\User\Traits\RoutesAndGuards;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use ThemeAndViews, RoutesAndGuards;

    /**
     * Initialize public controller.
     *
     * @return null
     */
    public function __construct()
    {
        $this->response = app(PublicResponse::class);
        $this->setTheme('admin');
    }

    public function index()
    {
        $product = Product::all();
        return $this->response
            ->setMetaKeyword("Product")
            ->setMetaDescription("")
            ->setMetaTitle("Product")
            ->layout('user')
            ->view('product.index')
            ->data(['product' => $product])
            ->output();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->response
            ->setMetaKeyword("Product")
            ->setMetaDescription("")
            ->setMetaTitle("Product")
            ->layout('user')
            ->view('product.create')
            ->output();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $explodeCategory = explode("-",$request['category']);
        $explodeOperation = explode("-",$request['operation']);
        $product = new Product();
        $product->type = $request['type'];
        $product->category = $explodeCategory[0];
        $product->categoryID = $explodeCategory[1];
        $product->operation = $explodeOperation[0];
        $product->operationID = $explodeOperation[1];
        $product->name = $request['name'];
        $product->url_products = preg_replace('/\s+/', '-', strtolower($request['name']));
        $product->description = $request['description'];
        $product->frame_deepth =  $request['frame_deepth'];
        $product->frame_deepth_2 =  $request['frame_deepth_2'];
        $product->glass_thickness =  $request['glass_thickness'];
        $product->height_of_sill =  $request['height_of_sill'];
        $product->height_of_sill_2 =  $request['height_of_sill_2'];
        $product->feature_image = $this->imageSave($request->file('feature_image'));;
        $product->image_1 = $this->imageSave($request->file('image_1'));
        $product->image_2 = $this->imageSave($request->file('image_2'));;
        $product->image_3 = $this->imageSave($request->file('image_3'));;
        $product->image_4 = $this->imageSave($request->file('image_4'));;
        $product->image_5 = $this->imageSave($request->file('image_5'));;
        $product->image_6 = $this->imageSave($request->file('image_6'));;
        $product->save();
        return redirect()->route('admin.product.index');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return $this->response
            ->setMetaKeyword("Product")
            ->setMetaDescription("")
            ->setMetaTitle("Product")
            ->layout('user')
            ->data(['product' => $product])
            ->view('product.edit')
            ->output();
    }

    public function update($id, Request $request)
    {
        $product = Product::find($id);
        $explodeCategory = explode("-",$request['category']);
        $explodeOperation = explode("-",$request['operation']);
        
        $product->type = $request['type'];
        $product->category = $explodeCategory[0];
        $product->categoryID = $explodeCategory[1];
        $product->operation = $explodeOperation[0];
        $product->operationID = $explodeOperation[1];
        $product->name = $request['name'];
        $product->url_products = preg_replace('/\s+/', '-', strtolower($request['name']));
        $product->description = $request['description'];
        $product->frame_deepth =  $request['frame_deepth'];
        $product->frame_deepth_2 =  $request['frame_deepth_2'];
        $product->glass_thickness =  $request['glass_thickness'];
        $product->height_of_sill =  $request['height_of_sill'];
        $product->height_of_sill_2 =  $request['height_of_sill_2'];

        $product->feature_image = $this->imageUpdate($request->file('feature_image'), $product->feature_image);
        $product->image_1 = $this->imageUpdate($request->file('image_1'), $product->image_1);
        $product->image_2 = $this->imageUpdate($request->file('image_2'), $product->image_2);
        $product->image_3 = $this->imageUpdate($request->file('image_3'), $product->image_3);
        $product->image_4 = $this->imageUpdate($request->file('image_4'), $product->image_4);
        $product->image_5 = $this->imageUpdate($request->file('image_5'), $product->image_5);
        $product->image_6 = $this->imageUpdate($request->file('image_6'), $product->image_6);
        $product->save();
        return redirect()->route('admin.product.index');
    }

    public function delete($id)
    {
        $project = Product::find($id);
        $project->delete();
        return redirect()->route('admin.product.index');
    }


    private function imageSave($req_file)
    {
        if ($file = $req_file) {
            $name = $file->getClientOriginalName();
            $images_name = $name . time() . '.' . $file->extension();
            $file->move(public_path('images/product/'), $images_name);
            return 'images/product/' . $images_name;
        } else {
            return "";
        }
    }


    private function imageUpdate($req_file, $model_val)
    {
        if ($file = $req_file) {
            $name = $file->getClientOriginalName();
            $images_name = $name . time() . '.' . $file->extension();
            $file->move(public_path('images/product/'), $images_name);
            return 'images/product/' . $images_name;
        } else {
            return $model_val;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
}
