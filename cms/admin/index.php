<?php include "includes/admin_header.php"?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"?>

        <div id="page-wrapper">
            <?php
                if(!$_SESSION['user_role']){
                    header("Location: ../index.php");
                }
            ?>
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin <?php echo strtoupper(get_user_name());?>
                        </h1>
                        <h1>
                        </h1>
                    </div>
                </div>
                       
                <!-- /.row -->
                
                <div class="row">
                    <!-- POSTS -->
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                            <?php
                            $post_counts = count_records(get_all_user_posts()); 
                            echo "<div class='huge'>". $post_counts ."</div>";?>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- COMMENTS -->
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                    <?php
                            //$query ="SELECT * FROM comments";
                            //$select_all_comments = mysqli_query($connection, $query);
                            $comments_counts = count_records(get_all_user_comments());
                            echo "<div class='huge'>".$comments_counts."</div>";
                            ?>
                                    <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- CATEGORIES -->
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                            //$query ="SELECT * FROM categories";
                            //$select_all_categories = mysqli_query($connection, $query);
                            $categories_counts = count_records(get_all_user_categories());
                            echo "<div class='huge'>{$categories_counts}</div>";
                            ?>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- /.row -->

                <?php
                $post_published_counts = count_records(get_all_user_published_posts());

                $post_draft_counts = count_records(get_all_user_draft_posts());

                $post_approved_comments = count_records(get_all_user_approve_comments());

                $post_unapproved_comments = count_records(get_all_user_unapprove_comments());

                

                ?>

                <div class="row">
                    <script type="text/javascript">
                        google.load('visualization',"1.1", {'packages':['bar']});
                        google.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Data', 'Count'],

                                <?php
                                    $element_text = ['All Posts','Published Posts','Draft Posts', 'Comments','Aproved Comments','Unapproved Comments','Categories'];
                                    $element_count = [$post_counts,$post_published_counts,$post_draft_counts, $comments_counts, $post_approved_comments, $post_unapproved_comments, $categories_counts];

                                    for($i = 0; $i < 6; $i++){
                                        echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                                    }
                                ?> 
                            ]);

                            var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include "includes/admin_footer.php"?>