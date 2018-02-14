<?php
/**
 * User profile updated datetime merge tag
 *
 * @package notification
 */

namespace underDEV\Notification\Defaults\MergeTag\User;

use underDEV\Notification\Defaults\MergeTag\StringTag;

/**
 * User profile updated datetime merge tag class
 */
class UserProfileUpdatedDatetime extends StringTag {

	/**
	 * Receives Trigger object from Trigger class
	 *
	 * @var private object $trigger
	 */
    protected $trigger;

    /**
     * Constructor
     *
     * @param object $trigger Trigger object to access data from.
     */
    public function __construct( $trigger ) {

        $this->trigger = $trigger;

    	parent::__construct( array(
			'slug'        => 'user_profile_updated_datetime',
			'name'        => __( 'User profile update time' ),
			'description' => __( 'Will be resolved to a user profile update time' ),
			'resolver'    => function() {
				return date( $this->trigger->date_format . ' ' . $this->trigger->time_format );
			},
        ) );

    }

}
