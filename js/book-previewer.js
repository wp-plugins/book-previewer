/* This bookpreviewer.js file is part of the Book Previewer plugin for WordPress
 * 
 * This file is distributed as part of the Book Previewer plugin for WordPress
 * and is not intended to be used apart from that package. You can download
 * the entire Book Previewer plugin from the WordPress plugin repository at
 * http://wordpress.org/plugins/book-previewer/
 */

/* 
 * Copyright 2014	James R. Hanback, Jr.  (email : james@jameshanback.com)
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
 
var bpviewer=null;

function loadBPviewer(bplang,bpbrand) {
    google.load("books", "0", {"language":bplang}, {"cobrand":bpbrand});
}

function bpinitialize(isbn) {
   var canvas = document.getElementById("viewerCanvas");
   bpviewer = new google.books.DefaultViewer(canvas);
   bpviewer.load(isbn,bpviewerLoadFail,bpviewerLoadSuccess);
}

function bpviewerLoadSuccess() {
   if(!bpviewer) return;
}

function bpviewerLoadFail() {
   document.getElementById('viewerCanvas').style.display='none';
}

function bpshowpreview(bpid) {
    google.setOnLoadCallback(function() { bpinitialize(bpid) });
}

function bppopup(bptitle,bpid,bpwidth,bpheight) {
    bpshowpreview(bpid);
    jQuery(document).ready(function() {
        jQuery( "#jhbpreviewer" ).dialog({ autoOpen: false });
        jQuery( "#gbppop" ).click(function() {
            jQuery( "#jhbpreviewer" ).dialog( {title: bptitle, width: bpwidth, height: bpheight, show: {effect: "blind", duration: 1000}, hide: {effect: "explode", duration: 1000} } );
            jQuery( "#jhbpreviewer" ).dialog("open");
            bpviewer.zoomIn();
            bpviewer.zoomOut();
            bpviewer.resize();
        });
    });
}