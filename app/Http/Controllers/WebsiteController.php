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

class WebsiteController extends Controller
{

    public function Index(Request $request)
    {      
        $tabs = MenuItem::where('status', 1)->get();

        $group_services = $tabs->map(function ($tab) {
            if ($tab->type == 1) {
                // Fetch related projects
                $projects = Project::where('menu_item_id', $tab->id)
                    ->where('status', 1)
                    ->where('home_visibility', 1)
                    ->take(3)
                    ->get();

                return [
                    'tab_id' => $tab->id,
                    'tab_name' => $tab->name,
                    'type' => 1,
                    'services' => $projects
                ];
            } elseif ($tab->type == 2) {
                // Fetch 3 video items
                $videos = VideoItem::where('status', 1)
                    ->where('home_visibility', 1)
                    ->take(3)
                    ->get();

                return [
                    'tab_id' => $tab->id,
                    'tab_name' => $tab->name,
                    'type' => 2,
                    'services' => $videos
                ];
            }

            return null;
        })->filter();

        $blogs = Blog::where('status',1)->where('home_visibility',1)
                        ->orderBy('created_at', 'desc')->limit(3)->get();

        $testimonials = Testimonial::where('status',1)->where('home_visibility',1)
                            ->orderBy('created_at', 'desc')->get();

        return view('website.index',compact('group_services','blogs','testimonials'));

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
        $tabs = MenuItem::where('status', 1)->get();

        $group_services = $tabs->map(function ($tab) {
            if ($tab->type == 1) {

                $projects = Project::where('menu_item_id', $tab->id)
                    ->where('status', 1)
                    ->get();

                return [
                    'tab_id' => $tab->id,
                    'tab_name' => $tab->name,
                    'type' => 1,
                    'services' => $projects
                ];
            } elseif ($tab->type == 2) {
                
                $videos = VideoItem::where('status', 1)
                    ->get();

                return [
                    'tab_id' => $tab->id,
                    'tab_name' => $tab->name,
                    'type' => 2,
                    'services' => $videos
                ];
            }

            return null;
        })->filter();

        return view('website.project',compact('group_services'));

    }

    public function ProjectDetails($id)
    {
        $service_gallery = Project::where('id',$id)->with('ProjectImages')->first();
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