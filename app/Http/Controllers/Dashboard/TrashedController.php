<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\CategoryTranslation;
use DataTables;

class TrashedController extends Controller
{
    protected $postmodel;

    public function __construct(Post $post) {
        $this->postmodel = $post;
    }


    public function index()
    {
       return view('dashboard.trash.index');
    }

    public function getTrashedsDatatable()
    {
        $data = Post::onlyTrashed()
            ->select('*') // You can select specific columns if needed
            ->with('category')
            ->get();
 
         
        return  Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                if (auth()->user()->can('forceDelete', $row) && auth()->user()->can('restore', $row)) {
                    $btns = '
                        <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm" data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>
                        <a href="' . Route('dashboard.trash.restore', $row->id ) . '" class="edit btn btn-success btn-sm" style="margin-bottom:3px;"><i class="fa-solid fa-trash-arrow-up"></i></a>';
                } elseif (auth()->user()->can('forceDelete', $row)) {
                    $btns = '
                        <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm" data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';
                } elseif (auth()->user()->can('restore', $row)) {
                    $btns = '
                        <a href="' . Route('dashboard.trash.restore', $row->id ) . '" class="edit btn btn-success btn-sm" style="margin-bottom:3px;"><i class="fa-solid fa-trash-arrow-up"></i></a>';
                } else {
                    $btns = '';
                }
                
                return $btns;
            })

            ->addColumn('category_name', function ($row) {
                return  $row->category->translate(app()->getLocale())->title;
            })


            ->addColumn('title', function ($row) {
                return $row->translate(app()->getLocale())->title;
            })
             

            ->rawColumns(['action', 'title' , 'category_name'])
            ->make(true);
    }

    public function delete(Request $request)
    {
        $post = Post::onlyTrashed()->find($request->id);
        $this->authorize('forceDelete', $post);
        foreach ($post->images as $image) {
            $this->deleteLastFile($image->filename);
            if ($image->thumbnail) {
                $this->deleteLastFile($image->thumbnail);
            }
        }
        $post->forceDelete();
        return redirect()->back()->with('success', 'تم حذف الخبر بشكل نهائي ');
    }

    public function deleteAll()
    {
        $trashedPosts = Post::onlyTrashed()->get();
      // Authorization (if applicable):
       $trashedPosts->each(function ($post) {
        $this->authorize('forceDelete', $post);
        foreach ($post->images as $image) {
            $this->deleteLastFile($image->filename);
            if ($image->thumbnail) {
                $this->deleteLastFile($image->thumbnail);
            }
        }
        $post->forceDelete();
      });
      return redirect()->back()->with('success', 'تم تصفية سلة المحذوفات بنجاح');
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->find($id);  // Retrieve trashed model
        // Debugging:
         //dd($this->authorize('restore', $post));
    
        $this->authorize('restore', $post);
        $post->restore();
    
        return redirect()->back()->with('success', 'تم استعادة الخير بنجاح');
    }

     

    public function restoreAll()
    {

    }


    public function deleteLastFile($filepath)
    {
        $path = public_path($filepath);
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
