<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * Tests for PUT action in records API.
 *
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

class Neatline_RecordsControllerTest_Put
    extends Neatline_Test_AppTestCase
{


    /**
     * PUT should update a record.
     */
    public function testPut()
    {

        // Create record.
        $exhibit = $this->__exhibit();
        $record = $this->__record();

        // Set parameters.
        $record->title              = 'title';
        $record->body               = 'body';
        $record->slug               = 'slug';
        $record->vector_color       = '#vector';
        $record->stroke_color       = '#stroke';
        $record->select_color       = '#select';
        $record->vector_opacity     = 1;
        $record->select_opacity     = 2;
        $record->stroke_opacity     = 3;
        $record->image_opacity      = 4;
        $record->stroke_width       = 5;
        $record->point_radius       = 6;
        $record->point_image        = 'file.png';
        $record->min_zoom           = 7;
        $record->max_zoom           = 8;
        $record->map_focus          = 'lat/lon';
        $record->map_zoom           = 9;
        $record->map_active         = 1;
        $record->save('POINT(1 1)');

        // Mock values.
        $values = array(
            'id'                    => $record->id,
            'item_id'               => null,
            'title'                 => 'title2',
            'body'                  => 'body2',
            'slug'                  => 'slug2',
            'vector_color'          => '#vector2',
            'stroke_color'          => '#stroke2',
            'select_color'          => '#select2',
            'vector_opacity'        => '10',
            'select_opacity'        => '20',
            'stroke_opacity'        => '30',
            'image_opacity'         => '40',
            'stroke_width'          => '50',
            'point_radius'          => '60',
            'point_image'           => 'file2.png',
            'min_zoom'              => '70',
            'max_zoom'              => '80',
            'map_focus'             => 'lat2/lon2',
            'map_zoom'              => '90',
            'coverage'              => 'POINT(1 1)',
            'map_active'            => '0'
        );

        // Mock PUT.
        $this->writePut($values);

        // Issue request.
        $this->request->setMethod('PUT');
        $this->dispatch('neatline/records/'.$record->id);

        // Re-get record.
        $record = $this->_recordsTable->find($record->id);

        // Check new values.
        $this->assertEquals($record->title, 'title2');
        $this->assertEquals($record->body, 'body2');
        $this->assertEquals($record->slug, 'slug2');
        $this->assertEquals($record->vector_color, '#vector2');
        $this->assertEquals($record->stroke_color, '#stroke2');
        $this->assertEquals($record->select_color, '#select2');
        $this->assertEquals($record->vector_opacity, 10);
        $this->assertEquals($record->select_opacity, 20);
        $this->assertEquals($record->stroke_opacity, 30);
        $this->assertEquals($record->image_opacity, 40);
        $this->assertEquals($record->stroke_width, 50);
        $this->assertEquals($record->point_radius, 60);
        $this->assertEquals($record->point_image, 'file2.png');
        $this->assertEquals($record->min_zoom, '70');
        $this->assertEquals($record->max_zoom, '80');
        $this->assertEquals($record->map_focus, 'lat2/lon2');
        $this->assertEquals($record->map_zoom, 90);
        $this->assertEquals($record->map_active, 0);

        // Check the coverage value.
        $this->assertEquals($this->getCoverageAsText($record),
            'POINT(1 1)');

    }


}