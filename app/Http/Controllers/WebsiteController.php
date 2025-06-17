<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\ServiceType;
use App\Models\Service;
use App\Models\ServiceGallery;

class WebsiteController extends Controller
{

    public function Index(Request $request)
    {      
        $service_types = ServiceType::where('status',1)->orderBy('name')
                                ->get();
        $group_services = ServiceType::orderBy('name')->with('services')->get();

        $blogs = Blog::where('status',1)->where('home_visibility',1)
                        ->orderBy('created_at', 'desc')->limit(3)->get();

        $testimonials = Testimonial::where('status',1)->where('home_visibility',1)
                            ->orderBy('created_at', 'desc')->get();

        return view('website.index',compact('service_types','group_services','blogs','testimonials'));

    }
    
    public function Design(Request $request)
    {
        return view('website.design');

    }
    
    public function Construction(Request $request)
    {
        return view('website.construction');

    }

    public function Interior(Request $request)
    {
        return view('website.interior');

    }
    
    public function Maintenance(Request $request)
    {
        return view('website.maintenance');

    }

    public function About(Request $request)
    {
        return view('website.about');

    }

    public function Project(Request $request)
    {
        $group_services = ServiceType::orderBy('name')->with('services')->get();
        return view('website.project',compact('group_services'));

    }

    public function ProjectDetails($id)
    {
        $service_gallery = Service::where('id',$id)->with('galleries')->first();
        return view('website.project_details',compact('service_gallery'));
    }

    public function Blog(Request $request)
    {
        $blogs = Blog::where('status',1)->orderBy('created_at', 'desc')->get();
        return view('website.blog',compact('blogs'));

    }

    public function BlogDetails($slug)
    {
        $blog = Blog::where('slug',$slug)->first();
        return view('website.blog_details',compact('blog'));
    }

    public function Contact(Request $request)
    {
        return view('website.contact');

    }

}