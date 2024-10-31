<?php
class FeedifySW {
    
    function __construct() {
        add_action( 'init', array($this,'add_endpoint') );
        add_filter( 'query_vars', array($this,'query_vars') );
        add_action( 'wp', array($this,'sniff_requests') );
    }

    function add_endpoint() {
        global $wp;
        $wp->add_query_var( 'feedifysw' );
        add_rewrite_rule( '^FeedifySW.js', 'index.php?feedifysw=load', 'top' );
        $this->flush_rules();
    }

    function flush_rules($force=false) {
        if( !get_option('feedify_permalinks_flushed') || $force ) {
            flush_rewrite_rules();
            update_option('feedify_permalinks_flushed', 1);
        }
    }

    function query_vars( $query_vars ) {
        if(!in_array('feedifysw',$query_vars))
            $query_vars[] = 'feedifysw';
        return $query_vars;
    }
    
    function sniff_requests() {
        if ( get_query_var( 'feedifysw' ) == 'load' ) {
            $this->handle_file_request();
        }
    }
    
    private function handle_file_request(){
        header('Content-Type: application/javascript');
        echo "importScripts('https://cdn.feedify.net/js/push/sw-wp-1-0.js?v=3.0.0');";
        die();
    }
}