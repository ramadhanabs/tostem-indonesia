<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Project;
use App\Http\Response\PublicResponse;

use Litepie\Theme\ThemeAndViews;
use Litepie\User\Traits\RoutesAndGuards;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    use ThemeAndViews, RoutesAndGuards;

    public function __construct()
    {
        $this->response = app(PublicResponse::class);
        $this->setTheme('admin');
    }
    public function index()
    {
        $project = Project::all();

        return $this->response
            ->setMetaKeyword("Project")
            ->setMetaDescription("")
            ->setMetaTitle("Project")
            ->layout('user')
            ->view('project.index')
            ->data(['project' => $project])
            ->output();
    }

    public function create()
    {
        return $this->response
            ->setMetaKeyword("Project")
            ->setMetaDescription("")
            ->setMetaTitle("Project")
            ->layout('user')
            ->view('project.create')
            ->output();
    }

    public function store(Request $request)
    {
        $project = new Project;
        $project->category = $request['category'];
        $project->name = $request['name'];
        $project->url_name = $this->create_slug(strtolower($request['name']));
        $project->client = $request['client'];
        $project->year = $request['year'];
        $project->location = $request['location'];
        $project->content = $request['content'];
        $project->user_id = 1;
        $project->feature_image = $this->imageSave($request->file('feature_image'));;
        $project->save();
        return redirect()->route('admin.project.index');
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

    public function uploadimage(Request $request)
    {
        echo "https://www.tostemindonesia.com/public/".$this->imageSave($request->file('image'));;
    }

    public function deleteimage(Request $request)
    {
        $src = $request['src'];
        $file_name = str_replace('https://tostemindonesia.com/', '', $src);
        if(unlink($file_name))
        {
            echo 'File Delete Successfully';
        }
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
