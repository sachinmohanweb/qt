<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\MenuItem;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\VideoItem;
use Yajra\DataTables\Facades\DataTables;


class DataTableController extends Controller
{
    /**
     * Users DataTable
     */
    public function users(Request $request)
    {
        $query = User::query();

        if ($request->has('role_filter') && $request->role_filter != '') {
            $query->where('role', $request->role_filter);
        }

        return DataTables::of($query)
            ->addColumn('actions', function ($user) {
                $actions = '<div class="btn-group">';
                $actions .= '<a href="' . route('admin.users.show', $user) . '" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>';
                $actions .= '<a href="' . route('admin.users.edit', $user) . '" class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></a>';
                
                if (auth()->id() != $user->id) {
                    $actions .= '<form action="' . route('admin.users.destroy', $user) . '" method="POST" class="d-inline">';
                    $actions .= csrf_field() . method_field('DELETE');
                    $actions .= '<button type="submit" class="btn btn-sm btn-outline-danger delete-confirm"><i class="fas fa-trash"></i></button>';
                    $actions .= '</form>';
                } else {
                    $actions .= '<button type="button" class="btn btn-sm btn-outline-danger" disabled><i class="fas fa-trash"></i></button>';
                }
                
                $actions .= '</div>';
                return $actions;
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at->format('M d, Y');
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Testimonials DataTable
     */
    public function testimonials(Request $request)
    {
        $query = Testimonial::query();

        if ($request->has('star_rating_filter') && $request->star_rating_filter != '') {
            $query->where('star_rating', $request->star_rating_filter);
        }

        return DataTables::of($query)
            ->addColumn('actions', function ($testimonial) {
                $actions = '<div class="btn-group">';
                $actions .= '<a href="' . route('admin.testimonials.show', $testimonial) . '" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>';
                $actions .= '<a href="' . route('admin.testimonials.edit', $testimonial) . '" class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></a>';
                $actions .= '<form action="' . route('admin.testimonials.destroy', $testimonial) . '" method="POST" class="d-inline">';
                $actions .= csrf_field() . method_field('DELETE');
                $actions .= '<button type="submit" class="btn btn-sm btn-outline-danger delete-confirm"><i class="fas fa-trash"></i></button>';
                $actions .= '</form>';
                $actions .= '</div>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Blogs DataTable
     */
    public function blogs(Request $request)
    {
        $query = Blog::query();

        return DataTables::of($query)
            ->addColumn('actions', function ($blog) {
                $actions = '<div class="btn-group">';
                $actions .= '<a href="' . route('admin.blogs.show', $blog) . '" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>';
                $actions .= '<a href="' . route('admin.blogs.edit', $blog) . '" class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></a>';
                $actions .= '<form action="' . route('admin.blogs.destroy', $blog) . '" method="POST" class="d-inline">';
                $actions .= csrf_field() . method_field('DELETE');
                $actions .= '<button type="submit" class="btn btn-sm btn-outline-danger delete-confirm"><i class="fas fa-trash"></i></button>';
                $actions .= '</form>';
                $actions .= '</div>';
                return $actions;
            })
            ->editColumn('date', function ($blog) {
                return $blog->date->format('M d, Y');
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Service Types DataTable
     */
    public function serviceTypes(Request $request)
    {
        $query = MenuItem::query()->orderBy('id');

        return DataTables::of($query)
            ->addColumn('actions', function ($serviceType) {
                $actions = '<div class="btn-group">';
                $actions .= '<a href="' . route('admin.service-types.show', $serviceType) . '" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>';
                $actions .= '<a href="' . route('admin.service-types.edit', $serviceType) . '" class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></a>';
                $actions .= '<form action="' . route('admin.service-types.destroy', $serviceType) . '" method="POST" class="d-inline">';
                $actions .= csrf_field() . method_field('DELETE');
                $actions .= '<button type="submit" class="btn btn-sm btn-outline-danger delete-confirm"><i class="fas fa-trash"></i></button>';
                $actions .= '</form>';
                $actions .= '</div>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Services DataTable
     */
    public function services(Request $request)
    {
        $query = Project::orderBy('id')->with('MenuItem');

        if ($request->has('type_filter') && $request->type_filter != '') {
            $query->where('menu_item_id', $request->type_filter);
        }

        return DataTables::of($query)
            ->addColumn('menu_item_id', function ($service) {
                return $service->MenuItem->name;
            })
            ->addColumn('actions', function ($service) {
                $actions = '<div class="btn-group">';
                $actions .= '<a href="' . route('admin.services.show', $service) . '" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>';
                $actions .= '<a href="' . route('admin.services.edit', $service) . '" class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></a>';
                $actions .= '<form action="' . route('admin.services.destroy', $service) . '" method="POST" class="d-inline">';
                $actions .= csrf_field() . method_field('DELETE');
                $actions .= '<button type="submit" class="btn btn-sm btn-outline-danger delete-confirm"><i class="fas fa-trash"></i></button>';
                $actions .= '</form>';
                $actions .= '</div>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Service Gallery DataTable
     */
    public function serviceGalleries(Request $request)
    {
        $query = ProjectImage::with(['Project', 'Project.MenuItem']);

        if ($request->has('type_filter') && $request->type_filter != '') {
            $query->whereHas('Project', function ($q) use ($request) {
                $q->where('project_id', $request->type_filter);
            });
        }

        return DataTables::of($query)
            ->addColumn('service_name', function ($gallery) {
                return $gallery->Project->name;
            })
            ->addColumn('service_type', function ($gallery) {
                return $gallery->Project->MenuItem->name;
            })
            ->addColumn('actions', function ($gallery) {
                $actions = '<div class="btn-group">';
                $actions .= '<a href="' . route('admin.service-galleries.show', $gallery) . '" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>';
                $actions .= '<a href="' . route('admin.service-galleries.edit', $gallery) . '" class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></a>';
                $actions .= '<form action="' . route('admin.service-galleries.destroy', $gallery) . '" method="POST" class="d-inline">';
                $actions .= csrf_field() . method_field('DELETE');
                $actions .= '<button type="submit" class="btn btn-sm btn-outline-danger delete-confirm"><i class="fas fa-trash"></i></button>';
                $actions .= '</form>';
                $actions .= '</div>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Video Item DataTable
     */
    public function VideoItems(Request $request)
    {
        $query = VideoItem::orderBy('created_at','desc');

        return DataTables::of($query)
           
            ->addColumn('actions', function ($gallery) {
                $actions = '<div class="btn-group">';
                $actions .= '<a href="' . $gallery->link_path . '" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>';

                $actions .= '<a href="' . route('admin.video-items.edit', $gallery) . '" class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></a>';
                $actions .= '<form action="' . route('admin.video-items.destroy', $gallery) . '" method="POST" class="d-inline">';
                $actions .= csrf_field() . method_field('DELETE');
                $actions .= '<button type="submit" class="btn btn-sm btn-outline-danger delete-confirm"><i class="fas fa-trash"></i></button>';
                $actions .= '</form>';
                $actions .= '</div>';
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    
}