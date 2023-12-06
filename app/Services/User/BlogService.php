<?php

namespace App\Services\User;

use App\Models\Blog;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BlogService
{

    public function createBlog(array $blog): RedirectResponse
    {
        try {
            $user = Auth::user();

            $blog = [
                ...$blog,
                'user_id' => $user->id,
                'status' => Blog::STATUS_PENDING,
                'link_image' => null,
            ];

            if (array_key_exists('image', $blog)) {
                $file = $blog['image'];
                $fileName = time() . '.' . $file->extension();
                $imagePath = $file->storeAs('public/images', $fileName);
                $linkImage = Storage::url($imagePath);
                $blog['link_image']  = $linkImage;
            }

            Blog::create($blog);

            return back()->with('success', trans('message.create_blog_success'));
        } catch (Exception $ex) {
            return redirect()->route('exception')->with('error', $ex->getMessage());
        }
    }
}
