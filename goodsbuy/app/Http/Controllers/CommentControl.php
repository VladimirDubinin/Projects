<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;

class CommentControl extends Controller
{
    public function submit(Request $comment) {
		$newcomment = new Comments();
		$newcomment->user_id = $comment->user_id;
		$newcomment->good_id = $comment->good_id;
		$newcomment->plus = $comment->plus;
		$newcomment->minus = $comment->minus;
		$newcomment->comment = $comment->comment;
		
		$newcomment->save();
		return redirect()->route('product',$comment->good_id);
	}
}
