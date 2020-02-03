<?php

class WP_RadarChartAdminFields extends WP_RadarChartAdminPageFramework {

    public function setUp() {

        $this->setRootMenuPage( 'Settings' );
        $this->addSubMenuItem(
            array(
                'title'     => 'My First Page',
                'page_slug' => 'my_first_page'
            )
        );

    }
    /**
     * Triggered in the middle of rendering the page.
     *
     * Inserts your custom contents here.
     *
     * @remark      do_{page slug}
     */
    public function do_my_first_page() {

        ?>
        <h3>Say Something</h3>
        <p>This is my first admin page!</p>
        <?php

    }

}
