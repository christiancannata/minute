<aside class="leftbar">
    <div class="left-aside-container">
        <div class="user-profile-container">
            <div class="user-profile clearfix">
                <div class="admin-user-thumb">
                    <img src="<?php echo $BASE; ?>/ui/images/avatar/jaman_01.jpg" alt="admin">
                </div>
                <div class="admin-user-info">
                    <ul>
                        <?php if ($userLogged): ?>
                            <li><a href="#"><?php echo $user['name']; ?> <?php echo $user['surname']; ?></a></li>
                        <?php endif; ?>

                    </ul>
                </div>
            </div>
            <div class="admin-bar">
                <ul>
                    <li><a href="<?php echo $BASE; ?>/logout"><i class="zmdi zmdi-power"></i>
                    </a>
                    </li>
                    <li><a href="<?php echo $BASE; ?>/account"><i class="zmdi zmdi-account"></i>
                    </a>
                    </li>
                    <li><a href="<?php echo $BASE; ?>/setting"><i class="zmdi zmdi-settings"></i>
                    </a>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="list-accordion tree-style">
            <li class="list-title">Archivio</li>
            <li>
                <a href="#"><i class="zmdi zmdi-archive"></i><span class="list-label">Archivio Meeting</span></a>
                <ul>

                    <?php foreach (($meetings?:array()) as $ikey=>$meeting): ?>
                        <li><a href="<?php echo $BASE; ?>/meeting/<?php echo $meeting['_id']; ?>"><?php echo $meeting['name']; ?></a></li>
                    <?php endforeach; ?>

                </ul>
            </li>

        </ul>
    </div>
</aside>