<?php
/**
 * Zero Gym Constants
 *
 * @author  Balcomsoft
 * @package RealgymCore
 * @version 1.0.0
 * @since   1.0.0
 */

if ( ! class_exists( 'Realgymcore_Constants' ) ) {
	/**
	 * RealGym Core Constants
	 *
	 * @return void
	 */
	class Realgymcore_Constants {


		/**
		 * Team Member Social Options.
		 *
		 * @return string[]
		 */
		public static function get_team_member_social_options() {
			return array(
				esc_html__( 'LinkedIn', 'realgymcore' )  => 'linkedin',
				esc_html__( 'Instagram', 'realgymcore' ) => 'instagram',
				esc_html__( 'Facebook', 'realgymcore' )  => 'facebook',
			);
		}

		/**
		 * List of Flat Icons.
		 *
		 * @return array[]
		 */
		public static function get_flaticon_options() {
			return array(
				array( 'flaticon-001-barbell' => esc_attr__( 'Barbell', 'realgymcore' ) ),
				array( 'flaticon-002-dumbbells' => esc_attr__( 'Dumbbells', 'realgymcore' ) ),
				array( 'flaticon-003-treadmill' => esc_attr__( 'Treadmill', 'realgymcore' ) ),
				array( 'flaticon-004-stationary-bike' => esc_attr__( 'Stationery Bike', 'realgymcore' ) ),
				array( 'flaticon-005-sweatshirt' => esc_attr__( 'Sweatshirt', 'realgymcore' ) ),
				array( 'flaticon-006-shorts' => esc_attr__( 'Shorts', 'realgymcore' ) ),
				array( 'flaticon-007-water-bottle' => esc_attr__( 'Bottle', 'realgymcore' ) ),
				array( 'flaticon-008-changing-room' => esc_attr__( 'Changing Room', 'realgymcore' ) ),
				array( 'flaticon-009-shower-head' => esc_attr__( 'Shower Head', 'realgymcore' ) ),
				array(
					'flaticon-010-sauna' => esc_attr__( 'Sauna', 'realgymcore' ),
				),
				array( 'flaticon-011-swimming-pool' => esc_attr__( 'Swimming Pool', 'realgymcore' ) ),
				array( 'flaticon-012-yoga-position' => esc_attr__( 'Yoga Position', 'realgymcore' ) ),
				array( 'flaticon-013-muscle' => esc_attr__( 'Muscle', 'realgymcore' ) ),
				array( 'flaticon-014-gym' => esc_attr__( 'Gym', 'realgymcore' ) ),
				array( 'flaticon-015-gym-1' => esc_attr__( 'Gym', 'realgymcore' ) ),
				array( 'flaticon-016-sneaker' => esc_attr__( 'Sneaker', 'realgymcore' ) ),
				array( 'flaticon-017-gym-machine' => esc_attr__( 'Gym Machine', 'realgymcore' ) ),
				array( 'flaticon-018-pulsometer' => esc_attr__( 'Pulsometer', 'realgymcore' ) ),
				array( 'flaticon-019-swedish-wall' => esc_attr__( 'Swedish Wall', 'realgymcore' ) ),
				array( 'flaticon-020-kettlebell' => esc_attr__( 'Kettlebell', 'realgymcore' ) ),
				array(
					'flaticon-021-scale' => esc_attr__( 'Scale', 'realgymcore' ),
				),
				array( 'flaticon-022-chronometer' => esc_attr__( 'Chronometer', 'realgymcore' ) ),
				array(
					'flaticon-023-waist' => esc_attr__( 'Waist', 'realgymcore' ),
				),
				array( 'flaticon-024-wellness' => esc_attr__( 'Wellness', 'realgymcore' ) ),
				array( 'flaticon-025-fruit' => esc_attr__( 'Friut', 'realgymcore' ) ),
				array( 'flaticon-026-power' => esc_attr__( 'Power', 'realgymcore' ) ),
				array( 'flaticon-027-towel' => esc_attr__( 'Towel', 'realgymcore' ) ),
				array( 'flaticon-028-jumping-rope' => esc_attr__( 'Jumping Rope', 'realgymcore' ) ),
				array( 'flaticon-029-yoga-ball' => esc_attr__( 'Yoga Ball', 'realgymcore' ) ),
				array( 'flaticon-030-yoga-mat' => esc_attr__( 'Yoga Mat', 'realgymcore' ) ),
				array( 'flaticon-031-boxing-gloves' => esc_attr__( 'Boxing Gloves', 'realgymcore' ) ),
				array( 'flaticon-032-protein' => esc_attr__( 'Protein', 'realgymcore' ) ),
				array( 'flaticon-033-whistle' => esc_attr__( 'Whistle', 'realgymcore' ) ),
				array( 'flaticon-034-pommel-horse' => esc_attr__( 'Pommel Horse', 'realgymcore' ) ),
				array( 'flaticon-035-sport-bag' => esc_attr__( 'Sport Bag', 'realgymcore' ) ),
				array( 'flaticon-036-boxing-bag' => esc_attr__( 'Boxing Bag', 'realgymcore' ) ),
				array( 'flaticon-037-trainer' => esc_attr__( 'Trainer', 'realgymcore' ) ),
				array( 'flaticon-038-rowing' => esc_attr__( 'Rowing', 'realgymcore' ) ),
				array( 'flaticon-039-app' => esc_attr__( 'App', 'realgymcore' ) ),
				array( 'flaticon-040-heart-rate' => esc_attr__( 'Heart Rate', 'realgymcore' ) ),
				array( 'flaticon-041-weight' => esc_attr__( 'Weight', 'realgymcore' ) ),
				array( 'flaticon-042-energy-bar' => esc_attr__( 'Energy Bar', 'realgymcore' ) ),
				array( 'flaticon-043-orange-juice' => esc_attr__( 'Orange Juice', 'realgymcore' ) ),
				array( 'flaticon-044-hand-grip' => esc_attr__( 'Hand Grip', 'realgymcore' ) ),
				array( 'flaticon-045-lockers' => esc_attr__( 'Lockers', 'realgymcore' ) ),
				array( 'flaticon-046-plan' => esc_attr__( 'Plan', 'realgymcore' ) ),
				array( 'flaticon-047-medicine-ball' => esc_attr__( 'Medicine Ball', 'realgymcore' ) ),
				array( 'flaticon-048-burn' => esc_attr__( 'Burn', 'realgymcore' ) ),
				array( 'flaticon-049-abs' => esc_attr__( 'ABS', 'realgymcore' ) ),
				array( 'flaticon-050-gym-gloves' => esc_attr__( 'Gym Gloves', 'realgymcore' ) ),
			);
		}

		/**
		 * Array of Weekdays
		 *
		 * @param bool $shortened Short version of Weekdays.
		 * @return array
		 */
		public static function get_weekdays( $shortened = false ) {
			if ( $shortened ) {
				return array(
					'monday'    => esc_html__( 'Mon', 'realgymcore' ),
					'tuesday'   => esc_html__( 'Tue', 'realgymcore' ),
					'wednesday' => esc_html__( 'Wed', 'realgymcore' ),
					'thursday'  => esc_html__( 'Thu', 'realgymcore' ),
					'friday'    => esc_html__( 'Fri', 'realgymcore' ),
					'saturday'  => esc_html__( 'Sat', 'realgymcore' ),
					'sunday'    => esc_html__( 'Sun', 'realgymcore' ),
				);
			}

			return array(
				'monday'    => esc_html__( 'Monday', 'realgymcore' ),
				'tuesday'   => esc_html__( 'Tuesday', 'realgymcore' ),
				'wednesday' => esc_html__( 'Wednesday', 'realgymcore' ),
				'thursday'  => esc_html__( 'Thursday', 'realgymcore' ),
				'friday'    => esc_html__( 'Friday', 'realgymcore' ),
				'saturday'  => esc_html__( 'Saturday', 'realgymcore' ),
			);
		}
	}
}
