
           
            
            
            </div>
        </div>
    </div>
    
    
</div>
<style>
    /* Content area styles */

    .title {
        text-align: center;
        font-size: 20px;
        padding: 15px;
    }

    .sub-title {
        text-align: center;
        font-size: 16px;
        padding: 10px;
    }

    #wrapper .sub-title .column {
        display: inline-block;
        padding: 10px;
    }

    .center {
        text-align: center;
        display: none;
        font-size: 13px;
        font-weight: 400;
        margin-top: 20px;
    }

    .sb-content-tab .center {
        display: block;
    }

    /* end of content area styles */

    /* Sidebar styles */

    .sb-content-tab #wrapper {
        display: none;
    }

    #dockSidebar.e-sidebar.e-right.e-close {
        visibility: visible;
        transform: translateX(0%);
    }

    #dockSidebar .e-icons::before {
        font-size: 25px;
    }

    /* dockbar icon Style */

    #dockSidebar .home::before {
        content: '\e7a4';
    }

    #dockSidebar .film::before {
        content: '\e798';
    }

    #dockSidebar .info::before {
        content: '\e7e7';
    }

    #dockSidebar .settings::before {
        content: '\e7cf';
    }

    .e-sidebar .expand::before,
    .e-sidebar.e-right.e-open .expand::before {
        content: '\e85c';
    }

    .e-sidebar.e-open .expand::before,
    .e-sidebar.e-right .expand::before {
        content: '\e98f';
    }

    /* end of dockbar icon Style */

    #dockSidebar.e-close .sidebar-item {
        padding: 5px 20px;
    }

    #dockSidebar.e-dock.e-close span.e-text {
        display: none;
    }

    #dockSidebar.e-dock.e-open span.e-text {
        display: inline-block;
    }

    #dockSidebar li {
        list-style-type: none;
        cursor: pointer;
    }

    #dockSidebar ul {
        padding: 0px;
    }

    #dockSidebar.e-sidebar ul li:hover span {
        color: white
    }

    #dockSidebar span.e-icons {
        color: #c0c2c5;
        line-height: 2
    }

    .e-open .e-icons {
        margin-right: 16px;
    }

    .e-open .e-text {
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 23px;
        font-size: 15px;
    }

    .sidebar-item {
        text-align: center;
        border-bottom: 1px #e5e5e58a solid;
    }

    .e-sidebar.e-open .sidebar-item {
        text-align: left;
        padding-left: 15px;
        color: #c0c2c5;
    }

    #dockSidebar.e-sidebar {
        background: #2d323e;
        overflow: hidden;
    }

    /* end of sidebar styles */
</style>
<?php
if($JS_PROPIO_VIEW) {
    foreach($JS_PROPIO_VIEW as $global_js) {      
    ?>

    <script src="<?=base_url($global_js.".js")?>" type="text/javascript"></script>
    <?php
    }
}

if(JS_FOOTER) {
    foreach(JS_FOOTER as $j_p) {      
    ?>

    <script src="<?=base_url($j_p.".js")?>" type="text/javascript"></script>
    <?php
    }
}
?>
</body></html>

