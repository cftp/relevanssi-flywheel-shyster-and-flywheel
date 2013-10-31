<?php

/**
 * @group relevanssi_flywheel_shyster_and_flywheel
 */
class Relevanssi_Flywheel_Shyster_And_Flywheel_Test extends WP_UnitTestCase {

	function test_leaves_middle_ampersand() {

		// Arrange
		$string   = 'B&Q';
		$expected = 'B&Q';
		$rfsf = Relevanssi_Flywheel_Shyster_And_Flywheel::init();

		// Act
		$changed = $rfsf->filter_relevanssi_remove_punctuation( $string );

		// Assert
		$this->assertEquals( $expected, $changed );
	}

	function test_doesnt_change_no_punctuation() {

		// Arrange
		$string   = 'Hello dolly';
		$expected = 'Hello dolly';
		$rfsf = Relevanssi_Flywheel_Shyster_And_Flywheel::init();

		// Act
		$changed = $rfsf->filter_relevanssi_remove_punctuation( $string );

		// Assert
		$this->assertEquals( $expected, $changed );
	}

	function test_removes_standalone_ampersand() {

		// Arrange
		$string   = 'black & white';
		$expected = 'black white';
		$rfsf = Relevanssi_Flywheel_Shyster_And_Flywheel::init();

		// Act
		$changed = $rfsf->filter_relevanssi_remove_punctuation( $string );

		// Assert
		$this->assertEquals( $expected, $changed );
	}

}

