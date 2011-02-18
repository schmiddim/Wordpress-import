<?php

class ADT_post {
	/**Abstract Datatype (struct) for Blogpost	 
	 * 
	 */ 
	public $title, $pubdate, $creator, $content; 
	public $tags, $categories, $comments; //ADT arrays
	
	public function __construct(){
		$this->tags = array();
		$this->categories= array();
		$this->comments=array();
		
	}//construct
	public function add_tag($adt_tag){
		array_push($this->tags, $adt_tag);
		
	}//add_tag
	public function add_category($adt_category) {
		array_push($this->categories, $adt_category);
	}//func
	public function add_comment($adt_comment) {
		array_push($this->comments, $adt_comment);
	}//func
	
	public function print_vars(){
		echo 
			'<h5>POST</h5>'.
			'title:'.$this->title	.'<p>' . 
			'creator:'. $this->creator.'<p>' .
			'pubdate:'. $this->pubdate.'<p>' .
			'content_encoded:.'.$this->content.'<p>';
		echo '<h5>Tags</h5>';
		foreach ($this->tags as $tag) 
			$tag->print_vars();
			
		echo '<h5>Categories</h5>';	
		foreach ($this->categories as $cat)
			$cat->print_vars();
		echo '<h5>Comment</h5>';
		foreach ($this->comments as $comment)
			$comment->print_vars();
		

		
	}//function
}//class


class ADT_comment {
	/**Abstract Datatype (struct) for Comment	 
	 * 
	 */ 
	public $id, $author, $email, $url, $ip, $date, $date_gmt, $content, $approved,
			$user_id, $parent;
			
	public function __construct(	$id='', $author='', $email='',
									$url='', $ip='', $date='', $date_gmt='', 
									$content='', $approved='',$user_id='', 
									$parent='')
	{
				$this->id = $id;
				$this->author=$author;
				$this->email=$email;
				$this->url=$url;
				$this->ip=$ip;
				$this->date=$date;
				$this->date_gmt = $date_gmt;
				$this->content = $content;
				$this->approved=$approved;
				$this->user_id =$user_id;
				$this->parent=$parent;	
							
	}//construct

	
	public function print_vars(){
		echo 
			
		'id:'.$this->id	.'<p>' . 
		'ip:'. $this->ip.'<p>' .
		'author:'. $this->author.'<p>' .
		'email:'. $this->email.'<p>' .
		'url:'. $this->url.'<p>' .
		'ip:'. $this->ip.'<p>' .
		'date:'. $this->date.'<p>' .
		'gmt:'. $this->date_gmt.'<p>' .
		'content:'. $this->content.'<p>' .
		'approved:'. $this->approved.'<p>' .
		'user_id:'. $this->user_id.'<p>' .
		'parent:'. $this->parent.'<p>';						
		 
		
	}//function
	
}//class category

class ADT_wp_meta{
	/**Abstract Datatype (struct) for Metainfos	 
	 * 
	 */ 
	public $title, $link, $description, $pubDate, $language, $base_blog_url;
	
	public function print_vars(){
		echo 
			$this->title		.'<p>'.
			$this->link			.'<p>'.
			$this->description	.'<p>'.
			$this->pubDate		.'<p>'.
			$this->language		.'<p>'.
			$this->base_blog_url.'<p>'
			;	
		
	}//print;
}//class
class ADT_category {
	/**Abstract Datatype (struct) for Category	 
	 * 
	 */ 
	public $nicename, $parent, $name;
	public function __construct($nicename='', $parent='', $name=''){
		$this->nicename=$nicename;
		$this->parent=$parent;
		$this->name=$name;
	}
	public function print_vars(){
		echo 
			'nicename:'.$this->nicename	.'<p>' . 
			'name:'. $this->name		.'<p>' .
			'parent'.$this->parent	.'<p>' ;
		
		
	}//function
}//class

class ADT_tag {
	/**Abstract Datatype (struct) for Comment	 
	 * 
	 */ 
	public $slug, $name;
	
	public function __construct($slug='', $name=''){
		$this->slug= $slug;
		$this->name=$name;
		
	}//construct
	public function print_vars(){
		echo 
			'slug:'.$this->slug	.'<p>' . 
			'name:'. $this->name.'<p>' ;		
			
		
	}//function
}//class
?>
