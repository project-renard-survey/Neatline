<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=80; */

/**
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

class Migrate200Test_ProcessRecordPresenter
    extends Neatline_Case_Migration_200
{


    public function setUp()
    {

        parent::setUp();
        $this->_loadFixture('ProcessRecordPresenter.records');

        $this->_upgrade();
        $this->_migrate();

    }


    /**
     * If `show_bubble` on the old record is true, the `presenter` field on
     * the new record should be set to `StaticBubble`.
     */
    public function testBubble()
    {
        $this->assertEquals(
            'StaticBubble',
            $this->_getRecordByTitle('Bubble')->presenter
        );
    }


    /**
     * If `show_bubble` on the old record is false, the `presenter` field on
     * the new record should be set to `None`.
     */
    public function testNoBubble()
    {
        $this->assertEquals(
            'None',
            $this->_getRecordByTitle('No Bubble')->presenter
        );
    }


}
