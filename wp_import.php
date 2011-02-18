<?php
/*Reads a wordpress exportfile into abstract data types 
 *Example at the bottom of the file 
 *@author schmiddi
 *@date 30.03.10
 * licence: feel free to use it. 
 */

require_once('adt.php');
 

class CWp_import{
	private $xml; //handle for the simplexml object
	
	
	public function __construct($file){
		if (file_exists($file)) {
			$this->xml = simplexml_load_file($file);		
		} else {
			echo "File not found";
			die();		
		}//else
	}//construct
	
	public function getPosts(){
		/*returns an array of ADT_posts objects
		 * 
		 */
		$xml=$this->xml;
		$arr_posts = array();
		foreach ( $xml->channel->item as $item){
			$post = new ADT_post();
			$post->title = $item->title;
			$post->pubdate = $item->pubDate;
			$post->creator = $item->children('dc', true)->creator;
			$post->content = $item->children('content', true)->encoded;
			
			//Add comments
			if (!empty( $item->children('wp',true)->comment) ) {
				foreach ($item->children('wp',true)->comment as $comment){
					$c = new ADT_comment(
						$comment->comment_id,
						$comment->comment_author, 
						$comment->comment_author_email,
						$comment->comment_author_url,						
						$comment->comment_author_IP,
						$comment->comment_date,
						$comment->comment_date_gmt,
						$comment->comment_content,
						$comment->comment_approved,
						$comment->comment_user_id,
						$comment->comment_parent
						);
					array_push($post->comments, $c);
						
				}//each					
			}//fi
			//tags & categories
			foreach ($item->category as $cat){
				$nicename =$cat->attributes()->nicename;
				if ($cat->attributes()->domain =='tag' &&$cat->attributes()->nicename!=''){
					$t = new ADT_tag($nicename, $cat);
					$post->add_tag($t);
				}
				if ($cat->attributes()->domain=='category'){
					$c = new ADT_category($nicename, '', $cat);
					$post->add_category($c);
					
				}
					
					
			}//each				
			array_push($arr_posts, $post);
		}//each		
		return $arr_posts;
	}//function
	
	public function getTags(){
		/*returns an array of ADT_tag objects
		 * 
		 */
		$xml=$this->xml;
		$arr_tags = array();	
		foreach ( $xml->channel->children('wp',true)->tag as $item){
				$tag = new ADT_tag();
				$tag->slug = $item->tag_slug;
				$tag->name = $item->tag_name;
				array_push($arr_tags, $tag);			
		}//each
		return $arr_tags;
	}//function
	
	public function getCategories(){
		/*returns an array of ADT_category objects
		 * 
		 */
		$xml=$this->xml;
		$arr_categories = array();		
		foreach ( $xml->channel->children('wp',true)->category as $item){
			$cat = new ADT_category();
			$cat->nicename = $item->category_nicename;
			$cat->parent= $item->category_parent;
			$cat->name = $item->cat_name;
			array_push($arr_categories, $cat);
			
		}//each
		return $arr_categories;
		
	}//function 
		
	public function getMetaInfo (){
		/*returns an ADT_wp_meta object
		 */
		$xml=$this->xml;
		$wp_meta = new ADT_wp_meta();
		$wp_meta->title = $xml->channel->title;
		$wp_meta->link = $xml->channel->link;
		$wp_meta->description = $xml->channel->description;
		$wp_meta->pubDate = $xml->channel->pubDate;
		$wp_meta->language = $xml->channel->language;
		$wp_meta->base_blog_url =$xml->channel->children('wp',true)->base_blog_url;
		
		return $wp_meta;		
	}
	

	
	
	
}//class
$file='wordpress.2010-03-29.xml';
$arr = array();
$import = new CWp_import($file);


$arr= $import->getPosts();

foreach ($arr as $post){
	$post->print_vars();
 
}
?>