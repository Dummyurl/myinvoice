<?php
/*  class active for navbar  */
$url_segment = trim($this->uri->segment(1));
$home_active = "";
if (empty($url_segment))
    $home_active = "active";

$this->load->database();
$this->db->select('*', FALSE);
$this->db->from('tbl_site_setting');
$compny_data = $this->db->get()->row_array();
$root_dir = FCPATH . uploads_path . '/sitesetting/';
$logo_image = isset($compny_data['company_logo']) ? $compny_data['company_logo'] : "";
$script = isset($compny_data['head_script']) ? $compny_data['head_script'] : "";
if (isset($logo_image) && $logo_image != "") {
    if (file_exists($root_dir . $logo_image)) {
        $com_logo = base_url() . uploads_path . '/sitesetting/' . $logo_image;
    } else {
        $com_logo = base_url() . img_path . "/no-image.png";
    }
} else {
    $com_logo = base_url() . img_path . "/no-image.png";
}
///////////////////////////////////////// 

$this->db->select('*', FALSE);
$this->db->from('tbl_main_menu');
$this->db->where("status='A'", false, false);
$main_menu = $this->db->get()->result_array();
$aspenArr = array("aspen-air", "aspen_slim", "aspen_rock");
$liquidArr = array("liquid-sunshine", "liquid_burst", "liquid_bliss", "liquid_infused", "liquid_traditional");
$searchArr = array("search");
$aboutusArr = array("about_us");
$contactArr = array("contact");
$supportArr = array("support", "supportlist");
////////////////////////////////////////////

$meta = $this->general->meta_tag();
$title = isset($meta['Title']) && $meta['Title'] != '' ? $meta['Title'] : $title;
$meta_keyword = $meta['Keyword'];
$meta_description = $meta['Description'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo MY_SITE_NAME; ?> | <?php echo isset($title) && $title != '' ? $title : "Home"; ?></title>

        <!-- Meta Tag-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <?php if (isset($meta_description) && $meta_description != '') { ?>
            <meta name="description" content="<?php echo $meta_description; ?>"/>
        <?php }if (isset($meta_keyword) && $meta_keyword != '') { ?>
            <meta name="keywords" content="<?php echo $meta_keyword; ?>"/>
        <?php } ?>   
        <!--End Meta Tag-->

        <?php include APPPATH . '/modules/views/css.php'; ?>
        <script src="<?php echo $this->config->item('js_url'); ?>jquery.3.2.1.min.js"></script>
        <script src="<?php echo $this->config->item('js_url'); ?>jquery.validate.min.js" type="text/javascript"></script>
        <?php echo $script; ?>
        <script>
            var site_url = '<?php echo base_url(); ?>';
            var base_url = '<?php echo base_url() ?>';
            var csrf_token_name = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>
        <link rel="icon" href="<?php echo base_url() . img_path; ?>/favicon.ico">
    </head>
    <body class="presentation-page">
        <div class="loadingmessage" id="loadingmessage"></div>
        <!-- Navbar -->
        <nav class="navbar navbar-toggleable-md bg-white fixed-top">
            <div class="container">
                <div class="navbar-translate">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>" rel="tooltip" data-placement="bottom">
                        <img class="img-responsive logo-image-style" src="<?php echo $com_logo; ?> " alt="logo"/>
                    </a>
                </div>
                <div class="collapse navbar-collapse justify-content-end" data-nav-image="<?php echo base_url() . img_path ?>/blurred-image-1.jpg" data-color="orange">
                    <ul class="navbar-nav">
                        <?php
                        if (array_search("home", array_column($main_menu, 'name'))) {
                            foreach ($main_menu as $row) {
                                $slug = $row['slug'];
                                $name_compare = strtolower($row['name']);

                                if (strcmp($name_compare, "home") == 0) {
                                    if ($url_segment == 'root')
                                        $active = "active";
                                    else
                                        $active = "";
                                    $home_name = $slug;
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link header-tab <?php echo $home_active . ' ' . $active; ?>" href="<?php echo base_url($slug); ?>">
                                            <p>HOME</p>
                                        </a>
                                    </li>
                                    <?php
                                    break;
                                }
                            }
                        } else {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link header-tab <?php echo $home_active; ?>" href="<?php echo base_url(); ?>">
                                    <p>HOME</p>
                                </a>
                            </li>
                            <?php
                        }
                        $login_slug = "";
                        $slug_compare = "";
                        if (isset($main_menu) && count($main_menu) > 0) {
                            foreach ($main_menu as $row) {
                                $slug = $row['slug'];
                                if (strcmp($slug, $url_segment) == 0) {
                                    $class_active = "active";
                                } else {
                                    $class_active = "";
                                }
                                $slug_compare = strtolower($row['name']);
                                if (strcmp($slug_compare, "login") == 0) {
                                    $login_slug = $slug;
                                } else {
                                    if (strcmp(strtolower($row['name']), "home") != 0) {
                                        ?>

                                        <li class="nav-item">
                                            <a class="nav-link header-tab <?php echo $class_active; ?>" href="<?php echo base_url($slug); ?>">
                                                <p><?php echo strtoupper($row['name']); ?></p>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                            }
                        }
                        if ($this->session->userdata('UserID')) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url() . 'dashboard/' ?>">
                                    <p>My Account</p>
                                </a>
                            </li>
                            <?php
                        } else if (!empty($login_slug)) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url($login_slug) ?>">
                                    <p>Login</p>
                                </a>
                            </li>
                            <?php
                        } else if (empty($login_slug)) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url() . 'login/' ?>">
                                    <p>Login</p>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->


