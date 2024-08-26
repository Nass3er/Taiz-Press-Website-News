<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Trait\UploadImage;
use App\Http\Trait\UploadVideo;
use App\Http\Trait\UploadPdf;
use App\Models\Category;
use App\Models\Post;
use App\Models\Image;
use App\Models\Tag;
use App\Models\PostTranslation;
use App\Models\CategoryTranslation;
use Illuminate\Http\Request;
use \Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DataTables;

class PostsController extends Controller
{

    use UploadImage;
    use UploadVideo;
    use UploadPdf;
    protected $postmodel;

    public function __construct(Post $post) {
        $this->postmodel = $post;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('dashboard.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        if (count($categories)>0) {    // عشان اذا مافيش معنا اقسام ماينفع نضيف بوست
            return view('dashboard.posts.add' , compact('categories'));
        }
        abort(404);
       
    }


    public function getPostsDatatable()
    {
        $data = Post::whereHas('translations')
             ->select('*')
             ->with('category')
             ->get();
 
        return  Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                if(auth()->user()->can('update', $row)){
                return $btn = '
                        <a href="' . Route('dashboard.posts.edit', $row->id) . '"  class="edit btn btn-success btn-sm" style="margin-bottom:3px;" ><i class="fa fa-edit"></i></a>
                        <a id="deleteBtn" data-id="' . $row->id . '" class="edit btn btn-danger btn-sm"  data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i></a>';
                }else{
                    return;
                }
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


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->authorize('create', $this->postmodel);
       
        $thumbnailPath=null;
        if($request->thumbnails !==null){
            $decodedString = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->thumbnails));
            $thumbname = uniqid() . '.webp';
            // Specify the path where you want to save the image
            $thumbnailPath = 'thumbnails/' . $thumbname;
              // Save the decoded binary data to a file
            file_put_contents(public_path($thumbnailPath), $decodedString);
        }
        
            if ($request->ar['title'] === null || $request->ar['content'] === null ) {
                // Handle the case where some Arabic fields are null
                return back()->withErrors(['arabic_fields' => 'حقل العنوان والوصف مطلوب']);
            } else {
                // Arabic fields are not null, proceed with create
                try {
                     // Start a database transaction
                    DB::beginTransaction();
                    $post = Post::create($request->except('images', '_token'));
                    
                    $post->update(['user_id' => auth()->user()->id]);
            
                    $category = CategoryTranslation::where('category_id',  $post->category_id) // get the category name
                                          ->where('locale', 'en')  
                                           ->first();

                    if ($request->hasFile('images')) {
                        foreach ($request->file('images') as $file) {
                            $mimeType = $file->getMimeType();
                            $extension = $file->getClientOriginalExtension(); // Get original extension
                          
                            if (Str::startsWith($mimeType, 'image/')) {
                                // if($file->getSize() > 2 * 1024 * 1024){
                                //     return back()->withErrors(['image_size' => 'حجم الصورة يجب الا يزيد عن 2 ميجا' ]);
                                // }
                                // Image file:
                              
                                $path = $this->uploadImage($file, $category->title); // dd($path);
                                $post->images()->create(['filename' => $path]);
                                
                            } elseif (Str::startsWith($mimeType, 'video/')) {
                                if ($file->getSize() > 50 * 1024 * 1024) {
                                    return back()->withErrors(['video_size' => 'حجم الفيديو يجب الا يزيد عن 50 جيجا']);
                                }
                                // Video file: 
                                $path = $this->upload_video($file, $category->title);
                                // dd($path['thumbnail']);
                                $post->images()->create([
                                    'filename' => $path['video'],
                                    'thumbnail' => $thumbnailPath ?? null,
                                ]);

                             }
                            //  elseif (Str::startsWith($mimeType, 'application/pdf')) {
                            //     if ($file->getSize() > 10 * 1024 * 1024) {
                            //         return back()->withErrors(['pdf_size' => 'حجم الملف يجب الا يزيد عن 10 جيجا']);
                            //     }
                            //     // PDF file:
                            //     $path = $this->upload_pdf($file, $category->title); // Upload as PDF
                            //     $post->images()->create(['filename' => $path]);
                            // } 
                            else {
                                return back()->withErrors(['file_extention' => 'تنسيق هذا الملف غير مدعوم ']);
                            }
                    
                        }
                    }else{
                        $post->images()->create(['filename' => null]);  // this for create null row im Image table 
                    }
        
                    foreach (config('app.languages') as $key => $lang) {
                       
                        // If it's the Arabic language and English fields have default values, copy Arabic data to them
                        if ($key === 'ar' &&
                        ($request->en['title'] === 'post title' ||  empty($request->en['title']) ) &&
                        ($request->en['content'] === 'post content' ||  empty($request->en['content'])) &&
                        ($request->en['smallDesc'] === 'post description' ||  empty($request->en['smallDesc']))
                         ) {
                        
                            PostTranslation::where('post_id', $post->id)->where('locale', 'en')->update([
                                'title' => $request->$key['title'],
                                'content' => $request->$key['content'],
                                'smallDesc' => $request->$key['smallDesc'],
                            ]);
                        }
        
                        $slug = $request->$key['title'] ;
                        PostTranslation::where('post_id', $post->id)->where('locale', $key)->update([
                            'slug' => Str::slug($slug),
                        ]);
                    }
        
                   
                    // Commit the transaction if everything is successful
                    DB::commit();
            
                    return redirect()->route('dashboard.posts.index')->with('success', trans('words.successfully'));
                } catch (\Exception $e) {
                    // An error occurred, rollback the transaction
                    DB::rollback();
                    throw $e;
                }
            }
        
      
    }

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update' , $post);
        $categories = Category::all();
       return view('dashboard.posts.edit' , compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
    $this->authorize('update', $post);

    $thumbnailPath=null;
    if($request->thumbnails !==null){
        $decodedString = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->thumbnails));
        $thumbname = uniqid() . '.webp';
        // Specify the path where you want to save the image
        $thumbnailPath = 'thumbnails/' . $thumbname; 
          
        //   delete the old thumnail
        if($post->images->first()->thumbnail){
            $this->deleteLastFile($post->images->first()->thumbnail);
        }
        // Save the decoded binary data to a file
        file_put_contents(public_path($thumbnailPath), $decodedString); 
    }

    if ($request->ar['title'] === null || $request->ar['content'] === null ) {
        // Handle the case where some Arabic fields are null
        return back()->withErrors(['arabic_fields' => 'حقل العنوان والوصف مطلوب']);
    } else {
        DB::beginTransaction();

    try {
    $post->update($request->except('images', '_token'));
    $post->update(['user_id' => auth()->user()->id]);

    $category = CategoryTranslation::where('category_id',  $post->category_id) // get the category name
    ->where('locale', 'en')  
     ->first();

    // if ($request->hasFile('images')) {
    //     // Delete existing images associated with the post
    //     $post->images()->delete();

    //     foreach ($request->file('images') as $image) {
    //         $path = $this->upload($image,$category->title);
    //         $post->images()->update(['filename' => $path]);
    //     }
    // }

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            $mimeType = $file->getMimeType();
            $extension = $file->getClientOriginalExtension(); // Get original extension
          
            if (Str::startsWith($mimeType, 'image/')) {
                // if($file->getSize() > 2 * 1024 * 1024){
                //     return back()->withErrors(['image_size' => 'حجم الصورة يجب الا يزيد عن 2 ميجا' ]);
                // }
                // Image file:
                foreach ($post->images as $image) {   // delete the old images from folder
                    if($image->filename !== NULL){
                        $this->deleteLastFile($image->filename);
                    }
                 }  
                $path = $this->uploadImage($file, $category->title);
                $post->images()->update(['filename' => $path]);
            } elseif (Str::startsWith($mimeType, 'video/')) {
                if ($file->getSize() > 50 * 1024 * 1024) {
                    return back()->withErrors(['video_size' => 'حجم الفيديو يجب الا يزيد عن 50 جيجا']);
                }
                // Video file: 
                foreach ($post->images as $image) {   // delete the old video from folder
                    if($image->filename !== NULL){
                        $this->deleteLastFile($image->filename);
                    }
                 }  
                $path = $this->upload_video($file, $category->title);
                $post->images()->update([
                    'filename' => $path['video'],
                    'thumbnail' => $thumbnailPath ?? null,
                ]);

            } 
            // elseif (Str::startsWith($mimeType, 'application/pdf')) {
            //     if ($file->getSize() > 10 * 1024 * 1024) {
            //         return back()->withErrors(['pdf_size' => 'حجم الملف يجب الا يزيد عن 10 جيجا']);
            //     }
            //     // PDF file:
            //     $path = $this->upload_pdf($file, $category->title); // Upload as PDF
            //     $post->images()->update(['filename' => $path]);
            // } 
            else {
                return back()->withErrors(['file_extention' => 'تنسيق هذا الملف غير مدعوم ']);
            }
    
        }
    }

    foreach(config('app.languages') as $key =>$lang){

         // If it's the Arabic language and English fields have default values, copy Arabic data to them
         if ($key === 'ar' &&
         ($request->en['title'] === 'post title' ||  empty($request->en['title']) ) &&
         ($request->en['content'] === 'post content' ||  empty($request->en['content'])) &&
         ($request->en['smallDesc'] === 'post description' ||  empty($request->en['smallDesc']))
          ) {
         
             PostTranslation::where('post_id', $post->id)->where('locale', 'en')->update([
                 'title' => $request->$key['title'],
                 'content' => $request->$key['content'],
                 'smallDesc' => $request->$key['smallDesc'],
             ]);
         }
         
        $slug=$request->$key['title'];
        PostTranslation::where('post_id',$post->id)->where('locale',$key)->update([
            'slug'=>Str::slug($slug),
        ]);
    }

    // Commit the transaction if everything is successful
    DB::commit();


    return redirect()->route('dashboard.posts.index', $post)->with('success', trans('words.successfully'));
   } catch (\Exception $e) {
    // An error occurred, rollback the transaction
    DB::rollback();

    // Optionally handle or log the error

    // Rethrow the exception to let Laravel handle it
    throw $e;
  }
    }

    
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function delete(Request $request)
    {
        $this->authorize('delete', $this->postmodel->find($request->id));
    
        $post = Post::findOrFail($request->id);
        // $category= CategoryTranslation::where('category_id', $post->category_id)->where('locale', 'en')->value('title');
        // // Delete the post images from the folder
        // foreach ($post->images as $image) {
        //     $this->deleteLastFile($category . '/' .$image->filename);
        // }
    
        // Delete the post from the database
        $post->delete();
    
        return redirect()->route('dashboard.posts.index');
    }
    

    ///////for slug     // another way to create slug 
    public function createslug($text){
        return str_replace(' ','-',$text);
    }
    

    ///////
    public function deleteLastFile($filepath)
    {
        $path = public_path($filepath);
        if (file_exists($path)) {
            unlink($path);
        }
    }

    public function uploadfromckeditor(){
        
    }


    ///// for test //////
    public function upload(){
        echo 'hello uploaded';
    }

    
}
