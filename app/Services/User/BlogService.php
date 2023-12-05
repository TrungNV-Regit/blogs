<?php

namespace App\Services\User;

use App\Models\Blog;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Mockery\Undefined;

class BlogService
{

    public function createBlog(array $blog): RedirectResponse
    {
        try {
            $user = Auth::user();

            $data = [
                'title' => $blog['title'],
                'content' => $blog['description'],
                'user_id' => $user->id,
                'category_id' => $blog['category'],
                'status' => Blog::STATUS_PENDING,
                'link_image' => null,
            ];

            if (array_key_exists('image', $blog)) {
                $file = $blog['image'];
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(resource_path('images'), $filename);
                $data['link_image'] = $filename;
            }

            Blog::create($data);

            return redirect()->route('user.my-blogs');
        } catch (Exception $ex) {
            return redirect()->route('exception')->with('error', $ex->getMessage());
        }
    }
}
