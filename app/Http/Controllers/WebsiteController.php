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
        return view('website.index');

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

    public function ProjectDetails(Request $request)
    {
        return view('website.project_details');

    }

    public function Project(Request $request)
    {
        return view('website.project');

    }

    public function Blog(Request $request)
    {
        return view('website.blog');

    }

    public function BlogDetails(Request $request)
    {
        return view('website.blog_details');

    }

    public function Contact(Request $request)
    {
        return view('website.contact');

    }

}