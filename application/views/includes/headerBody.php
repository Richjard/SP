<input type="hidden" id="base_url" value="<?=base_url()?>">
<input type="hidden" id="user__" value="<?=$this->session->userdata('Usuario')?>">
<div id="dialogObj_reportes"></div>
<div id="dialogObj_reportes_modal"></div>
<!--<ul id="menu">
        <li id="Home"><a>Home</a></li>
        <li>
            <a>Search Jobs</a>
            <ul>
                <li><a>Advanced Search</a></li>
                <li><a>Jobs by Company</a></li>
                <li><a>Jobs by Category</a></li>
                <li><a>Jobs by Location</a></li>
                <li><a>Jobs by Skills</a></li>
                <li><a>Jobs by Designation</a></li>
            </ul>
        </li>
        <li id="Post Resume"><a>Post Resume</a></li>
        <li id="Job Seeker"><a>JobSeeker Login</a></li>
        <li id="Fast Forward">
            <a>Fast Forward</a>
            <ul>
                <li><a>Resume writing</a></li>
                <li><a>Certification</a></li>
                <li><a>Resume Spotlight</a></li>
                <li><a>Jobs4u</a></li>
            </ul>
        </li>
        <li id="More">
            <a>More</a>
            <ul>
                <li><a>Mobile</a></li>
                <li><a>Pay check</a></li>
                <li><a>Blog</a></li>
            </ul>
        </li>
    </ul>-->

<div class="control-section" id="d">
    <div class="toolbar-menu-control">
        <div id="shoppingtoolbar"></div>
    </div>
</div>
<style>
    /**
    * ej2 Menu - toolbar integration styles
    */
    @font-face {
        font-family: 'e-menu';
        src:
        url(data:application/x-font-ttf;charset=utf-8;base64,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) format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    .em-icons {
        font-family: 'e-menu';
        font-style: normal;
        font-variant: normal;
        font-weight: normal;
        text-transform: none;
        line-height: 2;
    }
    
    .toolbar-menu-control .e-toolbar-items .e-toolbar-item .e-tbar-btn .e-btn-icon.e-shopping-cart {
        font-size: 20px;
        margin-right: 1px;
    }

    .e-bigger .toolbar-menu-control .e-toolbar-items .e-toolbar-item .e-tbar-btn .e-btn-icon.e-shopping-cart {
        font-size: 30px;
        margin-right: 2px;
    }

    .e-bigger .toolbar-menu-control .e-toolbar .e-toolbar-items .e-input-group .e-search {
        font-size: 19px;
    }

    .material.e-bigger .toolbar-menu-control .e-toolbar .e-toolbar-items .e-input-group .e-search {
        font-size: 16px;
    }

    .e-bigger .toolbar-menu-control .e-toolbar .e-hscroll .e-scroll-nav.e-scroll-right-nav,
    .e-bigger .toolbar-menu-control .e-toolbar .e-hscroll .e-scroll-nav .e-nav-arrow {
        transform: none;
    }

    .bootstrap .toolbar-menu-control .e-toolbar .e-toolbar-right .e-toolbar-item.e-template {
        padding-top: 3px;
    }

    .toolbar-menu-control .e-search::before {
        content: '\e5b9';
    }

    .toolbar-menu-control .e-shopping-cart::before {
        content: '\e7e8';
    }

    .toolbar-menu-control .e-menu-wrapper .e-menu {
        border: none;
    }

    .toolbar-menu-control {
       
       
    }

    .toolbar-menu-control .e-toolbar .e-toolbar-left .e-toolbar-item.e-template {
        padding: 0;
    }

    .control-wrapper .toolbar-menu-control .e-toolbar {
        overflow: visible !important;
    }

    .control-wrapper .toolbar-menu-control .e-menu-wrapper {
        margin-right: 160px;
    }    

    .toolbar-menu-control .e-hscroll .e-hscroll-content {
        position: static;
    }

    .material .toolbar-menu-control .e-toolbar-items .e-toolbar-item.e-template .e-input-group .e-input {
        padding-bottom: 0;
    }
    
    .toolbar-menu-control .e-toolbar-items .e-toolbar-item.e-template .e-input-group .e-search {
        margin-right: 10px;
    }

    .toolbar-menu-control .e-toolbar .e-toolbar-items .e-toolbar-item #userDBtn {
        text-overflow: initial;
    }
    .e-toolbar .e-toolbar-items{
        background: #f4f4f4 !important;
    }
    .fabric .toolbar-menu-control .e-toolbar-items .e-menu,
    .fabric .toolbar-menu-control .e-toolbar-items .e-dropdown-btn {
        background: transparent;
    }

    @media only screen and (max-width: 1300px) {
        .toolbar-menu-control {
            width: auto;
        }
    }
</style>
    <style>
    #dropdownbutton-control {
        width: 100%;
        margin: 11% 0;
        text-align: center;
    }

    .dropdownbutton-section {
        width: 80%;
        margin: auto;
    }

    #dropdownbutton-control .col-xs-12 {
        margin: 15px 0;
    }

    @media only screen and (max-width: 500px) {
        #dropdownbutton-control .col-lg-6 {
            margin-bottom: 30px;
        }
    }

    @media only screen and (min-width: 1200px) {
        #dropdownbutton-control .col-lg-6 {
            width: 25%;
        }
    }

    @font-face {
        font-family: 'e-ddb-icons';
        src: url(data:application/x-font-ttf;charset=utf-8;base64,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) format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    .e-ddb-icons {
        font-family: 'e-ddb-icons';
        speak: none;
        font-size: 55px;
        font-style: normal;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .e-logout::before {
        content: "\e702";
    }

    .e-dashboard::before {
        content: "\e704";
    }

    .e-profile::before {
        content: "\e703";
    }

    .e-notifications::before {
        content: "\e700";
    }

    .e-settings::before {
        content: "\e701";
    }

    .material .e-logout::before,
    .bootstrap .e-logout::before {
        content: "\e706";
    }

    .material .e-dashboard::before,
    .bootstrap .e-dashboard::before {
        content: "\e708";
    }

    .material .e-profile::before,
    .bootstrap .e-profile::before {
        content: "\e709";
    }

    .material .e-notifications::before,
    .bootstrap .e-notifications::before {
        content: "\e707";
    }

    .material .e-settings::before,
    .bootstrap .e-settings::before {
        content: "\e705";
    }
</style>