<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Facades\App\Http\Repositories\LogAdminRepository;
use App\Http\Requests\LogAdmin\LogAdminRequest;
use App\Http\Resources\Backend\LogAdminResource;
use App\Models\LogAdmin;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class LogAdminController extends Controller
{
    public function index()
    {
        $log_admins = LogAdminRepository::paginate(20);
        return Inertia::render('Views/log-admin/Index', [
           'log_admins' => LogAdminResource::collection($log_admins),
           'title' =>  request('trash') ? 'Trash' : 'Log Admin',
           'trash' => request('trash') ?  true : false,
           'breadcumb' => [
             [
                 'text' => 'Dashboard',
                 'url' => route('dashboard'),
             ],
             [
                 'text' => 'Log Admin',
                 'url' => route('log-admin.index')
             ],
           ],
         ]);
    }

    public function show(LogAdmin $log_admin)
    {
        return Inertia::render('Views/log-admin/show', [
           'log_admin' => LogAdminResource::make($log_admin),
           'title' =>  request('trash') ? 'Trash' : 'Log Admin',
           'trash' => request('trash') ?  true : false,
           'breadcumb' => [
             [
                 'text' => 'Dashboard',
                 'url' => route('dashboard'),
             ],
             [
                 'text' => 'Log Admin',
                 'url' => route('log-admin.index')
             ],
           ],
         ]);
    }

    /**
    * create view
    */
    public function create()
    {
        $log_admin = new LogAdmin;
        return Inertia::render('Views/log-admin/form', [
            'log_admin' => $log_admin,
            'method' => 'store',
            'title' => 'Create' ,
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => route('dashboard'),
                ],
                [
                    'text' => 'Log Admin',
                    'url' => route('log-admin.index')
                ],
                [
                    'text' => 'Create Log Admin',
                    'url' => route('log-admin.create')
                ],
            ],
        ]);
    }

    /**
    * store data
    */
    public function store(LogAdminRequest $request, LogAdmin $log_admin)
    {
        $log_admin = LogAdmin::create($request->all());

        Cache::tags(['log_admins'])->flush();
        return redirect()->route('log-admin.index')->with('message', 'Log Admin has been created');
    }

    /**
    * Edit view
    */
    public function edit(LogAdmin $log_admin)
    {
        return Inertia::render('Views/log-admin/form', [
            'log_admin' => $log_admin,
            'method' => 'update',
            'title' => 'Edit City',
            'breadcumb' => [
                [
                    'text' => 'Dashboard',
                    'url' => route('dashboard'),
                ],
                [
                    'text' => 'Log Admin',
                    'url' => route('log-admin.index')
                ],
                [
                    'text' => 'Edit Log Admin',
                    'url' => route('log-admin.edit',['city'=> $log_admin->id])
                ],
            ],
        ]);
    }

    /**
    * Update Data
    */
    public function update(LogAdminRequest $request, LogAdmin $log_admin)
    {
        $log_admin->update($request->all());
        Cache::tags(['log_admins'])->flush();
        return redirect()->back()->with('message', 'Log Admin has been updated');
    }

    /**
    * Remove the specified resource from storage temporary.
    */
    public function delete($log_admin)
    {
        $log_admin = LogAdmin::find($log_admin);
        if(!$log_admin){
            return abort(404);
        }
        $log_admin->delete();

        Cache::tags(['log_admins'])->flush();
        return redirect()->back()->with('message', 'Log Admin hase been deleted');
    }

    /**
     * Remove data permanently
     */
    public function destroy($log_admin)
    {
        $log_admin = LogAdmin::withTrashed()->find($log_admin);
        if(!$log_admin){
            return abort(404);
        }
        $log_admin->forceDelete();

        Cache::tags(['log_admins'])->flush();
        return redirect()->back()->with('message', 'Log Admin hase been destroyed');
    }

    public function destroyAll()
    {
       $ids = explode(',',request('selected'));
       $log_admins = LogAdmin::whereIn('_id',$ids)->withTrashed()->get();
       foreach ($log_admins as $log_admin) {
          $log_admin->forceDelete();
       }
       Cache::tags(['log_admins'])->flush();
       return redirect()->back()->with('message', 'Log Admin hase been destroyed');
    }

    /**
     * Restore Data from trash
     */
    public function restore($log_admin)
    {
        $log_admin = LogAdmin::withTrashed()->find($log_admin);
        if(!$log_admin){
            return abort(404);
        }
        $log_admin->restore();
        Cache::tags(['log_admins'])->flush();
        return redirect()->back()->with('message', 'Log Admin hase been restored');
    }
}
