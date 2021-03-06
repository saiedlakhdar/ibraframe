<!-- Page Heading -->
<!-- Page Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/"><?= $sidebar_text_dashboard ;?></a></li>
        <?php if ($this->requestAction !== 'default' ) :   ?>
            <li class="breadcrumb-item"><a href="/<?= $this->requestController ;?>"><?php $rc = 'sidebar_text_'.$this->requestController ; echo  $$rc ;?></a></li>
        <?php endif; ?>
        <?php if (isset($header_page_title))  :    ?>
            <li class="breadcrumb-item active" aria-current="page"><?= $header_page_title ;?></li>
        <?php endif; ?>
    </ol>
</nav>

<!--Alert Messanger -->
<?php $messages = $this->Messanger->getmessages() ; if (!empty($messages)) : foreach ($messages as $message) :   ?>
    <div class="alert alert<?= $message[1] ;?> alert-dismissible fade show" id="alert" role="alert">
        <?= $message[0] ;?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endforeach; endif; ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= $header_page_title ; ?>
            <?php if($this->_auths->isaccess($this->requestController,'edit') || $this->_auths->isaccess($this->requestController,'del') ): ?>
            <a class="btn btn-primary btn-sm text-white" href="/users/add"><?php $add = 'sidebar_text_'.$this->requestController.'_add' ; echo  $$add ;?></a>
            <?php endif; ?>
        </h6>
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th><?= $users_text_username ; ?></th>
                    <th><?= $users_text_email ; ?></th>
                    <th><?= $users_text_rule ; ?></th>
                    <th><?= $users_text_phone ; ?></th>
                    <th><?= $users_text_status ; ?></th>
                    <?php if($this->_auths->isaccess($this->requestController,'edit') || $this->_auths->isaccess($this->requestController,'del') ): ?>
                    <th><?= $users_text_control ; ?></th>
                    <?php endif; ?>
                </tr>
                </thead>

                <tbody>

                <?php  if (isset($usersdata) && false !== $usersdata ) : foreach ($usersdata as $user) : ?>
                <tr>
                    <td><?= $user->username  ; ?></td>
                    <td><?= $user->email  ; ?></td>
                    <td><?= $user->rulename ;?></td>
                    <td><?= $user->phone  ; ?></td>
                    <td><?= $user->status == 1 ? '<span class="badge badge-pill badge-success">'.$users_text_status_on.'</span>':'<span class="badge badge-pill badge-danger">'.$users_text_status_off.'</span>' ; ?></td>
                    <?php if($this->_auths->isaccess($this->requestController,'edit') || $this->_auths->isaccess($this->requestController,'del') ): ?>
                    <td>
                        <?php if($this->_auths->isaccess($this->requestController,'edit')): ?>
                        <a class="btn btn-outline-primary" href="/<?= $this->requestController ;?>/edit/<?= $user->id ; ?>" > <i class="fas fa-user-edit"></i> </i> </a>
                        <?php endif; ?>
                        <?php if($this->_auths->isaccess($this->requestController,'del')): ?>
                        <a class="btn btn-outline-primary" href="/<?= $this->requestController ;?>/del/<?=$user->id ; ?>" onclick="return confirm('<?= $users_text_control_del ; ?>?');" > <i class="fas fa-trash"></i> </i> </a>
                        <?php endif; ?>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>

                </tbody>
            </table>
        </div>


    </div>


</div>