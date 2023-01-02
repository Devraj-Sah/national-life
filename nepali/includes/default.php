<!--Banner Slider Section Start-->
<section class="banner">

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php
            $id = $constant->getId(54);
            $result = $groups->getByParentId($id);
            $i = 0;
            while ($row = $conn->fetchArray($result)) {
                $img_path = CMS_GROUPS_DIR . $row['image'];
                if (file_exists($img_path) && !empty($row['image'])) {
                    ?>
                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" class="<?php
                    echo ($i == 0) ? "active" : "";
                    $i++;
                    ?>"></li>
                        <?php
                    }
                }
                ?>

        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php
            $id = $constant->getId(54);
            $result = $groups->getByParentId($id);
            $i = 0;
            while ($row = $conn->fetchArray($result)) {
                $img_path = CMS_GROUPS_DIR . $row['image'];
                if (file_exists($img_path) && !empty($row['image'])) {
                    ?>
                    <div class="item <?php echo ($i == 0) ? "active" : ""; ?>">
                        <img src="<?php echo $img_path; ?>" width="100%" alt="Banner"/>
                    </div>
                    <?php
                    $i++;
                }
            }
            ?>

        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

</section>
<!--Banner Slider Section Ends-->


<!--About Us & Online Proposal & Premium Calculator Section Open-->

<section class="about_proposal">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-9">
                <aside class="about">
                    <?php
                    $id = $constant->getId(56);
                    $title = $constant->getTitle(56);
                    $result = $groups->getById($id);
                    $row = $conn->fetchArray($result);
                    ?>
                    <header><a href="<?php echo $row['urlname']; ?>" title="About National Life Insurance Company Limited"><?php echo $title; ?></a></header>
                    <article>
                        <?php
                        echo $row['shortcontents'];
                        ?>
                        <a href="<?php echo $row['urlname']; ?>" title="About National Life Insurance Company Limited">Read More</a>
                    </article>

                </aside>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">

                <!--              <?php
                $id = $constant->getId(57);
                $title = $constant->getTitle(57);
                $result = $groups->getById($id);
                $row = $conn->fetchArray($result);
                ?>
                              <a href="<?php echo $row['urlname']; ?>" class="proposal col-xs-12 col-sm-6 col-md-12" title="<?php echo $title; ?>"><div class="btn btn-primary"><span><img src="img/op.png" /></span><?php echo $title; ?>  </div></a>
                
                <?php
                $id = $constant->getId(58);
                $title = $constant->getTitle(58);
                $result = $groups->getById($id);
                $row = $conn->fetchArray($result);
                ?>
                              <a href="" class="proposal col-xs-12 col-sm-6 col-md-12" title="<?php echo $title; ?>"><div class="btn btn-primary"><span><img src="img/pc.png" /></span> <?php echo $title; ?></div></a>-->

                <ul class="sidelist">
                    <?php /*<li>&RightVector;<a href="">Premium Calculator</a></li>
                    <li>&RightVector;<a href="">Login</a></li>*/ ?>
                    <?php
                    $id = $constant->getId(70);
//                    $title = $constant->getTitle(58);
                    $result = $groups->getByParentId($id);
                    while ($row = $conn->fetchArray($result)) {
                        ?>
                        <li>&RightVector;<a href="<?php
                            if ($row['linkType'] == 'Link') {
                                echo $row['contents'];
                            } else {
                                echo $row['urlname'];
                            }
                            ?>"><?php echo $row['name']; ?></a></li>
<?php } ?>          
                    <?php /*<li>&RightVector;<a href="">Foreign Employment Tern Policy Enquiry</a></li>*/ ?>
                </ul>



            </div>			
        </div>
    </div>
</section>

<!--About Us & Online Proposal & Premium Calculator Section Close-->

<div class="clearfix"></div>

<!--Sub Article Section Open-->



<section class="sub">
    <div class="container">
        <div class="clearfix">
            <div id="slidelist" class="slidelist">

                <?php
                $id = $constant->getId(61);

                $result = $groups->getByParentId($id);
                while ($row = $conn->fetchArray($result)) {
                    $img_path = CMS_GROUPS_DIR . $row['image'];
                    ?>


                    <div class="slide-list-content-wrapper col-xs-12 col-sm-6">
                        <div class="row">
                            <div class="col-xs-5">
                                <?php
                                if ($row['shortcontents'] != '') {
                                    ?>
                                    <div class="slide-img img-circle"><?php echo $row['shortcontents']; ?></div>
    <?php } ?>
                            </div>
                            <div class="col-xs-7">
                                <div class="slide-list-title"><?php echo $row['name']; ?></div>
                                <div class="slide-list-content"><?php echo $row['contents']; ?></div>
                                <a class="readmore" href="<?php echo $row['urlname']; ?>">Step ahead &Implies;</a>
                            </div>
                        </div>
                    </div>
<?php } ?>
            </div>
            <div class="clearfix"></div>
            <div class="controls">
                <a id="prev" class="prev" href="#"></a> <a id="next" class="next" href="#"></a>
            </div>
        </div>
    </div>
</section>

<!--Sub Article Section Open--> 

<div class="clearfix"></div>

<!--Notice & Photo Gallery Section Open -->

<section class="notice_gallery">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">

                <div class="news">
                    <?php
                    $id = $constant->getId(59);
                    $title = $constant->getTitle(59);
                    $url = $groups->getUrlNameById($id);
                    $result = $groups->getByParentIdWithLimit($id, 10);
                    ?>
                    <h3><a href="<?php echo $url; ?>" class="news-title">Notice</a></h3>
                    <ul>
                        <?php
                        while ($row = $conn->fetchArray($result)) {
							$newsy1=$row['hide'];
							if ($newsy1!='Yes')
						{
                            ?>
                            <li><a href="<?php echo $row['urlname']; ?>"><span>&rarrhk;</span><?php echo $row['name']; ?></a></li>
						<?php } } ?>
                    </ul>
                </div>

            </div>
			<div class="col-sm-6">
			
			 <div class="news">
                    <?php
                    $id = $constant->getId(75);
                    $title = $constant->getTitle(75);
                    $url = $groups->getUrlNameById($id);
                    $result = $groups->getByParentIdWithLimit($id, 10);
                    ?>
                    <h3><a href="<?php echo $url; ?>" class="news-title"><?php echo $title; ?></a></h3>
                    <ul>
                        <?php
						while ($row = $conn->fetchArray($result) ) {
                       
						?>
							<li>
							<a href="<?php echo $row['urlname']; ?>"><span>&rarrhk;</span><?php echo $row['name']; ?></a>
							</li>
						<?php  } ?>
                    </ul>
                </div>
			
			
			</div>
<?php /* ?>
            <div class="col-sm-3">

                <div class="building">
                    <div class="text-center news-title building-title">Head Office</div>
                    <div class="build-img-wrapper text-center"><img class="" src="img/build.jpg" alt="purposed building"/></div>
                    <?php
                    $id = $constant->getId(72);
                    $title = $constant->getTitle(72);
//                    $url = $groups->getUrlNameById($id);
                    $result = $groups->getById($id);
                    $row = $conn->fetchArray($result);
                    ?>
                    <span class="img-caption"><?php echo $title; ?></span>

                    <div style="color:#fff;font-size: 12px;">
<?php echo $row['shortcontents']; ?>
                    </div>
                </div>

            </div>
<?php */ ?>
        </div>
    </div>
</section>

<!--Notice & Photo Gallery Section Close -->

<div class="clearfix"></div>

<!--Sub Article Link Second section Open-->

<section class="sub2">
    <div class="container">
        <div class="row">

            <?php
            $id = $constant->getId(61);
            $url = $groups->getUrlNameById($id);
            $title = $constant->getTitle(61);
            ?>
            <header><a class="list-header" href="<?php echo $url; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></header>

            <?php
            $result = $groups->getByParentIdWithLimitAsc($id, 6);
            while ($row = $conn->fetchArray($result)) {
                ?>
                <aside class="col-xs-12 col-sm-4 col-md-2 color2">
                    <div class="aside-overlay"></div>



                    <a class="list-img" href="<?php echo $row['urlname']; ?>" title="<?php echo $row['name']; ?>">
                        <?php
                        if ($row['shortcontents'] != '') {
                            ?>
                            <div><?php echo $row['shortcontents']; ?></div>
    <?php } ?>
                    </a>

                    <span class="list-caption"><?php echo $row['name']; ?></span>
                    <hr>
                    <ul>
                        <?php
                        $result1 = $groups->getByParentId($row['id']);
                        while ($row1 = $conn->fetchArray($result1)) {
                            ?>
                            <li><a href="<?php echo $row1['urlname']; ?>" title="<?php echo $row1['name']; ?>"><span>&RightVector;</span><?php echo $row1['name']; ?></a></li>
                <?php } ?>
                    </ul>
                </aside>
<?php } ?>

        </div>
    </div>
</section> 

<!--Sub Article Link Second section Close-->