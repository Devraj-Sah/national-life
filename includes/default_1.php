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
                echo strip_tags( $row['shortcontents']);
                ?>
              </article>
            </aside>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="row">
              <?php
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
              <a href="" class="proposal col-xs-12 col-sm-6 col-md-12" title="<?php echo $title; ?>"><div class="btn btn-primary"><span><img src="img/pc.png" /></span> <?php echo $title; ?></div></a>
            </div>
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
		
          <?php
          $id = $constant->getId(61);
              
              $result = $groups->getByParentIdWithLimitAsc($id, 6);
          while ($row = $conn->fetchArray($result))
          {
            $img_path = CMS_GROUPS_DIR . $row['image'];
            $title_arr = explode(' ', $row['name']);
            ?>
            <a href="<?php echo $row['urlname']; ?>" class="col-xs-12 col-sm-4 col-md-2 color">
              <?php
              if (file_exists($img_path) && !empty($row['image']))
              {
                ?>
                <img src="<?php echo $img_path; ?>" alt="CHILDREN PLAN"/>
              <?php } ?>
              <header><?php echo $title_arr[0]; ?> </br><?php
                for ($i = 1; $i < count($title_arr); $i++)
                  echo $title_arr[$i];
                ?></header>
              <article><?php echo $row['shortcontents']; ?></article>
              <footer>Read More</footer>
            </a>
          <?php } ?>

        </div>
      </div>
    </section> 
    <!--Sub Article Section Open--> 

    <div class="clearfix"></div>

    <!--Notice & Photo Gallery Section Open -->

    <section class="notice_gallery">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-6">
            <aside class="notice">
              <?php
              $id = $constant->getId(59);
              $title = $constant->getTitle(59);
              $url = $groups->getUrlNameById($id);
              $result = $groups->getByParentIdWithLimit($id, 2);
              ?>
              <header><a href="<?php echo $url; ?>" title="notice"><?php echo $title; ?></a></header>
              <div class="row">
                <?php
                while ($row = $conn->fetchArray($result))
                {
                  ?>
                  <a href="<?php echo $row['urlname']; ?>" class="col-xs-12 col-sm-6" title="Notice1">
                    <header><?php echo $row['name']; ?></header>
                    <article>
					<?php if(file_exists(CMS_GROUPS_DIR . $row['image']) && !empty($row['image']))
								 {?>
                      <img src="<?php echo CMS_GROUPS_DIR . $row['image']; ?>" width="100%" height="100%" alt="<?php echo $row['name'];?>"/>
					 <?php } else {
					 echo $row['shortcontents'];}?>
					
                    </article>
                  </a>
                <?php } ?>

              </div>
            </aside>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6">
            <aside class="photo_gallery clearfix">
              <?php
              $id = $constant->getId(60);
              $title = $constant->getTitle(60);
              $url = $groups->getUrlNameById($id);
              $result = $groups->getByParentIdWithLimit($id, 6);
              ?>
              <header class="visible-xs visible-sm"><a href="<?php echo $url; ?>" title="Photo Gallery"><?php echo $title; ?></a></header>
              <?php
              while ($row = $conn->fetchArray($result))
              {
                $img_path = CMS_GROUPS_DIR . $row['image'];
                ?>
                <article class="col-xs-4 pr2">
                  <div class="pr1">
                    <a href="<?php echo $img_path; ?>" rel="prettyPhoto[pp_gal]" title="#">
                      <div class="photo_gallery_inner">
                        <img src="<?php echo imager($row['image'], 181, 127, 'fix'); ?>" alt="Photo Gallery" title="Photo Gallery"/>
                        <aside class="mag">
                          <img src="img/mag.png" alt="mag"/>
                        </aside>
                      </div>
                    </a>
                  </div>
                </article>
              <?php } ?>

            </aside>
          </div>

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
          $result = $groups->getByParentIdWithLimitAsc($id, 6);
          while ($row = $conn->fetchArray($result))
          {
            ?>
            <aside class="col-xs-12 col-sm-4 col-md-2 color2">

              <header class="text-center"><a href="<?php echo $row['urlname']; ?>" title="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></a></header>
              <hr>
              <ul>
                <?php
                $result1 = $groups->getByParentId($row['id']);
                while ($row1 = $conn->fetchArray($result1))
                {
                  ?>
                  <li><a href="<?php echo $row1['urlname']; ?>" title="<?php echo $row1['name']; ?>"><?php echo $row1['name']; ?></a></li>
                <?php } ?>
              </ul>
            </aside>
          <?php } ?>
  
        </div>
      </div>
    </section> 

    <!--Sub Article Link Second section Close-->