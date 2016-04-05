<?php 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if (!class_exists('BBoss_Global_Search_Posts')):

	/**
	 *
	 * BuddyPress Global Search  - search posts
	 * **************************************
	 *
	 *
	 */
	class BBoss_Global_Search_Posts extends BBoss_Global_Search_Type {
		private $type = 'posts';
		
		/**
		 * Insures that only one instance of Class exists in memory at any
		 * one time. Also prevents needing to define globals all over the place.
		 *
		 * @since 1.0.0
		 *
		 * @see buddyboss_global_search()
		 *
		 * @return object BBoss_Global_Search_Posts
		 */
		public static function instance() {
			// Store the instance locally to avoid private static replication
			static $instance = null;

			// Only run these methods if they haven't been run previously
			if (null === $instance) {
				$instance = new BBoss_Global_Search_Posts();
			}

			// Always return the instance
			return $instance;
		}

		/**
		 * A dummy constructor to prevent this class from being loaded more than once.
		 *
		 * @since 1.0.0
		 */
		private function __construct() { /* Do nothing here */
		}
		
		public function sql( $search_term, $only_totalrow_count=false ){
			/* an example UNION query :- 
			-----------------------------------------------------
			(
				SELECT 
					wp_posts.id , 'posts' as type, wp_posts.post_title LIKE '%ho%' AS relevance, wp_posts.post_date as entry_date 
				FROM 
					wp_posts 
				WHERE 
					1=1 
					AND (
							(
									(wp_posts.post_title LIKE '%ho%') 
								OR 	(wp_posts.post_content LIKE '%ho%')
							)
						) 
					AND wp_posts.post_type IN ('post', 'page', 'attachment') 
					AND (
						wp_posts.post_status = 'publish' 
						OR wp_posts.post_author = 1 
						AND wp_posts.post_status = 'private'
					) 
			)
			----------------------------------------------------
			*/
			global $wpdb;
			$query_placeholder = array(); 
			
			$sql = " SELECT ";
			
			if( $only_totalrow_count ){
				$sql .= " COUNT( DISTINCT id ) ";
			} else {
				$sql .= " DISTINCT id , 'posts' as type, post_title LIKE '%%%s%%' AS relevance, post_date as entry_date  ";
				$query_placeholder[] = $search_term;
			}
						
			$sql .= " FROM 
						{$wpdb->prefix}posts 
					WHERE 
						1=1 
						AND (
								(
										(post_title LIKE '%%%s%%') 
									OR 	(post_content LIKE '%%%s%%')
								)
							) 
						AND post_type IN ('post', 'page') 
						AND post_status = 'publish' 
				";
			$query_placeholder[] = $search_term;
			$query_placeholder[] = $search_term;
			$sql = $wpdb->prepare( $sql, $query_placeholder );
            
            return apply_filters( 
                'BBoss_Global_Search_Posts_sql', 
                $sql, 
                array( 
                    'search_term'           => $search_term,
                    'only_totalrow_count'   => $only_totalrow_count,
                ) 
            );
		}
		
		protected function generate_html( $template_type='' ){
			$post_ids = array();
			foreach( $this->search_results['items'] as $item_id=>$item_html ){
				$post_ids[] = $item_id;
			}

			//now we have all the posts
			//lets do a wp_query and generate html for all posts
			$qry = new WP_Query( array( 'post_type' =>array( 'post', 'page' ), 'post__in'=>$post_ids, 'posts_per_page'=> -1 ) );
			if( $qry->have_posts() ){
				while( $qry->have_posts() ){
					$qry->the_post();	
					$result = array(
						'id'	=> get_the_ID(),
						'type'	=> $this->type,
						'title'	=> get_the_title(),
						'html'	=> buddyboss_global_search_buffer_template_part( 'loop/post', $template_type, false ),
					);

					$this->search_results['items'][get_the_ID()] = $result;
				}
			}
			wp_reset_postdata();
		}
		
	}

// End class BBoss_Global_Search_Posts

endif;
?>