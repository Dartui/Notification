<?php
/**
 * Comment author IP merge tag
 *
 * @package notification
 */

namespace BracketSpace\Notification\Defaults\MergeTag\Comment;

use BracketSpace\Notification\Defaults\MergeTag\IPTag;
use BracketSpace\Notification\Traits;

/**
 * Comment author IP merge tag class
 */
class CommentAuthorIP extends IPTag {

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
				'slug'        => 'comment_author_IP',
				// Translators: Comment type name.
				'name'        => sprintf( __( '%s author IP', 'notification' ), self::get_current_comment_type_name() ),
				'description' => '127.0.0.1',
				'example'     => true,
				'resolver'    => function( $trigger ) {
					return $trigger->{ $this->property_name }->comment_author_IP;
				},
				// translators: comment type author.
				'group'       => sprintf( __( '%s author', 'notification' ), self::get_current_comment_type_name() ),
			]
		);

		parent::__construct( $args );

	}

}
