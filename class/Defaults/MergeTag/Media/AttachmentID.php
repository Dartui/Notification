<?php
/**
 * Attachment ID merge tag
 *
 * @package notification
 */

namespace BracketSpace\Notification\Defaults\MergeTag\Media;

use BracketSpace\Notification\Defaults\MergeTag\IntegerTag;


/**
 * Attachment ID merge tag class
 */
class AttachmentID extends IntegerTag {

	/**
     * Merge tag constructor
     *
     * @since [Next]
     * @param array $params merge tag configuration params.
     */
    public function __construct( $params = array() ) {

    	$args = wp_parse_args( $params, array(
			'slug'        => 'attachment_ID',
			'name'        => __( 'Attachment ID', 'notification' ),
			'description' => '35',
			'example'     => true,
			'resolver'    => function() {
				return $this->trigger->attachment->ID;
			},
		) );

    	parent::__construct( $args );

	}

	/**
	 * Function for checking requirements
	 *
	 * @return boolean
	 */
	public function check_requirements( ) {
		return isset( $this->trigger->attachment->ID );
	}

}
