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
                            Welcome to the Admin Dashborad <?php echo $_SESSION['username']?>
                        </h1>
                        <h1>
                        </h1>
                    </div>
                </div>
                       
                <!-- /.row -->
                
                <div class="row">
                    <!-- POSTS -->
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                            <?php
                            //$query ="SELECT * FROM posts";
                            //$select_all_posts = mysqli_query($connection, $query);
                            //TODO LO ANTERIOR ESTÁ FACTORIZADO EN FUNCTIONS
                            $post_counts = recordCount('posts');
                            echo "<div class='huge'>{$post_counts}</div>";
                            ?>
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
                    <div class="col-lg-3 col-md-6">
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
                            $comments_counts = recordCount('comments');
                            echo "<div class='huge'>{$comments_counts}</div>";
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
                    <!-- USERS -->
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                            //$query ="SELECT * FROM users";
                            //$select_all_users = mysqli_query($connection, $query);
                            $users_counts = recordCount('users');;
                            echo "<div class='huge'>{$users_counts}</div>";
                            ?>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- CATEGORIES -->
                    <div class="col-lg-3 col-md-6">
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
                            $categories_counts = recordCount('categories');
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
                $post_published_counts = checkStatus('posts', 'post_status','Published');

                $post_draft_counts = checkStatus('posts', 'post_status','Draft');

                $post_unapproved_comments = checkStatus('comments', 'comment_status','Unapproved');

                $post_subscriber_users = checkRole('users', 'user_role','subscriber');
                ?>

                <div class="row">
                    <script type="text/javascript">
                        google.load('visualization',"1.1", {'packages':['bar']});
                        google.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Data', 'Count'],

                                <?php
                                    $element_text = ['All Posts','Published Posts','Draft Posts', 'Comments','Unnaproved Comments','Users','Subscribers','Categories'];
                                    $element_count = [$post_counts,$post_published_counts,$post_draft_counts, $comments_counts, $post_unapproved_comments, $users_counts, $post_subscriber_users, $categories_counts];

                                    for($i = 0; $i < 8; $i++){
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
