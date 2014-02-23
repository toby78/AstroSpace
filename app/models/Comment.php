<?php

class Comment extends Eloquent {
  protected $table = 'comments';
	public static $rules = array(
    'content'=>'required'
   );

  public function postedBy() {
    return $this->belongsTo('User', 'posted_by_id', 'id');
  }

  public function blogPost() {
    return $this->belongsTo('BlogPost', 'blog_post_id', 'id');
  }
}
