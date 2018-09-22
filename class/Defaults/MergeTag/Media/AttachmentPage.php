<?php
/**
 * Attachment page merge tag
 *
 * @package notification
 */

namespace BracketSpace\Notification\Defaults\MergeTag\Media;

use BracketSpace\Notification\Defaults\MergeTag\UrlTag;


/**
 * Attachment page merge tag class
 */
class AttachmentPage extends UrlTag {

	/**
	 * Trigger property to get the attachment data from
	 *
	 * @var string
	 */
	protected $property_name = 'attachment';

	/**
	 * Merge tag constructor
	 *
	 * @since 5.0.0
	 * @param array $params merge tag configuration params.
	 */
	public function __construct( $params = array() ) {

		if ( isset( $params['property_name'] ) && ! empty( $params['property_name'] ) ) {
			$this->property_name = $params['property_name'];
		}

		$args = wp_parse_args(
			$params,
			array(
				'slug'        => 'attachment_page_link',
				'name'        => __( 'Attachment page link', 'notification' ),
				'description' => __( 'http://example.com/forest-landscape/', 'notification' ),
				'example'     => true,
				'resolver'    => function() {
					return get_permalink( $this->{ $this->property_name }->attachment->ID );
				},
			)
		);

		parent::__construct( $args );

	}

	/**
	 * Function for checking requirements
	 *
	 * @return boolean
	 */
	public function check_requirements() {
		return isset( $this->{ $this->property_name }->attachment->ID );
	}

}
