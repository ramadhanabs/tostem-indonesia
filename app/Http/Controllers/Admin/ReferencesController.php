<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\References;
use App\Http\Response\PublicResponse;

use Litepie\Theme\ThemeAndViews;
use Litepie\User\Traits\RoutesAndGuards;
use Illuminate\Http\Request;

class ReferencesController extends Controller
{

    use ThemeAndViews, RoutesAndGuards;

    public function __construct()
    {
        $this->response = app(PublicResponse::class);
        $this->setTheme('admin');
    }
    public function index()
    {
        $references = References::all();

        return $this->response
            ->setMetaKeyword("Reference")
            ->setMetaDescription("")
            ->setMetaTitle("Reference")
            ->layout('user')
            ->view('references.index')
            ->data(['references' => $references])
            ->output();
    }

    public function create()
    {
        return $this->response
            ->setMetaKeyword("References")
            ->setMetaDescription("")
            ->setMetaTitle("References")
            ->layout('user')
            ->view('project.create')
            ->output();
    }

    public function store(Request $request)
    {
        $project = new References;
        $project->id_references_category = $request['category'];
        $project->judul_references = $request['name'];
        $project->url_references = $this->create_slug(strtolower($request['name']));
        $project->client = $request['client'];
        $project->year = $request['year'];
        $project->location = $request['location'];
        $project->desc_references = $request['content'];
        $project->user_id = 1;
        $project->feature_image = $this->imageSave($request->file('feature_image'));;
        $project->save();
        return redirect()->route('admin.references.index');
    }

    public function edit($id)
    {
        $project = Project::find($id);
        return $this->response
            ->setMetaKeyword("Project")
            ->setMetaDescription("")
            ->setMetaTitle("Project")
            ->layout('user')
            ->data(['project' => $project])
            ->view('project.edit')
            ->output();
    }

    public function update($id, Request $request)
    {
        $project = Project::find($id);
        $project->category = $request['category'];
        $project->name = $request['name'];
        $project->url_name = $this->create_slug(strtolower($request['name']));
        $project->client = $request['client'];
        $project->year = $request['year'];
        $project->location = $request['location'];
        $project->content = $request['content'];
        $project->user_id = 1;
        $project->feature_image = $this->imageUpdate($request->file('feature_image'), $project->feature_image);;
        $project->save();
        return redirect()->route('admin.project.index');
    }

    private function imageUpdate($req_file, $model_val)
    {
        if ($file = $req_file) {
            $name = $file->getClientOriginalName();
            $images_name = $name . time() . '.' . $file->extension();
            $file->move(public_path('images/project/'), $images_name);
            return 'images/project/' . $images_name;
        } else {
            return $model_val;
        }
    }

    public function delete($id)
    {
        $project = Project::find($id);
        $project->delete();
        return redirect()->route('admin.project.index');
    }


    private function imageSave($req_file)
    {
        if ($file = $req_file) {
            $name = $file->getClientOriginalName();
            $images_name = $name . time() . '.' . $file->extension();
            $file->move(public_path('images/project/'), $images_name);
            return 'images/project/' . $images_name;
        } else {
            return "";
        }
    }

    private function create_slug($string)
    {
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
        return $slug;
    }
}
