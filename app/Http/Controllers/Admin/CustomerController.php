<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Response\PublicResponse;

use Litepie\Theme\ThemeAndViews;
use Litepie\User\Traits\RoutesAndGuards;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::all();
        return $this->response
            ->setMetaKeyword("Customer")
            ->setMetaDescription("")
            ->setMetaTitle("Customer")
            ->layout('user')
            ->view('customer.index')
            ->data(['customer' => $customer])
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
            ->setMetaKeyword("Blog")
            ->setMetaDescription("")
            ->setMetaTitle("Blog")
            ->layout('user')
            ->view('blog.create')

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
        $blog = new Blog;
        $blog->title = $request['title'];
        $blog->id_lang    =   1;
        $blog->slug = $this->create_slug($request['title']);
        $blog->description = $request['description'];
        $blog->meta_recomendation = $request['recomendation'];
        $blog->images = $this->imageSave($request->file('images'));
        $blog->save();
        $insertedId = $blog->id;

        $blogEN = new Blog;
        $blogEN->id_blog    =   $insertedId;
        $blogEN->id_lang    =   2;
        $blogEN->title = $request['titleEN'];
        $blogEN->slug = $this->create_slug($request['titleEN']);
        $blogEN->description = $request['descriptionEN'];
        $blogEN->meta_recomendation = $request['recomendationEN'];
        $blogEN->images = $this->imageSave($request->file('imagesEn'));
        $blogEN->save();

        $blog = Blog::find($insertedId);
        $blog->id_blog  = $insertedId;
        $blog->save();

        return redirect()->route('admin.blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        return $this->response
            ->setMetaKeyword("Blog")
            ->setMetaDescription("")
            ->setMetaTitle("Blog")
            ->layout('user')
            ->data(['blog' => $blog])
            ->view('blog.edit')
            ->output();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $blog = Blog::find($id);
        $blog->title  = $request['title'];
        $blog->slug   = $this->create_slug($request['title']);
        $blog->description = $request['description'];
        $blog->meta_recomendation = $request['meta_recomendation'];
        $blog->images = $this->imageUpdate($request->file('images'), $blog->images);;
        $blog->save();
        return redirect()->route('admin.blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $project = Blog::find($id);
        $project->delete();
        return redirect()->route('admin.blog.index');
    }


    private function imageSave($req_file)
    {
        if ($file = $req_file) {
            $name = $file->getClientOriginalName();
            $images_name = $name . time() . '.' . $file->extension();
            $file->move(public_path('images/blog/'), $images_name);
            return 'images/blog/' . $images_name;
        } else {
            return "";
        }
    }

    private function imageUpdate($req_file, $model_val)
    {
        if ($file = $req_file) {
            $name = $file->getClientOriginalName();
            $images_name = $name . time() . '.' . $file->extension();
            $file->move(public_path('images/blog/'), $images_name);
            return 'images/blog/' . $images_name;
        } else {
            return $model_val;
        }
    }


    private function create_slug($string)
    {
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
        return $slug;
    }
}
