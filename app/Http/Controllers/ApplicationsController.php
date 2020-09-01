<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Application;

class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $applications = Application::orderBy('created_at','DESC')->get();
        $applications = Application::orderBy('created_at','DESC')->paginate(10);
        
        return view('website.applications.index',['applications' => $applications]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userIndex()
    {
        // $applications = auth()->user()->applications()->orderBy('created_at','DESC')->get();
        $applications = auth()->user()->applications()->orderBy('created_at','DESC')->paginate(10);
        
        return view('website.applications.index',['applications' => $applications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('developer.applications.create', ['application' => new Application]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'user_id' => 'required',
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required',
            'description' => 'required'
        ]);

        // Check if file exists and move it to the destination path
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            //$name = time().'.'.$image->getClientOriginalExtension();
            $pattern = '[\W+]'; // Regex expression. Matches Non-Word caracter or blank spaces to 1
            $name = isset($request->name) ? preg_replace($pattern, '_', $request->name).'.'.$image->getClientOriginalExtension() : preg_replace($pattern, '_', $application->name).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/img/applications');
            $image->move($destinationPath, $name);
            //$image->save();   // save() only for new class instances, not for a file.
        }

        Application::create([
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'name' => $request->name,
            'image' => 'img/applications/'.$name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        // \Session::flash('alert-success', 'App created successfully !!!');

        return redirect()->back()->with('alert-success', 'App created successfully !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $application = Application::find($id);
        
        return view('website.applications.show',['application' => $application]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $application = Application::findOrFail($id);
        
        return view('developer.applications.edit',['application' => $application]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $application = Application::findOrFail($id);

        $image_path = public_path($application->image); // Application image url
        $destinationPath = public_path('/img/applications');   // New destiny image route

        // dd(str_contains($image_path, 'img/applications') ? 'local':'public');
        // dd(File::exists($image_path) ? 'local':'public');

        // Verifies if the file exists and then moves to the destiny route
        if ($request->hasFile('image')) {

            // If a new image sends ($request), verifies if the old file exists and deletes it
            if (File::exists($image_path)) {
                //File::delete($image_path);
                unlink($image_path);
            }

            $image = $request->file('image');
            
            $pattern = '[\W+]'; // Regex expression. Matches Non-Word caracter or blank spaces to 1
            $name = isset($request->name) ? preg_replace($pattern, '_', $request->name).'.'.$image->getClientOriginalExtension() : preg_replace($pattern, '_', $application->name).'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath, $name);
            //$image->save();   // save() only for new class instances, not for a file.
        
            // Updates ALL the values through $request and then changes the image route
            $application->update($request->all());
            $application->image = 'img/applications/'.$name;   // The DB name of the url
            $application->save();

        } else {
            
            if(isset($request->name)) {
                // if there is no new image, but the application name is changed, rename the image
                if ($request->name != $application->name) {

                    // Check if the image path is local or public
                    if(File::exists($image_path)) {
                        $pattern = '[\W+]'; // Regex expression. Matches Non-Word caracter or blank spaces to 1
                        $name = preg_replace($pattern, '_', $request->name);
    
                        $extension = pathinfo($image_path, PATHINFO_EXTENSION);
                        // move() Rename the old file for the new one
                        File::move($image_path, $destinationPath.'/'.$name.'.'.$extension);
                        // Updates the DB with the new url
                        $application->image = 'img/applications/'.$name.'.'.$extension;
                        $application->save();
                    }

                }
            }
          
            $application->update($request->all());
        }

        // \Session::flash('alert-warning', 'App edited successfully !!!');

        return redirect()->back()->with('alert-warning', 'App edited successfully !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $application = Application::findOrFail($id);
        
        if ($application->image != null) {

            $image_path = public_path($application->image);

            // Verifies if exists the image and erase it
            if (File::exists($image_path)) {
                //File::delete($image_path);
                unlink($image_path);
            }
        }

        $application->delete();

        // \Session::flash('alert-danger', 'App removed successfully !!!');

        return redirect('/me/apps')->with('alert-danger', 'App removed successfully !!!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ordered()
    {
        $applications = Application::orderedApps()->orderBy('created_at','DESC')->paginate(10);
       
        return view('website.applications.index',['applications' => $applications]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function voted()
    {
        $applications = Application::votedApps()->paginate(10);

        return view('website.applications.index',['applications' => $applications]);
    }
}
