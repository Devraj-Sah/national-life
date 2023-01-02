

<div class="container">
    <div class="row">
        <div class="col-xs-12 cms-content">
            <div class="row">
                
                <div class='col-xs-12'>
                    <div class='inner-content-wrapper'>
                        <div class="inner-content-title">Site Map</div>
                        <div class="inner-content sitemap">
                            <?php createMenu(0, 'Menu'); ?>
                            
                               <ul>
                                    
                                 
                                        <li><a href="<?php echo $row['urlname']; ?>faq" title="#">Faq</a></li>
                                        <li><a href="<?php echo $row['urlname']; ?>?action=showsitemap" title="#">Sitemap</a></li>
                                        <li><a href="<?php echo $row['urlname']; ?>?action=feedback" title="#">Feedback</a></li>
                                        <li> <a href="http://202.166.205.74:8080/" target="_blank">Term Policy Enquiry</a></li>
                                        <?php
                                                $id = $constant->getId(73);
                                                $result = $groups->getByParentId($id);
                                                while ($row = $conn->fetchArray($result)) {
                                                    ?>
                                                  <li>  <a target="_blank" href="<?php if($row['linkType']=='Link'){echo $row['contents'];}else {echo $row['urlname'];} ?>">
                                                    <?php echo $row['name']; ?>
                                                    </a></li>
                                                    
                                                    <?php
                                                }
                                                ?>
                                   
                                </ul>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>