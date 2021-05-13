<?php
if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)) {
    header("Location: 404");
}

class CP_Lpagination
{

    public function paginate_data($page, $total_results, $per_page)
    {
        if ($page) {
            $show_page = $page;
        } else {
            $page = 1;
            $show_page = 1;
        }
        $total_pages = ceil($total_results / $per_page);//total pages we going to have
        if ($show_page > 0 && $show_page <= $total_pages) {
            $start = ($show_page - 1) * $per_page;
            $end = $start + $per_page;
        } else {
            $start = 0;
            $end = $per_page;
        }
        $tpages = $total_pages;
        return array($show_page, $tpages, $total_pages, $start, $end);
    }

    public function paginate($reload, $page, $tpages, $get = false)
    {
        $delimiter = $get ? '&' : '?';
        $adjacents = 2;
        $prevlabel = "&lsaquo; Prev";
        $nextlabel = "Next &rsaquo;";

        $out = "<style type='text/css'>
            .pagination {
                height: 40px;
                margin: 20px 0
            }
            .pagination ul {
                display: inline-block;
                *display: inline;
                margin-bottom: 0;
                margin-left: 0;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;
                *zoom: 1;
                -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
                -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05)
            }
            .pagination li {
                display: inline
            }
            .pagination a,
            .pagination span {
                float: left;
                padding: 0 14px;
                line-height: 38px;
                text-decoration: none;
                background-color: #fff;
                border: 1px solid #ddd;
                border-left-width: 0
            }
            .pagination a:hover,
            .pagination .active a,
            .pagination .active span {
                background-color: #f5f5f5
            }
            .pagination .active a,
            .pagination .active span {
                color: #999;
                cursor: default
            }
            .pagination .disabled span,
            .pagination .disabled a,
            .pagination .disabled a:hover {
                color: #999;
                cursor: default;
                background-color: transparent
            }
            .pagination li:first-child a,
            .pagination li:first-child span {
                border-left-width: 1px;
                -webkit-border-radius: 3px 0 0 3px;
                -moz-border-radius: 3px 0 0 3px;
                border-radius: 3px 0 0 3px
            }
            .pagination li:last-child a,
            .pagination li:last-child span {
                -webkit-border-radius: 0 3px 3px 0;
                -moz-border-radius: 0 3px 3px 0;
                border-radius: 0 3px 3px 0
            }
            .pagination-centered {
                text-align: center
            }
            .pagination-right {
                text-align: right
            }
            </style>";
        $out .= '<div class="pagination"><ul>';
        // previous
        if ($page == 1) {
            $out .= "<li><span>" . $prevlabel . "</span><li>\n";
        } elseif ($page == 2) {
            $out .= "<li><a  href=\"" . $reload . "\">" . $prevlabel . "</a>\n</li>";
        } elseif ($page == 3) {
            $out .= "<li><a  href=\"" . $reload . $delimiter . "page=" . ($page - 1) . "\">" . $prevlabel . "</a>\n</li>";
        } else {
            $out .= "<li><a  href=\"" . $reload . $delimiter . "page=" . ($page - 1) . "\">" . $prevlabel . "</a>\n</li>";
            $out .= "<li><a  href=\"" . $reload . $delimiter . "page=1\">1</a>\n</li>";
        }
        $pmin = ($page > $adjacents) ? ($page - $adjacents) : 1;
        $pmax = ($page < ($tpages - $adjacents)) ? ($page + $adjacents) : $tpages;
        for ($i = $pmin; $i <= $pmax; $i++) {
            if ($i == $page) {
                $out .= "<li  class=\"active\"><a href=''>" . $i . "</a></li>\n";
            } elseif ($i == 1) {
                $out .= "<li><a  href=\"" . $reload . "\">" . $i . "</a>\n</li>";
            } else {
                $out .= "<li><a  href=\"" . $reload . $delimiter . "page=" . $i . "\">" . $i . "</a>\n</li>";
            }
        }
        if ($page < ($tpages - $adjacents)) {
            $out .= "<li><a href=\"" . $reload . $delimiter . "page=" . $tpages . "\">" . $tpages . "</a>\n</li>";
        }
        // next
        if ($page < $tpages) {
            $out .= "<li><a  href=\"" . $reload . $delimiter . "page=" . ($page + 1) . "\">" . $nextlabel . "</a>\n</li>";
        } else {
            $out .= "<li><span>" . $nextlabel . "</span></li>\n";
        }
        $out .= "</ul></div>";
        return $out;
    }
}