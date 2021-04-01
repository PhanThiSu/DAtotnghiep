<div class="box-body">
    <ul class="sidebar-menu" data-widget="tree">
        <?php if(empty($this->records['data'])){?>
            <tr role="row"><td colspan="3"><h3 class="text-danger text-center"> No data</h3></td></tr>
        <?php }?>
        <?php $count = 1; foreach ($this->records['data'] as $record) { ?>
        <li class="treeview">
            <a href="#">
                <span class='textFullName'><?= $record['users_firstname']." ".$record['users_lastname'] ?></span>
                <span><?= $record['title'] ?></span>
                <span class="pull-right-container">
                    <span class="mr-1"> <i class="fa fa-calendar-check-o"></i> </span>
                    <span class="mr-1 treeview-time"><?= $record['created'] ?></span>
                    <i class="fa fa-angle-right pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu content_ul" style="background:white;margin-bottom:20px; margin-top:20px;padding:20px;">
                <li style="white-space:normal;">
                    <h4>Title: <span><?= $record['title'] ?></span></h4></br>
                    <h4>Content:</h4></br>
                    <div class='ml-1'><?= $record['content'] ?></div></br>
                    <h4>By: <span><?= $record['users_firstname']." ".$record['users_lastname'] ?></span></h4>
                </li>
            </ul>
        </li>
        <?php } ?>
    </ul>
    <div class="row">
        <?php vendor_html_helper::pagination($this->records['norecords'], $this->records['nocurp'], $this->records['curp'], $this->records['nopp']); ?>
    </div>
</div>