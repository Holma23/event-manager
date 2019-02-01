<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-12 col-xs-12 page-sidebar">
            <aside>
                <div class="inner-box">
                    <div class="categories">
                        <div class="widget-title">
                            <i class="fas fa-align-justify"></i>
                            <h4>All Categories</h4>
                        </div>
                        <div class="categories-list">
                            <ul>
                                <?php foreach ($topics as $topic){ ?>
                                    <li>
                                        <a href="index.php?module=event&action=search&topic_id=<?php echo $topic['id'] ?>">
                                            <i class="fas fa-desktop"></i>
                                            <?php echo $topic['name'] ?>
                                            <span class="category-counter"></span>
                                        </a>
                                    </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="inner-box">
                    <div class="widget-title">
                        <h4>Premium Ads</h4>
                    </div>
                    <div class="advimg">
                        <ul class="featured-list">
                            <li>
                                <img alt="" src="assets/img/featured/img1.jpg">
                                <div class="hover">
                                    <a href="#"><span>$49</span></a>
                                </div>
                            </li>
                            <li>
                                <img alt="" src="assets/img/featured/img2.jpg">
                                <div class="hover">
                                    <a href="#"><span>$49</span></a>
                                </div>
                            </li>
                            <li>
                                <img alt="" src="assets/img/featured/img3.jpg">
                                <div class="hover">
                                    <a href="#"><span>$49</span></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="inner-box">
                    <div class="widget-title">
                        <h4>Advertisement</h4>
                    </div>
                    <img src="assets/img/img1.jpg" alt="">
                </div>
            </aside>
        </div>
        <div class="col-lg-9 col-md-12 col-xs-12 page-content">




            <div class="adds-wrapper">

                <?php
                echo $event['name'];
                ?>


            </div>

        </div>
    </div>
</div>
