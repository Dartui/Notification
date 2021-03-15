<?php
/**
 * Comment content html merge tag
 *
 * @package notification
 */

namespace BracketSpace\Notification\Defaults\MergeTag\Comment;

use BracketSpace\Notification\Defaults\MergeTag\HtmlTag;
use BracketSpace\Notification\Traits;

/**
 * Comment content html merge tag class
 */
class CommentContentHtml extends HtmlTag {

	use Traits\CommentTypeUtils;

	/**
	 * Trigger property to get the comment data from
	 *
	 * @var string
	 */
	protected $comment_type = 'comment';

	/**
	 * Trigger property name to get the comment data from
	 *
	 * @var string
	 */
	protected $property_name = '';

	/**
	 * Merge tag constructor
	 *
	 * @since 5.0.0
	 * @param array $params merge tag configuration params.
	 */
	public function __construct( $params = [] ) {

		if ( isset( $params['comment_type'] ) && ! empty( $params['comment_type'] ) ) {
			$this->comment_type = $params['comment_type'];
		}

		if ( isset( $params['property_name'] ) && ! empty( $params['property_name'] ) ) {
			$this->property_name = $params['property_name'];
		} else {
			$this->property_name = $this->comment_type;
		}

		$args = wp_parse_args(
			$params,
			[
				'slug'        => 'comment_content_html',
				// Translators: Comment type name.
				'name'        => sprintf( __( '%s HTML content', 'notification' ), self::get_current_comment_type_name() ),
				'description' => __( 'Great post!', 'notification' ),
				'example'     => true,
				'resolver'    => function( $trigger ) {
					return $trigger->{ $this->property_name }->comment_content;
				},
				'group'       => __( self::get_current_comment_type_name(), 'notification' ),
			]
		);

		parent::__construct( $args );

	}

}
