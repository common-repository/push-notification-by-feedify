<?php
if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Push_Report extends WP_List_Table {
    /**
     * Constructor, we override the parent to pass our own arguments
     * We usually focus on three parameters: singular and plural labels, as well as whether the class supports AJAX.
     */

    function __construct() {
        parent::__construct( array(
            'singular'=> 'Push', //Singular label
            'plural' => 'Push', //plural label, also this well be one of the table css class
            'ajax'   => false //We won't support Ajax for this table
        ) );
    }

    function get_columns() {
        return $columns= array(
            'push'=>__('PUSH'),
            'subs'=>__('SUBSCRIBERS'),
            'status'=>__('STATUS'),
            'delivered'=>__('DELIVERED'),
            'clicked'=>__('CLICKS'),
            'sent'=>__('SENT')
        );
    }


    function FeedifyGetSortableColumns() {
        return $sortable = array();
    }


    public function column_default( $item, $column_name ) {
        switch ( $column_name ) {
            case 'push':
                return $item->title;
            case 'sent':
                return $item->created_at;
            case 'status':
                switch($item->status){
                    case 0:
                        return 'Pending';
                    case 1:
                        return 'Sending';
                    case 2:
                        return 'Sent';
                }
                break;
            default:
                return $item->$column_name;
        }
    }


    function FeedifyPrepareItems() {
        $screen = get_current_screen();
        $perpage = 10;
        $paged = isset($_GET["paged"]) ? sanitize_text_field($_GET["paged"]) : '';
        //Page Number

        if(empty($paged) || !is_numeric($paged) || $paged<=0 ){
            $paged=1;
        }

        $feedify_licence_key = get_option('feedify_licence_key');
        $feedify_domain_key = get_option('feedify_domain_key');
        $feedify = new FeedifyAPI($feedify_domain_key, $feedify_licence_key);
        $push_reports = $feedify->FeedifyGetReport($paged, $perpage);
        $totalpages = ceil($push_reports->total/$perpage);
        if($push_reports) {
            $this->set_pagination_args( array(
                "total_items" => $push_reports->total,
                "total_pages" => $totalpages,
                "per_page" => $perpage,
            ) );
        }

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->FeedifyGetSortableColumns();
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $push_reports->records;

    }

}

$push_report = new Push_Report();
$push_report->FeedifyPrepareItems();
?>

<style type="text/css">
    .ariTablePlu .widefat thead tr th{
        font-weight: 700;
    }
    .ariTablePlu .alternate, .ariTablePlu .striped>tbody>:nth-child(odd), .ariTablePlu ul.striped>:nth-child(odd){
            background-color: #e2e1e1;
    }
     .ariTablePlu .tablenav .tablenav-pages a,  .ariTablePlu .tablenav-pages-navspan{
        border: 1px solid #0073aa;
        background: #0073aa;
        color: #fff;
    }
    .ariTablePlu .tablenav .tablenav-pages a:hover,  .ariTablePlu .tablenav-pages-navspan:hover{
        background: #27a3de;
    }
    .ariTablePlu .wp-heading-inline{
        width: 100%;
        text-align: center;
    }    
    .ariTablePlu .aReportBtn .page-title-action{
        padding: 0 20px !important;
        height: 40px;
        line-height: 40px;
        display: inline-block;
    }
    .ariTablePlu .aReportBtn{
        width: auto;
        float: left;
    }
    .rightPush{
        width: auto;
        float: right;
    }
    .aPower{
        width: 100%;
        float: left;
    }

    .doMainRelated .button-primary{
        padding: 0 .75rem;
        background: #e44c44;
        height: 60px;
        line-height: 60px;
        width: 100%;
        color: #fff;
        text-shadow: none !important;
        box-shadow: none;
        border: none;
        -webkit-transition: all ease-in-out 300ms;
        -moz-transition: all ease-in-out 300ms;
        transition: all ease-in-out 300ms;
    }
</style>
<div class="wrap ariTablePlu">



    <h1 class="wp-heading-inline">
        Push Report     
    </h1>
     
    <hr class="wp-header-end">
    <div class="aPower">
        <div class="aReportBtn">
            <a href="<?php echo admin_url( '/admin.php?page=feedify-send-push' ) ?>" class="page-title-action">Send Push</a>

        </div>  
        <div class="rightPush">
            <?php $push_report->display(); ?>
        </div> 
    
    </div>
</div>
