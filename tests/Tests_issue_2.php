<?php // (C) Copyright Bobbing Wide 2017-2020


class Tests_issue_2 extends BW_UnitTestCase {

	
	/** 
	 * set up logic
	 * 
	 * - ensure any database updates are rolled back
	 * - We depend on BW_UnitTestCase to implement the tag_break method, but this is not tested
	 * - We load the [cookies] shortcode functions
	 */
	function setUp(): void {
		parent::setUp();
		oik_require( "shortcodes/cookie-cat.php", "cookie-cat" );
	}
	
	/**
	 * Tests that the &nbsp has a semicolon after it
	 *
	 */
	function test_semicolon_after_nbsp() {
		cookie_cat_row( "cookie", null );
		$html = bw_ret();
		$html_array = $this->tag_break( $html );
		$expected = array();
		$expected[] = '<tr>';
		$expected[] = '<td>cookie</td>';
		$expected[] = '<td>unknown</td>';
		$expected[] = '<td>';
		$expected[] = '</td>';
		$expected[] = '<td>&nbsp;</td>';
		$expected[] = '</tr>';
		$this->assertEquals( $expected, $html_array );
	}
	
	/**
	 * Tests cookie_cat_row with non-null cookie_info
	 */
	function test_cookie_cat_row_with_cookie_info() {
		$cookie_info = array( "name" => "cookie"
												, "cat" => "1"
												, "cb" => "Test cookie desc"
												, "dur" => null
												);
		cookie_cat_row( "cookie", $cookie_info );
		$html = bw_ret();
		$html_array = $this->tag_break( $html );
		$expected = array();
		$expected[] = '<tr>';
		$expected[] = '<td>cookie</td>';
		$expected[] = '<td>1</td>';
		$expected[] = '<td>Test cookie desc</td>';
		$expected[] = '<td>session</td>';
		$expected[] = '</tr>';
		$this->assertEquals( $expected, $html_array );
	}	
	
	

}
