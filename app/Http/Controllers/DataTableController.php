<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\ServiceType;
use App\Models\Service;
use App\Models\ServiceGallery;
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
        $query = ServiceType::query();

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
        $query = Service::with('serviceType');

        if ($request->has('type_filter') && $request->type_filter != '') {
            $query->where('type_id', $request->type_filter);
        }

        return DataTables::of($query)
            ->addColumn('service_type', function ($service) {
                return $service->serviceType->name;
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
        $query = ServiceGallery::with(['service', 'service.serviceType']);

        if ($request->has('type_filter') && $request->type_filter != '') {
            $query->whereHas('service', function ($q) use ($request) {
                $q->where('type_id', $request->type_filter);
            });
        }

        return DataTables::of($query)
            ->addColumn('service_name', function ($gallery) {
                return $gallery->service->name;
            })
            ->addColumn('service_type', function ($gallery) {
                return $gallery->service->serviceType->name;
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
     * Products DataTable
     */
    public function products(Request $request)
    {
        $query = Product::query();

        return DataTables::of($query)
            ->addColumn('formatted_price', function ($product) {
                return '$' . number_format($product->price, 2);
            })
            ->addColumn('actions', function ($product) {
                $actions = '<div class="btn-group">';
                $actions .= '<a href="' . route('admin.products.show', $product) . '" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>';
                $actions .= '<a href="' . route('admin.products.edit', $product) . '" class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></a>';
                $actions .= '<form action="' . route('admin.products.destroy', $product) . '" method="POST" class="d-inline">';
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
     * Feedback DataTable
     */
    public function feedback(Request $request)
    {
        $query = Feedback::query();

        return DataTables::of($query)
            ->addColumn('actions', function ($feedback) {
                $actions = '<div class="btn-group">';
                $actions .= '<a href="' . route('admin.feedback.show', $feedback) . '" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>';
                $actions .= '<a href="' . route('admin.feedback.edit', $feedback) . '" class="btn btn-sm btn-outline-secondary"><i class="fas fa-edit"></i></a>';
                $actions .= '<form action="' . route('admin.feedback.destroy', $feedback) . '" method="POST" class="d-inline">';
                $actions .= csrf_field() . method_field('DELETE');
                $actions .= '<button type="submit" class="btn btn-sm btn-outline-danger delete-confirm"><i class="fas fa-trash"></i></button>';
                $actions .= '</form>';
                $actions .= '</div>';
                return $actions;
            })
            ->editColumn('created_at', function ($feedback) {
                return $feedback->created_at->format('M d, Y');
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}